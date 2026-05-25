<section>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div style="margin-bottom:16px;">
            <label for="name" style="display:block;font-size:13px;font-weight:600;color:#5c4a3a;margin-bottom:6px;">姓名</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                   style="width:100%;padding:10px 14px;border:1.5px solid #f0d6d0;border-radius:12px;font-size:14px;color:#4a3728;background:#fefcfb;outline:none;">
            @error('name')
                <div style="font-size:12px;color:#e85d5d;margin-top:4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom:16px;">
            <label for="email" style="display:block;font-size:13px;font-weight:600;color:#5c4a3a;margin-bottom:6px;">邮箱</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                   style="width:100%;padding:10px 14px;border:1.5px solid #f0d6d0;border-radius:12px;font-size:14px;color:#4a3728;background:#fefcfb;outline:none;">
            @error('email')
                <div style="font-size:12px;color:#e85d5d;margin-top:4px;">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div style="margin-top:8px;">
                    <p style="font-size:13px;color:#8b6f5e;">邮箱未验证，
                        <button form="send-verification" style="background:none;border:none;color:#e85d5d;font-weight:600;font-size:13px;cursor:pointer;text-decoration:underline;padding:0;">
                            重新发送验证邮件
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p style="font-size:12px;color:#16a34a;margin-top:4px;">新验证链接已发送到你的邮箱 📨</p>
                    @endif
                </div>
            @endif
        </div>

        <div style="display:flex;align-items:center;gap:12px;">
            <button type="submit" style="padding:10px 24px;border:none;border-radius:10px;font-size:14px;font-weight:600;color:#fff;background:linear-gradient(135deg,#f97373,#f9a8d4);cursor:pointer;box-shadow:0 2px 8px rgba(249,115,115,.2);">保存</button>

            @if (session('status') === 'profile-updated')
                <span x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
                      style="font-size:13px;color:#16a34a;">已保存 ✅</span>
            @endif
        </div>
    </form>
</section>
