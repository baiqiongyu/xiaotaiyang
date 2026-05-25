<?php

namespace App\Http\Controllers;

use App\Services\DeepSeekService;
use Illuminate\Http\Request;

class LessonPlanController extends Controller
{
    public function index()
    {
        return view('lesson-plan', ['result' => null, 'error' => null]);
    }

    public function generate(Request $request, DeepSeekService $deepseek)
    {
        $data = $request->validate([
            'age_group'   => ['required', 'string', 'in:3-4岁,4-5岁,5-6岁'],
            'subject'     => ['required', 'string', 'in:语言,科学,艺术,健康,社会,综合'],
            'theme'       => ['required', 'string', 'max:100'],
            'duration'    => ['required', 'string', 'in:15-20分钟,20-25分钟,25-30分钟,30-35分钟'],
            'extra_notes' => ['nullable', 'string', 'max:500'],
        ]);

        try {
            $raw = $deepseek->generateLessonPlan($data);
            $result = $this->markdownToHtml($raw);

            return view('lesson-plan', [
                'result' => $result,
                'error'  => null,
            ])->withInput();
        } catch (\Exception $e) {
            return view('lesson-plan', [
                'result' => null,
                'error'  => $e->getMessage(),
            ])->withInput();
        }
    }

    /**
     * 简单 Markdown 转 HTML
     */
    private function markdownToHtml(string $text): string
    {
        $lines = explode("\n", $text);
        $html = '';
        $inList = false;

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) {
                if ($inList) { $html .= "</ul>"; $inList = false; }
                continue;
            }
            if (preg_match('/^##\s+(.+)/', $line, $m)) {
                if ($inList) { $html .= "</ul>"; $inList = false; }
                $html .= '<h3 style="font-size:16px;font-weight:700;color:#4a3728;margin:20px 0 10px;">' . e($m[1]) . '</h3>';
                continue;
            }
            if (preg_match('/^###\s+(.+)/', $line, $m)) {
                if ($inList) { $html .= "</ul>"; $inList = false; }
                $html .= '<h4 style="font-size:14px;font-weight:600;color:#e85d5d;margin:14px 0 8px;">' . e($m[1]) . '</h4>';
                continue;
            }
            if (preg_match('/^[-*]\s+(.+)/', $line, $m)) {
                if (!$inList) { $html .= '<ul style="padding-left:20px;margin:6px 0;">'; $inList = true; }
                $html .= '<li style="font-size:14px;color:#4a3728;line-height:1.8;">' . e($m[1]) . '</li>';
                continue;
            }
            if ($inList) { $html .= "</ul>"; $inList = false; }
            $html .= '<p style="font-size:14px;color:#4a3728;line-height:1.8;margin:6px 0;">' . e($line) . '</p>';
        }
        if ($inList) $html .= "</ul>";

        $html = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $html);

        return $html;
    }
}
