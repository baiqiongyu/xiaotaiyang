<x-app-layout>
    {{-- Hero 欢迎区 --}}
    <div style="position:relative;overflow:hidden;border-radius:20px;background:linear-gradient(135deg,#fce4e0,#fff8f5);padding:36px 32px;margin-bottom:28px;border:1px solid #fce4e0;">
        {{-- 装饰圆 --}}
        <div style="position:absolute;top:-40px;right:-20px;width:160px;height:160px;border-radius:50%;background:linear-gradient(135deg,rgba(249,115,115,.12),rgba(249,168,212,.12));"></div>
        <div style="position:absolute;bottom:-30px;left:-30px;width:100px;height:100px;border-radius:50%;background:linear-gradient(135deg,rgba(249,115,115,.08),rgba(249,168,212,.08));"></div>

        <div style="display:flex;align-items:center;gap:20px;position:relative;z-index:1;">
            {{-- 头像 --}}
            <div style="width:64px;height:64px;border-radius:16px;background:linear-gradient(135deg,#f97373,#f9a8d4);display:flex;align-items:center;justify-content:center;font-size:28px;box-shadow:0 4px 12px rgba(249,115,115,.3);flex-shrink:0;">
                ☀️
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
        <div class="app-card" style="text-align:center;padding:20px 12px;">
            <div style="font-size:24px;font-weight:700;color:#e85d5d;">0</div>
            <div style="font-size:12px;color:#8b6f5e;margin-top:4px;">创作次数</div>
        </div>
        <div class="app-card" style="text-align:center;padding:20px 12px;">
            <div style="font-size:24px;font-weight:700;color:#e85d5d;">1</div>
            <div style="font-size:12px;color:#8b6f5e;margin-top:4px;">使用天数</div>
        </div>
    </div>

    {{-- 功能入口 --}}
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:28px;">
        <a href="#" class="app-card" style="text-align:center;padding:24px 12px;text-decoration:none;display:block;cursor:pointer;transition:all .2s;">
            <div style="font-size:32px;margin-bottom:8px;">📝</div>
            <div style="font-size:13px;font-weight:600;color:#4a3728;">我的教案</div>
            <div style="font-size:11px;color:#8b6f5e;margin-top:2px;">创作和管理教案</div>
        </a>
        <a href="#" class="app-card" style="text-align:center;padding:24px 12px;text-decoration:none;display:block;cursor:pointer;transition:all .2s;">
            <div style="font-size:32px;margin-bottom:8px;">🎨</div>
            <div style="font-size:13px;font-weight:600;color:#4a3728;">灵感收藏</div>
            <div style="font-size:11px;color:#8b6f5e;margin-top:2px;">环创素材收藏夹</div>
        </a>
        <a href="#" class="app-card" style="text-align:center;padding:24px 12px;text-decoration:none;display:block;cursor:pointer;transition:all .2s;">
            <div style="font-size:32px;margin-bottom:8px;">💬</div>
            <div style="font-size:13px;font-weight:600;color:#4a3728;">沟通话术</div>
            <div style="font-size:11px;color:#8b6f5e;margin-top:2px;">家长沟通记录</div>
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
