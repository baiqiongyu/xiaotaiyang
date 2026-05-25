<x-app-layout>
    <x-slot name="header">
        控制台
    </x-slot>

    {{-- 欢迎 --}}
    <div class="app-card" style="margin-bottom:24px;text-align:center;padding:40px 24px;">
        <div style="font-size:48px;margin-bottom:12px;">☀️</div>
        <div style="font-size:22px;font-weight:700;color:#e85d5d;margin-bottom:8px;">
            欢迎回来，{{ Auth::user()->name }}！
        </div>
        <div style="font-size:14px;color:#8b6f5e;">
            你已成功登录小太阳幼教站 🌸
        </div>
    </div>

    {{-- 快捷功能 --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;margin-bottom:24px;">
        {{-- 教案生成 --}}
        <a href="#" style="text-decoration:none;">
            <div class="app-card" style="text-align:center;padding:28px 16px;cursor:pointer;transition:all .2s;">
                <div style="font-size:36px;margin-bottom:8px;">📝</div>
                <div style="font-size:14px;font-weight:600;color:#4a3728;">教案生成</div>
                <div style="font-size:12px;color:#8b6f5e;margin-top:4px;">AI 帮你写教案</div>
            </div>
        </a>

        {{-- 环创灵感 --}}
        <a href="#" style="text-decoration:none;">
            <div class="app-card" style="text-align:center;padding:28px 16px;cursor:pointer;transition:all .2s;">
                <div style="font-size:36px;margin-bottom:8px;">🎨</div>
                <div style="font-size:14px;font-weight:600;color:#4a3728;">环创灵感</div>
                <div style="font-size:12px;color:#8b6f5e;margin-top:4px;">环境创设参考</div>
            </div>
        </a>

        {{-- 家长沟通 --}}
        <a href="#" style="text-decoration:none;">
            <div class="app-card" style="text-align:center;padding:28px 16px;cursor:pointer;transition:all .2s;">
                <div style="font-size:36px;margin-bottom:8px;">💬</div>
                <div style="font-size:14px;font-weight:600;color:#4a3728;">家长沟通</div>
                <div style="font-size:12px;color:#8b6f5e;margin-top:4px;">沟通话术助手</div>
            </div>
        </a>

        {{-- 班级管理 --}}
        <a href="#" style="text-decoration:none;">
            <div class="app-card" style="text-align:center;padding:28px 16px;cursor:pointer;transition:all .2s;">
                <div style="font-size:36px;margin-bottom:8px;">📋</div>
                <div style="font-size:14px;font-weight:600;color:#4a3728;">班级管理</div>
                <div style="font-size:12px;color:#8b6f5e;margin-top:4px;">学生花名册</div>
            </div>
        </a>
    </div>

    {{-- 个人资料 --}}
    <div class="app-card">
        <div style="font-size:15px;font-weight:600;color:#4a3728;margin-bottom:12px;">账号信息</div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;font-size:13px;color:#8b6f5e;">
            <div>
                <span style="color:#4a3728;font-weight:500;">姓名：</span>{{ Auth::user()->name }}
            </div>
            <div>
                <span style="color:#4a3728;font-weight:500;">邮箱：</span>{{ Auth::user()->email }}
            </div>
        </div>
        <div style="margin-top:16px;">
            <a href="{{ route('profile.edit') }}" style="display:inline-block;padding:8px 20px;border-radius:8px;font-size:13px;font-weight:600;color:#fff;background:linear-gradient(135deg,#f97373,#f9a8d4);text-decoration:none;box-shadow:0 2px 8px rgba(249,115,115,.2);">
                编辑资料
            </a>
        </div>
    </div>
</x-app-layout>
