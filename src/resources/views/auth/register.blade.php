<x-guest-layout>
    {{-- Title --}}
    <div class="auth-title">加入小太阳 ☀️</div>
    <div class="auth-subtitle">创建一个新账号，开启幼教之旅</div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Name --}}
        <div class="auth-field">
            <label for="name" class="auth-label">姓名</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                   class="auth-input" placeholder="请输入你的名字">
            @error('name')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="auth-field">
            <label for="email" class="auth-label">邮箱地址</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                   class="auth-input" placeholder="请输入邮箱">
            @error('email')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="auth-field">
            <label for="password" class="auth-label">密码</label>
            <input id="password" type="password" name="password" required
                   class="auth-input" placeholder="不少于8位字符">
            @error('password')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="auth-field">
            <label for="password_confirmation" class="auth-label">确认密码</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                   class="auth-input" placeholder="再次输入密码">
            @error('password_confirmation')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Submit --}}
        <button type="submit" class="auth-btn">注 册</button>

        {{-- Login link --}}
        <div class="auth-footer">
            已有账号？<a href="{{ route('login') }}">立即登录</a>
        </div>
    </form>
</x-guest-layout>
