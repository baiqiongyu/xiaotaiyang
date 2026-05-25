<x-guest-layout>
    <div class="auth-title">验证邮箱 ✉️</div>
    <div class="auth-subtitle" style="margin-bottom:24px;">
        感谢注册！我们已发送验证链接到你的邮箱，
        请点击邮件中的链接完成验证。
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="auth-session-status">
            新的验证链接已发送到你的注册邮箱 📨
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" style="margin-top:8px;">
        @csrf
        <button type="submit" class="auth-btn" style="margin-bottom:10px;">重新发送验证邮件</button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <div class="auth-footer">
            <button type="submit" style="background:none;border:none;color:#e85d5d;font-weight:600;font-size:13px;cursor:pointer;text-decoration:underline;">
                退出登录
            </button>
        </div>
    </form>
</x-guest-layout>
