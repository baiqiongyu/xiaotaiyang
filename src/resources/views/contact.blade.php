<x-app-layout>
    <x-slot name="header">
        联系我们
    </x-slot>

    @if (session('status') === 'message-sent')
        <div style="padding:16px 20px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;font-size:14px;color:#166534;margin-bottom:24px;text-align:center;">
            ✅ 留言已发送，感谢你的反馈！ 🌸
        </div>
    @endif

    <div class="app-card" style="margin:0 auto;">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;">
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
            <div style="margin-bottom:16px;">
                <input id="subject" name="subject" type="text" value="{{ old('subject') }}" required
                       style="width:100%;padding:14px 16px;border:1.5px solid #f0d6d0;border-radius:12px;font-size:15px;color:#4a3728;background:#fefcfb;outline:none;box-sizing:border-box;"
                       placeholder="主题，如：合作咨询、功能建议">
                @error('subject')<div style="font-size:12px;color:#e85d5d;margin-top:4px;">{{ $message }}</div>@enderror
            </div>
            <div style="margin-bottom:16px;">
                <textarea name="message" required rows="5"
                          style="width:100%;padding:14px 16px;border:1.5px solid #f0d6d0;border-radius:12px;font-size:15px;color:#4a3728;background:#fefcfb;outline:none;resize:vertical;min-height:140px;line-height:1.6;box-sizing:border-box;font-family:inherit;"
                          placeholder="请详细描述你的问题或想法...">{{ old('message') }}</textarea>
                @error('message')<div style="font-size:12px;color:#e85d5d;margin-top:4px;">{{ $message }}</div>@enderror
            </div>
            <button type="submit" style="padding:12px 40px;border:none;border-radius:10px;font-size:15px;font-weight:600;color:#fff;background:linear-gradient(135deg,#f97373,#f9a8d4);cursor:pointer;box-shadow:0 3px 10px rgba(249,115,115,.2);">
                发送留言
            </button>
        </form>
    </div>
</x-app-layout>
