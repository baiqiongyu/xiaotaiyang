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

    /**
     * 调用 DeepSeek 生成教案
     *
     * @param array $params [
     *   'age_group'    => '3-4岁|4-5岁|5-6岁',
     *   'subject'      => '语言|科学|艺术|健康|社会',
     *   'theme'        => '春天/动物/节日...',
     *   'duration'     => '20-25分钟',
     *   'extra_notes'  => '额外要求（选填）',
     * ]
     * @return string 生成的教案HTML/文本
     */
    public function generateLessonPlan(array $params): string
    {
        $prompt = $this->buildLessonPlanPrompt($params);

        $result = $this->chat($prompt, 0.7, 2048);

        return $result['choices'][0]['message']['content'] ?? '生成失败，请重试';
    }

    /**
     * 调用 DeepSeek 生成文案
     */
    public function generateCopy(string $type, string $theme, ?string extra = null): string
    {
        $prompt = $this->buildCopyPrompt($type, $theme, $extra);

        $result = $this->chat($prompt, 0.8, 1024);

        return $result['choices'][0]['message']['content'] ?? '生成失败，请重试';
    }

    /**
     * 聊天接口
     */
    protected function chat(string $prompt, float $temperature = 0.7, int $maxTokens = 2048): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type'  => 'application/json',
        ])->timeout(60)->post($this->endpoint, [
            'model'       => 'deepseek-chat',
            'messages'    => [
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => $temperature,
            'max_tokens'  => $maxTokens,
        ]);

        if ($response->failed()) {
            Log::error('DeepSeek API 错误: ' . $response->body());
            throw new \Exception('AI 服务暂时不可用，请稍后重试');
        }

        return $response->json();
    }

    /**
     * 教案提词器（核心优化）
     */
    protected function buildLessonPlanPrompt(array $params): string
    {
        $ageGroup  = $params['age_group'] ?? '4-5岁';
        $subject   = $params['subject'] ?? '综合';
        $theme     = $params['theme'] ?? '春天';
        $duration  = $params['duration'] ?? '20-25分钟';
        $extra     = $params['extra_notes'] ?? '';

        return <<<PROMPT
你是一位有10年经验的幼儿园骨干教师，请为{$ageGroup}幼儿设计一份优质教案。

【教学领域】{$subject}
【活动主题】{$theme}
【活动时长】{$duration}
【班级年龄】{$ageGroup}

请按以下结构输出（Markdown格式）：

## 一、活动目标
- 认知目标：（1-2条，具体可评估）
- 能力目标：（1-2条，用行为动词描述）
- 情感目标：（1条）

## 二、活动准备
- 经验准备：幼儿需具备的前期经验
- 材料准备：具体教具/材料清单
- 环境准备：场地布置要求

## 三、活动过程
### （一）导入环节（约{$this->extractMinutes($duration, 1)}分钟）
活动名称+具体师幼互动话术

### （二）基本环节（约{$this->extractMinutes($duration, 2)}分钟）
分2-3个小步骤，每个步骤含教师提问语和幼儿回应预设

### （三）结束环节（约{$this->extractMinutes($duration, 3)}分钟）
总结+自然过渡

## 四、活动延伸
- 区域活动延伸：（具体玩法）
- 家园共育：（家长配合建议）

## 五、教学反思
预设可能遇到的问题及应对策略

要求：
- 活动目标使用《3-6岁儿童学习与发展指南》语言
- 每个环节标注教师指导语
- 游戏化教学，趣味性强
- 活动材料用常见易得的物品
{$extra}
注意：只输出教案内容，不要输出任何其他说明。
PROMPT;
    }

    /**
     * 文案提词器
     */
    protected function buildCopyPrompt(string $type, string $theme, ?string $extra = null): string
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

    /**
     * 根据总时长分配各环节分钟数
     */
    private function extractMinutes(string $duration, int $part): int
    {
        preg_match('/(\d+)/', $duration, $m);
        $total = (int)($m[1] ?? 25);

        return match ($part) {
            1 => max(3, (int)($total * 0.15)),  // 导入 15%
            2 => max(10, (int)($total * 0.60)), // 基本 60%
            3 => max(2, (int)($total * 0.15)),  // 结束 15%
            default => 5,
        };
    }
}
