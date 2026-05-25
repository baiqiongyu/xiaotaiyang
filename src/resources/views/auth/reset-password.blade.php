<x-guest-layout>
    <div class="auth-title">重置密码 🔑</div>
    <div class="auth-subtitle" style="margin-bottom:24px;">请设置一个新密码</div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="auth-field">
            <label for="email" class="auth-label">邮箱地址</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
                   class="auth-input" placeholder="邮箱">
            @error('email')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="auth-field">
            <label for="password" class="auth-label">新密码</label>
            <input id="password" type="password" name="password" required
                   class="auth-input" placeholder="不少于8位字符">
            @error('password')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="auth-field">
            <label for="password_confirmation" class="auth-label">确认新密码</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                   class="auth-input" placeholder="再次输入新密码">
            @error('password_confirmation')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="auth-btn">重置密码</button>
    </form>
</x-guest-layout>
