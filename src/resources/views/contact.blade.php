<x-app-layout>
    <x-slot name="header">
        联系我们
    </x-slot>

    {{-- 成功提示 --}}
    @if (session('status') === 'message-sent')
        <div style="padding:16px 20px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;font-size:14px;color:#166534;margin-bottom:24px;text-align:center;">
            ✅ 留言已发送，感谢你的反馈！我们会尽快联系你 🌸
        </div>
    @endif

    {{-- 当前用户信息 --}}
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;padding:16px 20px;background:#fff;border:1px solid #fce4e0;border-radius:12px;">
        <span class="nav-avatar" style="width:36px;height:36px;font-size:15px;">
            @if (Auth::user()->avatar)
                <img src="{{ asset(Auth::user()->avatar) }}?{{ time() }}" alt="" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
            @else
                {{ mb_substr(Auth::user()->name, 0, 1) }}
            @endif
        </span>
        <div>
            <div style="font-size:14px;font-weight:600;color:#4a3728;">{{ Auth::user()->name }}</div>
            <div style="font-size:12px;color:#8b6f5e;">{{ Auth::user()->email }}</div>
        </div>
    </div>

    <form method="POST" action="{{ route('contact.store') }}">
        @csrf

        {{-- 主题 --}}
        <div style="margin-bottom:20px;">
            <label for="subject" style="display:block;font-size:14px;font-weight:600;color:#5c4a3a;margin-bottom:8px;">
                主题 <span style="color:#e85d5d;">*</span>
            </label>
            <input id="subject" name="subject" type="text" value="{{ old('subject') }}" required
                   style="width:100%;padding:14px 16px;border:1.5px solid #f0d6d0;border-radius:12px;font-size:15px;color:#4a3728;background:#fefcfb;outline:none;box-sizing:border-box;"
                   placeholder="如：合作咨询、功能建议、问题反馈">
            @error('subject')<div style="font-size:12px;color:#e85d5d;margin-top:4px;">{{ $message }}</div>@enderror
        </div>

        {{-- 留言内容 --}}
        <div style="margin-bottom:24px;">
            <label for="message" style="display:block;font-size:14px;font-weight:600;color:#5c4a3a;margin-bottom:8px;">
                留言内容 <span style="color:#e85d5d;">*</span>
            </label>
            <textarea id="message" name="message" required rows="6"
                      style="width:100%;padding:14px 16px;border:1.5px solid #f0d6d0;border-radius:12px;font-size:15px;color:#4a3728;background:#fefcfb;outline:none;resize:vertical;min-height:180px;line-height:1.6;box-sizing:border-box;font-family:inherit;"
                      placeholder="请详细描述你的问题或想法...">{{ old('message') }}</textarea>
            @error('message')<div style="font-size:12px;color:#e85d5d;margin-top:4px;">{{ $message }}</div>@enderror
        </div>

        {{-- 提交 --}}
        <button type="submit" style="padding:14px 48px;border:none;border-radius:12px;font-size:16px;font-weight:600;color:#fff;background:linear-gradient(135deg,#f97373,#f9a8d4);cursor:pointer;box-shadow:0 3px 10px rgba(249,115,115,.25);">
            发送留言
        </button>
    </form>
</x-app-layout>
