<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DeepSeekService
{
    protected string $apiKey;
    protected string $endpoint = 'https://api.deepseek.com/v1/chat/completions';

    public function __construct()
    {
        $this->apiKey = config('services.deepseek.api_key', '');
    }

    // ════════════════════════════════════════════
    //  教案生成（完整管线）
    // ════════════════════════════════════════════

    /**
     * 生成教案（含输入净化 + Prompt构造 + 输出校验）
     */
    public function generateLessonPlan(array $rawInput): string
    {
        // 第1步：净化 + 补全用户输入
        $inputs = $this->cleanAndFillInputs($rawInput);

        // 第2步：构造结构化 Prompt
        $prompt = $this->buildLessonPlanPrompt($inputs);

        // 第3步：调用 AI
        $result = $this->chat($prompt, 0.7, 3072);
        $content = $result['choices'][0]['message']['content'] ?? '';

        if (empty($content)) {
            throw new \Exception('AI 返回内容为空，请重试');
        }

        // 第4步：后置校验
        $content = $this->validateOutput($content);

        return $content;
    }

    /**
     * 生成文案
     */
    public function generateCopy(string $type, string $theme, ?string $extra = null): string
    {
        $prompt = $this->buildCopyPrompt($type, $theme, $extra);
        $result = $this->chat($prompt, 0.8, 1024);
        return $result['choices'][0]['message']['content'] ?? '生成失败，请重试';
    }


    // ════════════════════════════════════════════
    //  第一步：数据清洗 + 默认值补全
    // ════════════════════════════════════════════

    /**
     * 净化并补全用户输入
     * 核心策略：用户没填的字段，用专业默认值兜底，防止AI瞎编
     */
    private function cleanAndFillInputs(array $raw): array
    {
        $ageGroup  = $raw['age_group'] ?? '4-5岁';
        $subjects  = (array)($raw['subjects'] ?? ['艺术']);
        $theme     = trim($raw['theme'] ?? '');
        $duration  = $raw['duration'] ?? '20-25分钟';
        $objectives = trim($raw['objectives'] ?? '');
        $materials  = trim($raw['materials'] ?? '');
        $extra      = trim($raw['extra_notes'] ?? '');

        // ── 主题不能为空 ──
        if (empty($theme)) {
            $theme = '春天的小花园';
        }

        // ── 领域转中文 ──
        $validSubjects = ['语言', '科学', '艺术', '健康', '社会'];
        $fields = [];
        foreach ((array)$subjects as $s) {
            if (in_array($s, $validSubjects)) {
                $fields[] = $s;
            }
        }
        if (empty($fields)) {
            $fields = ['艺术'];
        }

        // ── 目标补全 ──
        // 用户填了 → 原样保留；没填 → 按年龄段+领域生成默认三维目标
        if (empty($objectives)) {
            $objectives = $this->getDefaultGoals($ageGroup, $fields);
        } else {
            // 用户填了但数量不够 → 补充情感目标兜底
            $lines = array_filter(explode("\n", $objectives));
            if (count($lines) < 3) {
                $objectives .= "\n3. 在集体活动中体验合作与分享的快乐。";
            }
        }

        // ── 材料补全 ──
        if (empty($materials)) {
            $materials = $this->getDefaultMaterials($theme, $fields);
        }

        // ── 额外要求清洗 ──
        // 防止用户填入恶意内容或超长文本
        $extra = mb_substr($extra, 0, 200);

        return compact('ageGroup', 'fields', 'theme', 'duration', 'objectives', 'materials', 'extra');
    }

    /**
     * 按年龄段生成默认三维目标
     */
    private function getDefaultGoals(string $age, array $fields): string
    {
        $commonGoal = match ($age) {
            '3-4岁' => "1. 对活动主题产生兴趣，愿意参与集体活动。\n2. 在老师帮助下尝试简单的操作。\n3. 体验活动的乐趣，愿意表达自己的想法。",
            '5-6岁' => "1. 能自主观察和探索活动主题，发现基本特征。\n2. 尝试独立完成操作任务，遇到困难愿意寻求帮助。\n3. 在活动中能与同伴合作，分享自己的发现和作品。",
            default => "1. 感知活动主题的基本特征，能用自己的语言描述。\n2. 能尝试动手操作，锻炼手部精细动作。\n3. 在集体活动中体验快乐，愿意与同伴交流。",
        };

        // 如果是科学领域，强化探究目标
        if (in_array('科学', $fields)) {
            $commonGoal = str_replace(
                '感知活动主题的基本特征',
                '通过观察和比较，发现活动主题的基本特征',
                $commonGoal
            );
        }

        return $commonGoal;
    }

    /**
     * 按主题生成默认材料清单
     */
    private function getDefaultMaterials(string $theme, array $fields): string
    {
        $baseMaterials = [
            '彩泥或超轻粘土',
            'A4画纸或卡纸',
            '水彩笔或油画棒',
            '安全剪刀',
            '胶棒',
        ];

        // 按领域补充
        if (in_array('科学', $fields)) {
            $baseMaterials[] = '放大镜';
            $baseMaterials[] = '观察记录表';
        }
        if (in_array('健康', $fields)) {
            $baseMaterials[] = '体育器材（如球、圈）';
        }

        // 按主题补充
        $themeMaterials = [
            '春天' => ['彩色皱纹纸', '绿色卡纸'],
            '动物' => ['动物卡片', '毛绒玩偶'],
            '节日' => ['节日装饰品', '彩带'],
            '颜色' => ['色卡', '彩色透明片'],
        ];

        foreach ($themeMaterials as $keyword => $items) {
            if (mb_strpos($theme, $keyword) !== false) {
                $baseMaterials = array_merge($baseMaterials, $items);
                break;
            }
        }

        return implode('、', array_unique($baseMaterials));
    }


    // ════════════════════════════════════════════
    //  第二步：构造结构化 Prompt
    // ════════════════════════════════════════════

    /**
     * 教案 Prompt 模板
     * 核心：角色设定 + 格式要求 + 用户输入 + 生成约束
     */
    private function buildLessonPlanPrompt(array $inputs): string
    {
        $fieldsStr = implode('、', $inputs['fields']);

        $extraNote = !empty($inputs['extra'])
            ? "\n- **额外要求（必须满足）**：{$inputs['extra']}"
            : '';

        return <<<PROMPT
你是一位拥有10年经验的幼儿园骨干教师，擅长设计符合《3-6岁儿童学习与发展指南》的教案。
请根据以下信息，生成一份结构完整、环节清晰、可直接使用的幼儿园教案。

---

**教案必须包含以下5个部分：**

## 一、活动目标
- 认知目标：（1-2条，具体可观察、可评估）
- 能力目标：（1-2条，使用行为动词如"能够说出""能够画出"）
- 情感目标：（1条）

## 二、活动准备
- 经验准备：幼儿需具备的前期经验
- 材料准备：具体的教具/材料清单
- 环境准备：场地/座位布置要求（如有）

## 三、活动过程
### （一）导入环节（约{$this->extractMinutes($inputs['duration'], 1)}分钟）
用具体活动名称引入，含教师提问语。

### （二）基本环节（约{$this->extractMinutes($inputs['duration'], 2)}分钟）
分2-3个小步骤，每个步骤需写明：
- 教师做什么（示范、提问、指导）
- 幼儿做什么（操作、讨论、展示）
- 关键提问语（"师：""幼："格式）

### （三）结束环节（约{$this->extractMinutes($inputs['duration'], 3)}分钟）
总结活动 + 自然过渡。

## 四、活动延伸
- 区域活动延伸：（具体玩法和材料）
- 家园共育：（家长配合的具体建议）

## 五、教学反思
- 至少预设2个可能出现的问题
- 每个问题给出应对策略

---

**用户提供的具体信息：**

- 年龄段：{$inputs['ageGroup']}
- 活动主题：{$inputs['theme']}
- 活动时长：{$inputs['duration']}
- 教学领域：{$fieldsStr}（融合活动）
- 活动目标（重点参考）：{$inputs['objectives']}
- 活动材料：{$inputs['materials']}{$extraNote}

---

**生成要求：**
1. 语言亲切口语化，适合教师直接朗读或执行
2. 活动目标必须与《3-6岁儿童学习与发展指南》保持一致
3. 活动过程必须具体，包含"教师说什么话、做什么动作"以及"幼儿可能的反应"
4. 材料优先使用用户提供的清单中的物品
5. 每个环节标注预估时间
6. 输出格式为Markdown，使用标题和列表
7. **只输出教案正文，不要加任何开头语、结束语或额外说明**

请开始生成。
PROMPT;
    }

    /**
     * 文案 Prompt 模板
     */
    private function buildCopyPrompt(string $type, string $theme, ?string $extra = null): string
    {
        $typeMap = [
            'notice'     => '幼儿园通知/告家长书',
            'wechat'     => '微信公众号推文',
            'summary'    => '教学总结/周反馈',
            'message'    => '家长沟通话术',
        ];

        $typeName = $typeMap[$type] ?? '文案';
        $extraText = $extra ? "\n\n额外要求：{$extra}" : '';

        return <<<PROMPT
你是一位幼儿园老师，请写一份{$typeName}。

【主题】{$theme}{$extraText}

要求：
- 语气亲切温暖，体现专业度
- 使用日常语言，避免过于官方
- 200-500字左右
- 可直接使用

注意：只输出文案内容，不要加任何说明。
PROMPT;
    }


    // ════════════════════════════════════════════
    //  第三步：AI 调用
    // ════════════════════════════════════════════

    /**
     * 调用 DeepSeek 聊天接口
     */
    protected function chat(string $prompt, float $temperature = 0.7, int $maxTokens = 3072): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type'  => 'application/json',
        ])->timeout(120)->post($this->endpoint, [
            'model'       => 'deepseek-chat',
            'messages'    => [
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => $temperature,
            'max_tokens'  => $maxTokens,
        ]);

        if ($response->failed()) {
            $status = $response->status();
            $body = $response->body();
            Log::error('DeepSeek API 错误 [' . $status . ']: ' . $body);
            if ($status === 408 || $status === 504 || strpos($body, 'timeout') !== false || strpos($body, 'timed out') !== false) {
                throw new \Exception('AI 思考时间过长，请简化要求后重试');
            }
            throw new \Exception('AI 服务暂时不可用，请稍后重试');
        }

        return $response->json();
    }

    protected function chatWithRetry(string $prompt, float $temperature = 0.7, int $maxTokens = 3072, int $retries = 1): array
    {
        $attempt = 0;
        while ($attempt <= $retries) {
            try {
                return $this->chat($prompt, $temperature, $maxTokens);
            } catch (\Exception $e) {
                $attempt++;
                if ($attempt > $retries) {
                    throw $e;
                }
                sleep(1);
            }
        }
        throw new \Exception('AI 服务暂时不可用');
    }


    // ════════════════════════════════════════════
    //  第四步：输出校验
    // ════════════════════════════════════════════

    /**
     * 校验 AI 输出内容是否完整
     * 检查是否包含了教案的必要部分
     */
    private function validateOutput(string $content): string
    {
        $requiredSections = [
            '活动目标',
            '活动准备',
            '活动过程',
            '活动延伸',
            '教学反思',
        ];

        $missing = [];
        foreach ($requiredSections as $section) {
            if (mb_strpos($content, $section) === false) {
                $missing[] = $section;
            }
        }

        if (!empty($missing)) {
            // 缺失部分时加个提示，但不抛异常（让用户看到部分内容）
            $hint = "\n\n---\n⚠️ **AI生成的教案缺少以下部分：" . implode('、', $missing) . "**";
            $content .= $hint;
        }

        return $content;
    }


    // ════════════════════════════════════════════
    //  辅助方法
    // ════════════════════════════════════════════

    /**
     * 根据总时长分配各环节分钟数
     */
    private function extractMinutes(string $duration, int $part): int
    {
        preg_match('/(\d+)/', $duration, $m);
        $total = (int)($m[1] ?? 25);

        return match ($part) {
            1 => max(3, (int)($total * 0.15)),
            2 => max(10, (int)($total * 0.60)),
            3 => max(2, (int)($total * 0.15)),
            default => 5,
        };
    }
}
