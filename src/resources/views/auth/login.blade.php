<x-guest-layout>
    {{-- Session Status --}}
    @if (session('status'))
        <div class="auth-session-status">{{ session('status') }}</div>
    @endif

    {{-- Title --}}
    <div class="auth-title">欢迎回来 🌸</div>
    <div class="auth-subtitle">登录你的小太阳账号</div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="auth-field">
            <label for="email" class="auth-label">邮箱地址</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="auth-input" placeholder="请输入邮箱">
            @error('email')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="auth-field">
            <label for="password" class="auth-label">密码</label>
            <input id="password" type="password" name="password" required
                   class="auth-input" placeholder="请输入密码">
            @error('password')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Remember + Forgot --}}
        <div class="auth-field" style="display:flex;align-items:center;justify-content:space-between;">
            <label class="auth-checkbox">
                <input type="checkbox" name="remember" id="remember_me">
                记住我
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="font-size:13px;color:#e85d5d;text-decoration:none;font-weight:500;">
                    忘记密码？
                </a>
            @endif
        </div>

        {{-- Submit --}}
        <button type="submit" class="auth-btn">登 录</button>

        {{-- Register link --}}
        <div class="auth-footer">
            还没有账号？<a href="{{ route('register') }}">立即注册</a>
        </div>
    </form>
</x-guest-layout>
