<x-app-layout>
    <x-slot name="header">
        教案 & 文案生成
    </x-slot>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;align-items:start;">
        {{-- 左：表单 --}}
        <div class="app-card">
            <h3 style="font-size:15px;font-weight:600;color:#4a3728;margin-bottom:16px;">📝 生成教案</h3>

            <form method="POST" action="{{ route('lesson-plan.generate') }}">
                @csrf

                <div style="margin-bottom:14px;">
                    <label style="display:block;font-size:13px;font-weight:600;color:#5c4a3a;margin-bottom:6px;">年龄段</label>
                    <select name="age_group" required
                            style="width:100%;padding:10px 14px;border:1.5px solid #f0d6d0;border-radius:10px;font-size:14px;color:#4a3728;background:#fefcfb;outline:none;">
                        <option value="3-4岁">3-4岁（小班）</option>
                        <option value="4-5岁" selected>4-5岁（中班）</option>
                        <option value="5-6岁">5-6岁（大班）</option>
                    </select>
                </div>

                <div style="margin-bottom:14px;">
                    <label style="display:block;font-size:13px;font-weight:600;color:#5c4a3a;margin-bottom:6px;">教学领域</label>
                    <select name="subject" required
                            style="width:100%;padding:10px 14px;border:1.5px solid #f0d6d0;border-radius:10px;font-size:14px;color:#4a3728;background:#fefcfb;outline:none;">
                        <option value="语言">语言</option>
                        <option value="科学">科学</option>
                        <option value="艺术" selected>艺术</option>
                        <option value="健康">健康</option>
                        <option value="社会">社会</option>
                        <option value="综合">综合</option>
                    </select>
                </div>

                <div style="margin-bottom:14px;">
                    <label style="display:block;font-size:13px;font-weight:600;color:#5c4a3a;margin-bottom:6px;">活动主题</label>
                    <input name="theme" type="text" required value="{{ old('theme', '春天的小花园') }}"
                           style="width:100%;padding:10px 14px;border:1.5px solid #f0d6d0;border-radius:10px;font-size:14px;color:#4a3728;background:#fefcfb;outline:none;box-sizing:border-box;"
                           placeholder="如：春天、动物朋友、中秋节">
                </div>

                <div style="margin-bottom:14px;">
                    <label style="display:block;font-size:13px;font-weight:600;color:#5c4a3a;margin-bottom:6px;">活动时长</label>
                    <select name="duration" required
                            style="width:100%;padding:10px 14px;border:1.5px solid #f0d6d0;border-radius:10px;font-size:14px;color:#4a3728;background:#fefcfb;outline:none;">
                        <option value="15-20分钟">15-20分钟</option>
                        <option value="20-25分钟" selected>20-25分钟</option>
                        <option value="25-30分钟">25-30分钟</option>
                        <option value="30-35分钟">30-35分钟</option>
                    </select>
                </div>

                <div style="margin-bottom:20px;">
                    <label style="display:block;font-size:13px;font-weight:600;color:#5c4a3a;margin-bottom:6px;">额外要求（选填）</label>
                    <textarea name="extra_notes" rows="2"
                              style="width:100%;padding:10px 14px;border:1.5px solid #f0d6d0;border-radius:10px;font-size:14px;color:#4a3728;background:#fefcfb;outline:none;resize:vertical;font-family:inherit;box-sizing:border-box;"
                              placeholder="如：侧重动手操作、融入绘本故事">{{ old('extra_notes') }}</textarea>
                </div>

                <button type="submit"
                        style="width:100%;padding:12px 20px;border:none;border-radius:10px;font-size:15px;font-weight:600;color:#fff;background:linear-gradient(135deg,#f97373,#f9a8d4);cursor:pointer;box-shadow:0 3px 10px rgba(249,115,115,.2);">
                    🤖 AI 生成教案
                </button>
            </form>
        </div>

        {{-- 右：结果 --}}
        <div class="app-card" style="min-height:400px;">
            @if (!empty($result))
                <div style="max-height:600px;overflow-y:auto;padding:4px;">
                    {!! $result !!}
                </div>
            @elseif (!empty($error))
                <div style="text-align:center;padding:40px;color:#e85d5d;">
                    ❌ {{ $error }}
                </div>
            @else
                <div style="text-align:center;padding:60px 20px;color:#b89a8a;">
                    <div style="font-size:48px;margin-bottom:12px;">📖</div>
                    <div style="font-size:14px;">填写左侧表单，点击生成</div>
                    <div style="font-size:12px;margin-top:4px;">AI 将为你生成完整的教案</div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
