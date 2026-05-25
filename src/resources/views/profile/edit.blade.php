<x-app-layout>
    {{-- 操作成功提示 --}}
    @if (session('status') === 'avatar-updated')
        <div style="padding:12px 20px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;font-size:13px;color:#166534;margin-bottom:16px;">✅ 头像已更新</div>
    @elseif (session('status') === 'profile-updated')
        <div style="padding:12px 20px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;font-size:13px;color:#166534;margin-bottom:16px;">✅ 资料已保存</div>
    @elseif (session('status') === 'password-updated')
        <div style="padding:12px 20px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;font-size:13px;color:#166534;margin-bottom:16px;">✅ 密码已更新</div>
    @endif

    {{-- Hero 欢迎区 --}}
    <div style="position:relative;overflow:hidden;border-radius:20px;background:linear-gradient(135deg,#fce4e0,#fff8f5);padding:36px 32px;margin-bottom:28px;border:1px solid #fce4e0;">
        {{-- 装饰圆 --}}
        <div style="position:absolute;top:-40px;right:-20px;width:160px;height:160px;border-radius:50%;background:linear-gradient(135deg,rgba(249,115,115,.12),rgba(249,168,212,.12));"></div>
        <div style="position:absolute;bottom:-30px;left:-30px;width:100px;height:100px;border-radius:50%;background:linear-gradient(135deg,rgba(249,115,115,.08),rgba(249,168,212,.08));"></div>

        <div style="display:flex;align-items:center;gap:20px;position:relative;z-index:1;">
            {{-- 头像（可上传） --}}
            <div style="position:relative;flex-shrink:0;">
                <div style="width:64px;height:64px;border-radius:16px;overflow:hidden;box-shadow:0 4px 12px rgba(249,115,115,.3);">
                    @if (Auth::user()->avatar)
                        <img src="{{ asset(Auth::user()->avatar) }}?{{ time() }}" alt="头像" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <div style="width:100%;height:100%;background:linear-gradient(135deg,#f97373,#f9a8d4);display:flex;align-items:center;justify-content:center;font-size:24px;color:#fff;">
                            {{ mb_substr(Auth::user()->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                {{-- 上传按钮 --}}
                <label for="avatar-upload" style="position:absolute;bottom:-4px;right:-4px;width:28px;height:28px;border-radius:50%;background:#fff;border:2px solid #f0d6d0;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:14px;box-shadow:0 2px 6px rgba(0,0,0,.08);">📷</label>
                <form id="avatar-form" action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input id="avatar-upload" type="file" name="avatar" accept="image/jpeg,image/png,image/gif,image/webp" onchange="document.getElementById('avatar-form').submit()" style="display:none;">
                </form>
            </div>
            <div style="flex:1;">
                <div style="font-size:20px;font-weight:700;color:#4a3728;">{{ Auth::user()->name }}</div>
                <div style="font-size:13px;color:#8b6f5e;margin-top:2px;">{{ Auth::user()->email }}</div>
                <div style="display:flex;gap:8px;margin-top:8px;flex-wrap:wrap;">
                    <span style="padding:3px 12px;background:#fff;border-radius:20px;font-size:11px;color:#e85d5d;font-weight:500;border:1px solid #f0d6d0;">幼教老师</span>
                    <span style="padding:3px 12px;background:#fff;border-radius:20px;font-size:11px;color:#e85d5d;font-weight:500;border:1px solid #f0d6d0;">☀️ 小太阳</span>
                    <span style="padding:3px 12px;background:#fff;border-radius:20px;font-size:11px;color:#8b6f5e;font-weight:500;border:1px solid #f0d6d0;">加入 {{ substr(Auth::user()->created_at ?? '2026-05', 0, 7) }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- 数据概览 --}}
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:28px;">
        <div class="app-card" style="text-align:center;padding:20px 12px;">
            <div style="font-size:24px;font-weight:700;color:#e85d5d;">0</div>
            <div style="font-size:12px;color:#8b6f5e;margin-top:4px;">我的教案</div>
        </div>
        <div class="app-card" style="text-align:center;padding:20px 12px;">
            <div style="font-size:24px;font-weight:700;color:#e85d5d;">0</div>
            <div style="font-size:12px;color:#8b6f5e;margin-top:4px;">我的收藏</div>
        </div>
        <a href="{{ route('contact.my-messages') }}" class="app-card" style="text-align:center;padding:20px 12px;text-decoration:none;display:block;">
            <div style="font-size:24px;font-weight:700;color:#e85d5d;">{{ \App\Models\Contact::where('user_id', Auth::id())->count() }}</div>
            <div style="font-size:12px;color:#8b6f5e;margin-top:4px;">留言数 →</div>
        </a>
        <div class="app-card" style="text-align:center;padding:20px 12px;">
            <div style="font-size:24px;font-weight:700;color:#e85d5d;">1</div>
            <div style="font-size:12px;color:#8b6f5e;margin-top:4px;">使用天数</div>
        </div>
    </div>

    {{-- 功能入口 --}}
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:28px;">
        <a href="{{ route('lesson-plan.index') }}" class="app-card" style="text-align:center;padding:24px 12px;text-decoration:none;display:block;cursor:pointer;transition:all .2s;">
            <div style="font-size:32px;margin-bottom:8px;">📝</div>
            <div style="font-size:13px;font-weight:600;color:#4a3728;">教案生成</div>
            <div style="font-size:11px;color:#8b6f5e;margin-top:2px;">AI 帮你写教案</div>
        </a>
        <a href="#" class="app-card" style="text-align:center;padding:24px 12px;text-decoration:none;display:block;cursor:pointer;transition:all .2s;">
            <div style="font-size:32px;margin-bottom:8px;">🎨</div>
            <div style="font-size:13px;font-weight:600;color:#4a3728;">灵感收藏</div>
            <div style="font-size:11px;color:#8b6f5e;margin-top:2px;">环创素材收藏夹</div>
        </a>
        <a href="{{ route('contact.show') }}" class="app-card" style="text-align:center;padding:24px 12px;text-decoration:none;display:block;cursor:pointer;transition:all .2s;">
            <div style="font-size:32px;margin-bottom:8px;">💬</div>
            <div style="font-size:13px;font-weight:600;color:#4a3728;">我的留言</div>
            <div style="font-size:11px;color:#8b6f5e;margin-top:2px;">留言反馈记录</div>
        </a>
        <a href="#" class="app-card" style="text-align:center;padding:24px 12px;text-decoration:none;display:block;cursor:pointer;transition:all .2s;">
            <div style="font-size:32px;margin-bottom:8px;">📊</div>
            <div style="font-size:13px;font-weight:600;color:#4a3728;">使用报告</div>
            <div style="font-size:11px;color:#8b6f5e;margin-top:2px;">数据统计分析</div>
        </a>
    </div>

    {{-- 账号设置区 --}}
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">
        <div class="app-card">
            <div style="font-size:15px;font-weight:600;color:#4a3728;margin-bottom:16px;">📋 基本资料</div>
            @include('profile.partials.update-profile-information-form')
        </div>
        <div class="app-card">
            <div style="font-size:15px;font-weight:600;color:#4a3728;margin-bottom:16px;">🔒 安全设置</div>
            @include('profile.partials.update-password-form')
        </div>
    </div>

    {{-- 删除账号 --}}
    <div class="app-card" style="border-color:#fecaca;">
        @include('profile.partials.delete-user-form')
    </div>
</x-app-layout>
