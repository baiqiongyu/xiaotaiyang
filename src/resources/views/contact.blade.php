<x-app-layout>
    <x-slot name="header">
        联系我们
    </x-slot>

    {{-- 成功提示 --}}
    @if (session('status') === 'message-sent')
        <div style="padding:16px 20px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;font-size:14px;color:#166534;margin-bottom:24px;text-align:center;">
            ✅ 留言已发送，感谢你的反馈！ 🌸
        </div>
    @endif

    {{-- 发表留言 --}}
    <div class="app-card" style="margin-bottom:28px;">
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
                <textarea name="message" required rows="4"
                          style="width:100%;padding:14px 16px;border:1.5px solid #f0d6d0;border-radius:12px;font-size:15px;color:#4a3728;background:#fefcfb;outline:none;resize:vertical;min-height:120px;line-height:1.6;box-sizing:border-box;font-family:inherit;"
                          placeholder="请详细描述你的问题或想法...">{{ old('message') }}</textarea>
                @error('message')<div style="font-size:12px;color:#e85d5d;margin-top:4px;">{{ $message }}</div>@enderror
            </div>
            <button type="submit" style="padding:12px 40px;border:none;border-radius:10px;font-size:15px;font-weight:600;color:#fff;background:linear-gradient(135deg,#f97373,#f9a8d4);cursor:pointer;box-shadow:0 3px 10px rgba(249,115,115,.2);">
                发送留言
            </button>
        </form>
    </div>

    {{-- 我的留言 --}}
    <h3 style="font-size:16px;font-weight:600;color:#4a3728;margin-bottom:16px;">📋 我的留言</h3>

    @forelse ($messages as $msg)
        <div class="app-card" style="margin-bottom:12px;padding:20px 24px;">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:12px;">
                <div style="flex:1;">
                    <div style="font-size:14px;font-weight:600;color:#4a3728;">{{ $msg->subject }}</div>
                    <div style="font-size:13px;color:#8b6f5e;margin-top:8px;line-height:1.6;white-space:pre-wrap;">{{ $msg->message }}</div>
                </div>
                <div style="text-align:right;flex-shrink:0;">
                    <div style="font-size:11px;color:#b89a8a;">{{ $msg->created_at->format('Y-m-d H:i') }}</div>
                    @if ($msg->is_read)
                        <span style="display:inline-block;margin-top:4px;padding:2px 8px;background:#f0fdf4;border-radius:10px;font-size:11px;color:#16a34a;">已回复</span>
                    @else
                        <span style="display:inline-block;margin-top:4px;padding:2px 8px;background:#fef2f2;border-radius:10px;font-size:11px;color:#e85d5d;">待回复</span>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div style="text-align:center;padding:40px 20px;color:#8b6f5e;font-size:14px;">
            还没有留言记录 💬 上方表单可以给我们留言
        </div>
    @endforelse

    {{-- 分页 --}}
    @if ($messages->hasPages())
        <div style="margin-top:20px;">
            {{ $messages->links() }}
        </div>
    @endif
</x-app-layout>
