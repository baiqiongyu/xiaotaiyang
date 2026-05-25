@props(['fixed' => false, 'sticky' => false])

{{-- 导航栏组件 --}}
<nav class="nav" x-data="{ mobileOpen: false }" @if($fixed) style="position:fixed;top:0;left:0;right:0;z-index:100;" @elseif($sticky) style="position:sticky;top:0;z-index:100;" @endif>
    <div class="nav-inner">
        <a href="/" class="nav-logo">
            <span class="nav-logo-icon">☀️</span>
            <span class="nav-logo-text">小太阳幼教站</span>
        </a>

        {{-- 桌面端导航 --}}
        <div class="nav-links-desktop">
            <a href="/#features" class="nav-link">功能介绍</a>
            <a href="/#about" class="nav-link">关于我们</a>
            <a href="{{ route('contact.show') }}" class="nav-link">联系我们</a>

            @auth
                <div class="nav-user" x-data="{ open: false }" @click.outside="open = false">
                    <button @click="open = !open" class="nav-user-btn">
                        <span class="nav-avatar">
                            @if (Auth::user()->avatar)
                                <img src="{{ asset(Auth::user()->avatar) }}?{{ time() }}" alt="" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                            @else
                                {{ mb_substr(Auth::user()->name, 0, 1) }}
                            @endif
                        </span>
                        <span class="nav-user-name nav-user-name-desk">{{ Auth::user()->name }}</span>
                        <svg class="nav-chevron" :class="{ 'rotated': open }" width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M3 5l3 3 3-3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </button>
                    <div x-show="open" class="nav-dropdown" @click="open = false" x-cloak>
                        <a href="{{ route('profile.edit') }}" class="nav-dropdown-item"><span>👤</span> 个人中心</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-dropdown-item" style="width:100%;text-align:left;border:none;background:none;cursor:pointer;"><span>🚪</span> 退出登录</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="nav-link" style="color:#e85d5d;">登录</a>
                <a href="{{ route('register') }}" class="nav-btn">免费注册</a>
            @endauth
        </div>

        {{-- 移动端汉堡按钮 --}}
        <button @click="mobileOpen = !mobileOpen" class="nav-hamburger" aria-label="菜单">
            <span :class="{'open': mobileOpen}" class="hamburger-icon">
                <span></span><span></span><span></span>
            </span>
        </button>
    </div>

    {{-- 移动端下拉菜单 --}}
    <div x-show="mobileOpen" class="nav-mobile" @click="mobileOpen = false" x-cloak>
        <a href="/#features" class="nav-mobile-link">功能介绍</a>
        <a href="/#about" class="nav-mobile-link">关于我们</a>
        <a href="{{ route('contact.show') }}" class="nav-mobile-link">联系我们</a>
        @auth
            <div style="border-top:1px solid #fce4e0;margin:8px 16px;"></div>
            <div style="display:flex;align-items:center;gap:10px;padding:12px 24px;color:#e85d5d;font-weight:600;">
                <span class="nav-avatar" style="width:28px;height:28px;font-size:12px;">
                    @if (Auth::user()->avatar)
                        <img src="{{ asset(Auth::user()->avatar) }}?{{ time() }}" alt="" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                    @else
                        {{ mb_substr(Auth::user()->name, 0, 1) }}
                    @endif
                </span>
                {{ Auth::user()->name }}
            </div>
            <a href="{{ route('profile.edit') }}" class="nav-mobile-link">👤 个人中心</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-mobile-link" style="width:100%;text-align:left;border:none;background:none;cursor:pointer;">🚪 退出登录</button>
            </form>
        @else
            <div style="border-top:1px solid #fce4e0;margin:8px 16px;"></div>
            <a href="{{ route('login') }}" class="nav-mobile-link" style="color:#e85d5d;">登录</a>
            <a href="{{ route('register') }}" class="nav-mobile-link" style="color:#e85d5d;font-weight:600;">免费注册</a>
        @endauth
    </div>
</nav>

<style>
    /* ── 桌面端导航 ── */
    .nav-links-desktop { display: flex; align-items: center; gap: 6px; }
    .nav-hamburger { display: none; background: none; border: none; cursor: pointer; padding: 8px; }

    .hamburger-icon { display: flex; flex-direction: column; gap: 4px; padding: 4px; }
    .hamburger-icon span {
        display: block; width: 20px; height: 2px;
        background: #8b6f5e; border-radius: 2px;
        transition: all .2s;
    }
    .hamburger-icon.open span:nth-child(1) { transform: rotate(45deg) translate(4px, 4px); }
    .hamburger-icon.open span:nth-child(2) { opacity: 0; }
    .hamburger-icon.open span:nth-child(3) { transform: rotate(-45deg) translate(4px, -4px); }

    .nav-user { position: relative; margin-left: 8px; }
    .nav-user-btn {
        display: flex; align-items: center; gap: 8px;
        padding: 4px 12px 4px 4px;
        border: 1.5px solid #f0d6d0; border-radius: 24px;
        background: #fff; cursor: pointer;
        transition: all .2s; font-family: inherit;
    }
    .nav-user-btn:hover { border-color: #f97373; box-shadow: 0 2px 8px rgba(249,115,115,.12); }
    .nav-avatar {
        width: 32px; height: 32px; border-radius: 50%;
        background: linear-gradient(135deg, #f97373, #f9a8d4);
        display: flex; align-items: center; justify-content: center;
        font-size: 14px; font-weight: 600; color: #fff; flex-shrink: 0;
    }
    .nav-user-name { font-size: 13px; font-weight: 500; color: #4a3728; }
    .nav-chevron { color: #8b6f5e; transition: transform .2s; }
    .nav-chevron.rotated { transform: rotate(180deg); }

    .nav-dropdown {
        position: absolute; top: calc(100% + 6px); right: 0;
        min-width: 160px; background: #fff;
        border: 1px solid #f0d6d0; border-radius: 12px;
        box-shadow: 0 8px 24px rgba(232,93,93,.10);
        overflow: hidden; z-index: 200;
    }
    .nav-dropdown-item {
        display: flex; align-items: center; gap: 8px;
        padding: 10px 16px; font-size: 13px; color: #4a3728;
        text-decoration: none; transition: background .15s;
    }
    .nav-dropdown-item:hover { background: #fff8f5; }
    .nav-dropdown-item + .nav-dropdown-item { border-top: 1px solid #fce4e0; }

    /* ── 移动端菜单 ── */
    .nav-mobile {
        position: absolute; top: 100%; left: 0; right: 0;
        background: #fff; border-bottom: 1px solid #fce4e0;
        box-shadow: 0 8px 24px rgba(232,93,93,.08);
        padding: 8px 0 16px; z-index: 200;
    }
    .nav-mobile-link {
        display: block; padding: 10px 24px;
        font-size: 14px; color: #4a3728; text-decoration: none;
        transition: background .15s;
    }
    .nav-mobile-link:hover { background: #fff8f5; }

    [x-cloak] { display: none !important; }

    /* ── 响应式：≤768px 隐藏桌面导航，显示汉堡 ── */
    @media (max-width: 768px) {
        .nav-links-desktop { display: none; }
        .nav-hamburger { display: flex; align-items: center; }
    }
</style>
