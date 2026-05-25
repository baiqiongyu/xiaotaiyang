<x-app-layout>
    <x-slot name="header">
        联系我们
    </x-slot>

    {{-- 页面说明 --}}
    <div style="text-align:center;margin-bottom:32px;">
        <div style="font-size:36px;margin-bottom:8px;">💬</div>
        <div style="font-size:13px;color:#8b6f5e;">有疑问或建议？填写下方表单，我们会尽快回复</div>
    </div>

    {{-- 成功提示 --}}
    @if (session('status') === 'message-sent')
        <div style="padding:16px 20px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;font-size:14px;color:#166534;margin-bottom:24px;text-align:center;">
            ✅ 留言已发送，感谢你的反馈！我们会尽快联系你 🌸
        </div>
    @endif

    {{-- 表单 --}}
    <div class="app-card" style="max-width:640px;margin:0 auto;padding:36px 32px;">
        <form method="POST" action="{{ route('contact.store') }}">
            @csrf

            {{-- 姓名 --}}
            <div style="margin-bottom:20px;">
                <label for="name" style="display:block;font-size:14px;font-weight:600;color:#5c4a3a;margin-bottom:8px;">
                    姓名 <span style="color:#e85d5d;">*</span>
                </label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                       style="width:100%;padding:14px 16px;border:1.5px solid #f0d6d0;border-radius:12px;font-size:15px;color:#4a3728;background:#fefcfb;outline:none;box-sizing:border-box;"
                       placeholder="你的名字">
                @error('name')<div style="font-size:12px;color:#e85d5d;margin-top:4px;">{{ $message }}</div>@enderror
            </div>

            {{-- 邮箱 --}}
            <div style="margin-bottom:20px;">
                <label for="email" style="display:block;font-size:14px;font-weight:600;color:#5c4a3a;margin-bottom:8px;">
                    邮箱 <span style="color:#e85d5d;">*</span>
                </label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                       style="width:100%;padding:14px 16px;border:1.5px solid #f0d6d0;border-radius:12px;font-size:15px;color:#4a3728;background:#fefcfb;outline:none;box-sizing:border-box;"
                       placeholder="用于接收回复">
                @error('email')<div style="font-size:12px;color:#e85d5d;margin-top:4px;">{{ $message }}</div>@enderror
            </div>

            {{-- 电话 --}}
            <div style="margin-bottom:20px;">
                <label for="phone" style="display:block;font-size:14px;font-weight:600;color:#5c4a3a;margin-bottom:8px;">电话</label>
                <input id="phone" name="phone" type="text" value="{{ old('phone') }}"
                       style="width:100%;padding:14px 16px;border:1.5px solid #f0d6d0;border-radius:12px;font-size:15px;color:#4a3728;background:#fefcfb;outline:none;box-sizing:border-box;"
                       placeholder="选填">
            </div>

            {{-- 主题 --}}
            <div style="margin-bottom:20px;">
                <label for="subject" style="display:block;font-size:14px;font-weight:600;color:#5c4a3a;margin-bottom:8px;">
                    主题 <span style="color:#e85d5d;">*</span>
                </label>
                <input id="subject" name="subject" type="text" value="{{ old('subject') }}" required
                       style="width:100%;padding:14px 16px;border:1.5px solid #f0d6d0;border-radius:12px;font-size:15px;color:#4a3728;background:#fefcfb;outline:none;box-sizing:border-box;"
                       placeholder="如：合作咨询、功能建议">
                @error('subject')<div style="font-size:12px;color:#e85d5d;margin-top:4px;">{{ $message }}</div>@enderror
            </div>

            {{-- 留言内容 --}}
            <div style="margin-bottom:24px;">
                <label for="message" style="display:block;font-size:14px;font-weight:600;color:#5c4a3a;margin-bottom:8px;">
                    留言内容 <span style="color:#e85d5d;">*</span>
                </label>
                <textarea id="message" name="message" required rows="6"
                          style="width:100%;padding:14px 16px;border:1.5px solid #f0d6d0;border-radius:12px;font-size:15px;color:#4a3728;background:#fefcfb;outline:none;resize:vertical;min-height:160px;line-height:1.6;box-sizing:border-box;font-family:inherit;"
                          placeholder="请详细描述你的问题或想法...">{{ old('message') }}</textarea>
                @error('message')<div style="font-size:12px;color:#e85d5d;margin-top:4px;">{{ $message }}</div>@enderror
            </div>

            {{-- 提交 --}}
            <button type="submit" style="width:100%;padding:14px 20px;border:none;border-radius:12px;font-size:16px;font-weight:600;color:#fff;background:linear-gradient(135deg,#f97373,#f9a8d4);cursor:pointer;box-shadow:0 3px 10px rgba(249,115,115,.25);">
                发送留言
            </button>
        </form>
    </div>
</x-app-layout>
