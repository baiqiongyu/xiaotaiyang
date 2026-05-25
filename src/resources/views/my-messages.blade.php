<x-app-layout>
    <x-slot name="header">
        我的留言
    </x-slot>

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
        <div style="text-align:center;padding:60px 20px;">
            <div style="font-size:48px;margin-bottom:16px;">💬</div>
            <div style="font-size:15px;color:#8b6f5e;">还没有留言记录</div>
            <a href="{{ route('contact.show') }}" style="display:inline-block;margin-top:16px;padding:10px 28px;border-radius:10px;font-size:14px;font-weight:600;color:#fff;background:linear-gradient(135deg,#f97373,#f9a8d4);text-decoration:none;box-shadow:0 2px 8px rgba(249,115,115,.2);">去留言</a>
        </div>
    @endforelse

    @if ($messages->hasPages())
        <div style="margin-top:20px;">
            {{ $messages->links() }}
        </div>
    @endif
</x-app-layout>
