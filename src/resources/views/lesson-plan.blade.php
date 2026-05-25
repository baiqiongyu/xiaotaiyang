<x-app-layout>
    <x-slot name="header">
        教案 & 活动生成
    </x-slot>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
        {{-- ═══ 左：表单 ═══ --}}
        <div class="app-card" style="padding:28px;">
            <h3 style="font-size:16px;font-weight:700;color:#4a3728;margin-bottom:4px;">📝 填写活动信息</h3>
            <p style="font-size:12px;color:#8b6f5e;margin-bottom:20px;">填写以下信息，AI 将为你生成完整的教案</p>

            <form method="POST" action="{{ route('lesson-plan.generate') }}">
                @csrf

                {{-- 活动名称 --}}
                <div style="margin-bottom:16px;">
                    <label style="display:block;font-size:13px;font-weight:600;color:#5c4a3a;margin-bottom:6px;">活动名称</label>
                    <input name="theme" type="text" required value="{{ old('theme', '春天的小花园') }}"
                           style="width:100%;padding:11px 14px;border:1.5px solid #f0d6d0;border-radius:10px;font-size:14px;color:#4a3728;background:#fefcfb;outline:none;box-sizing:border-box;">
                </div>

                {{-- 年龄段 + 时长 一行 --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:16px;">
                    <div>
                        <label style="display:block;font-size:13px;font-weight:600;color:#5c4a3a;margin-bottom:6px;">年龄段</label>
                        <select name="age_group" required
                                style="width:100%;padding:11px 14px;border:1.5px solid #f0d6d0;border-radius:10px;font-size:14px;color:#4a3728;background:#fefcfb;outline:none;">
                            <option value="3-4岁">3-4岁（小班）</option>
                            <option value="4-5岁" selected>4-5岁（中班）</option>
                            <option value="5-6岁">5-6岁（大班）</option>
                        </select>
                    </div>
                    <div>
                        <label style="display:block;font-size:13px;font-weight:600;color:#5c4a3a;margin-bottom:6px;">活动时长</label>
                        <select name="duration" required
                                style="width:100%;padding:11px 14px;border:1.5px solid #f0d6d0;border-radius:10px;font-size:14px;color:#4a3728;background:#fefcfb;outline:none;">
                            <option value="15-20分钟">15-20分钟</option>
                            <option value="20-25分钟" selected>20-25分钟</option>
                            <option value="25-30分钟">25-30分钟</option>
                            <option value="30-35分钟">30-35分钟</option>
                        </select>
                    </div>
                </div>

                {{-- 教学领域（多选） --}}
                <div style="margin-bottom:16px;">
                    <label style="display:block;font-size:13px;font-weight:600;color:#5c4a3a;margin-bottom:8px;">教学领域 <span style="font-weight:400;color:#8b6f5e;">（可多选）</span></label>
                    <div style="display:flex;flex-wrap:wrap;gap:8px;">
                        @php $subjects = old('subjects', ['艺术']); @endphp
                        @foreach (['语言','科学','艺术','健康','社会'] as $s)
                            <label style="display:flex;align-items:center;gap:6px;padding:6px 14px;border:1.5px solid #f0d6d0;border-radius:8px;font-size:13px;color:#4a3728;cursor:pointer;background:#fff;transition:all .15s;"
                                   onmouseover="this.style.borderColor='#f97373'"
                                   onmouseout="this.style.borderColor='#f0d6d0'">
                                <input type="checkbox" name="subjects[]" value="{{ $s }}"
                                       {{ in_array($s, $subjects) ? 'checked' : '' }}
                                       style="accent-color:#f97373;width:16px;height:16px;">
                                {{ $s }}
                            </label>
                        @endforeach
                    </div>
                    <div style="font-size:11px;color:#b89a8a;margin-top:4px;">选择1-2个领域，AI 将侧重设计融合活动</div>
                </div>

                {{-- 活动目标 --}}
                <div style="margin-bottom:16px;">
                    <label style="display:block;font-size:13px;font-weight:600;color:#5c4a3a;margin-bottom:6px;">🎯 活动目标</label>
                    <textarea name="objectives" rows="3"
                              style="width:100%;padding:11px 14px;border:1.5px solid #f0d6d0;border-radius:10px;font-size:14px;color:#4a3728;background:#fefcfb;outline:none;resize:vertical;font-family:inherit;box-sizing:border-box;line-height:1.6;"
                              placeholder="例：&#10;1. 通过观察和讨论，认识春天常见的3种花卉&#10;2. 尝试用搓、压、贴的方式制作花朵，锻炼手部精细动作&#10;3. 在集体创作中体验合作的快乐">{{ old('objectives') }}</textarea>
                    <div style="font-size:11px;color:#b89a8a;margin-top:4px;">💡 在这里输入《3-6岁儿童学习与发展指南》中的具体目标，AI 会更专业</div>
                </div>

                {{-- 活动准备 --}}
                <div style="margin-bottom:16px;">
                    <label style="display:block;font-size:13px;font-weight:600;color:#5c4a3a;margin-bottom:6px;">📦 活动准备 / 材料</label>
                    <textarea name="materials" rows="2"
                              style="width:100%;padding:11px 14px;border:1.5px solid #f0d6d0;border-radius:10px;font-size:14px;color:#4a3728;background:#fefcfb;outline:none;resize:vertical;font-family:inherit;box-sizing:border-box;line-height:1.6;"
                              placeholder="例：彩泥、彩色皱纹纸、胶棒、A3画纸、音乐《春天在哪里》">{{ old('materials') }}</textarea>
                </div>

                {{-- 额外要求 --}}
                <div style="margin-bottom:20px;">
                    <label style="display:block;font-size:13px;font-weight:600;color:#5c4a3a;margin-bottom:6px;">额外要求 <span style="font-weight:400;color:#8b6f5e;">（选填）</span></label>
                    <textarea name="extra_notes" rows="2"
                              style="width:100%;padding:11px 14px;border:1.5px solid #f0d6d0;border-radius:10px;font-size:14px;color:#4a3728;background:#fefcfb;outline:none;resize:vertical;font-family:inherit;box-sizing:border-box;line-height:1.6;"
                              placeholder="例：侧重动手操作、融入绘本故事、结合安全常规">{{ old('extra_notes') }}</textarea>
                </div>

                <button type="submit" id="generate-btn"
                        style="width:100%;padding:13px 20px;border:none;border-radius:10px;font-size:15px;font-weight:600;color:#fff;background:linear-gradient(135deg,#f97373,#f9a8d4);cursor:pointer;box-shadow:0 3px 10px rgba(249,115,115,.2);transition:all .2s;">
                    🤖 AI 生成完整教案
                </button>
            </form>
        </div>

        {{-- ═══ 右：预览 ═══ --}}
        <div class="app-card" style="padding:28px;min-height:500px;">
            <h3 style="font-size:16px;font-weight:700;color:#4a3728;margin-bottom:4px;">📖 教案预览</h3>
            <p style="font-size:12px;color:#8b6f5e;margin-bottom:20px;">由 AI 助手生成，可根据实际情况调整</p>

            @if (!empty($result))
                <div style="max-height:700px;overflow-y:auto;padding-right:4px;">
                    {!! $result !!}
                </div>
                <div style="margin-top:20px;padding:12px 16px;background:#fefce8;border:1px solid #fde68a;border-radius:10px;font-size:12px;color:#92400e;">
                    ⚠️ 教案由 AI 生成，请根据班级实际情况调整后使用
                </div>
            @elseif (!empty($error))
                <div style="text-align:center;padding:60px 20px;color:#e85d5d;">
                    <div style="font-size:48px;margin-bottom:12px;">😵</div>
                    <div style="font-size:14px;">{{ $error }}</div>
                </div>
            @else
                <div style="text-align:center;padding:80px 20px;">
                    <div style="font-size:56px;margin-bottom:16px;opacity:.3;">📝</div>
                    <div style="font-size:15px;color:#b89a8a;">填写左侧信息</div>
                    <div style="font-size:13px;color:#d4b8a8;margin-top:4px;">点击生成，AI 将为你设计完整教案</div>
                </div>
            @endif
        </div>
    </div>
{{-- 加载遮罩 --}}
<div id="loading-overlay" style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(255,248,245,.85);backdrop-filter:blur(4px);flex-direction:column;align-items:center;justify-content:center;">
    <div style="width:64px;height:64px;border-radius:50%;border:4px solid #fce4e0;border-top-color:#f97373;animation:spin .8s linear infinite;margin-bottom:20px;"></div>
    <div style="font-size:16px;font-weight:600;color:#e85d5d;">AI 正在思考中...</div>
    <div style="font-size:13px;color:#8b6f5e;margin-top:6px;">生成教案需要 10-30 秒，请耐心等待</div>
</div>

<style>
    @keyframes spin { to { transform: rotate(360deg); } }
</style>

<script>
    document.getElementById('generate-btn').addEventListener('click', function() {
        document.getElementById('loading-overlay').style.display = 'flex';
    });
</script>

</x-app-layout>
