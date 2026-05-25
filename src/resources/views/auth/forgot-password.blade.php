<x-guest-layout>
    <div class="auth-title">找回密码 🔑</div>
    <div class="auth-subtitle" style="margin-bottom:24px;">
        输入你的邮箱地址，我们会发送重置链接给你
    </div>

    @if (session('status'))
        <div class="auth-session-status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="auth-field">
            <label for="email" class="auth-label">邮箱地址</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="auth-input" placeholder="请输入注册时的邮箱">
            @error('email')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="auth-btn">发送重置链接</button>

        <div class="auth-footer">
            <a href="{{ route('login') }}">← 返回登录</a>
        </div>
    </form>
</x-guest-layout>
