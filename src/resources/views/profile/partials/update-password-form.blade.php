<section>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div style="margin-bottom:16px;">
            <label for="current_password" style="display:block;font-size:13px;font-weight:600;color:#5c4a3a;margin-bottom:6px;">当前密码</label>
            <input id="current_password" name="current_password" type="password" required
                   style="width:100%;padding:10px 14px;border:1.5px solid #f0d6d0;border-radius:12px;font-size:14px;color:#4a3728;background:#fefcfb;outline:none;">
            @error('current_password', 'updatePassword')
                <div style="font-size:12px;color:#e85d5d;margin-top:4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom:16px;">
            <label for="new_password" style="display:block;font-size:13px;font-weight:600;color:#5c4a3a;margin-bottom:6px;">新密码</label>
            <input id="new_password" name="password" type="password" required
                   style="width:100%;padding:10px 14px;border:1.5px solid #f0d6d0;border-radius:12px;font-size:14px;color:#4a3728;background:#fefcfb;outline:none;">
            @error('password', 'updatePassword')
                <div style="font-size:12px;color:#e85d5d;margin-top:4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom:16px;">
            <label for="password_confirmation" style="display:block;font-size:13px;font-weight:600;color:#5c4a3a;margin-bottom:6px;">确认新密码</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
                   style="width:100%;padding:10px 14px;border:1.5px solid #f0d6d0;border-radius:12px;font-size:14px;color:#4a3728;background:#fefcfb;outline:none;">
            @error('password_confirmation', 'updatePassword')
                <div style="font-size:12px;color:#e85d5d;margin-top:4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="display:flex;align-items:center;gap:12px;">
            <button type="submit" style="padding:10px 24px;border:none;border-radius:10px;font-size:14px;font-weight:600;color:#fff;background:linear-gradient(135deg,#f97373,#f9a8d4);cursor:pointer;box-shadow:0 2px 8px rgba(249,115,115,.2);">保存</button>

            @if (session('status') === 'password-updated')
                <span x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
                      style="font-size:13px;color:#16a34a;">已更新 ✅</span>
            @endif
        </div>
    </form>
</section>
