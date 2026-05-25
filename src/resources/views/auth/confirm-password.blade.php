<x-guest-layout>
    <div class="auth-title">验证身份 🔒</div>
    <div class="auth-subtitle" style="margin-bottom:24px;">
        这是安全区域，请先确认密码
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="auth-field">
            <label for="password" class="auth-label">密码</label>
            <input id="password" type="password" name="password" required
                   class="auth-input" placeholder="请输入当前密码">
            @error('password')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="auth-btn">确认</button>

        <div class="auth-footer">
            <a href="{{ route('login') }}">← 返回登录</a>
        </div>
    </form>
</x-guest-layout>
