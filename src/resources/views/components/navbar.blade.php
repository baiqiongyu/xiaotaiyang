@props(['fixed' => false, 'sticky' => false])

{{-- 导航栏组件 --}}
<nav class="nav" @if($fixed) style="position:fixed;top:0;left:0;right:0;z-index:100;" @elseif($sticky) style="position:sticky;top:0;z-index:100;" @endif>
    <div class="nav-inner">
        <a href="/" class="nav-logo">
            <span class="nav-logo-icon">☀️</span>
            <span class="nav-logo-text">小太阳幼教站</span>
        </a>

        <div class="nav-links">
            <a href="/#features" class="nav-link">功能介绍</a>
            <a href="/#about" class="nav-link">关于我们</a>

            @auth
                {{-- 已登录：圆头像 + 名称 + 退出 --}}
                <div class="nav-user" x-data="{ open: false }" @click.outside="open = false">
                    <button @click="open = !open" class="nav-user-btn">
                        <span class="nav-avatar">{{ mb_substr(Auth::user()->name, 0, 1) }}</span>
                        <span class="nav-user-name">{{ Auth::user()->name }}</span>
                        <svg class="nav-chevron" :class="{ 'rotated': open }" width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M3 5l3 3 3-3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </button>
                    {{-- 下拉 --}}
                    <div x-show="open" class="nav-dropdown" @click="open = false" x-cloak>
                        <a href="{{ route('profile.edit') }}" class="nav-dropdown-item">
                            <span>👤</span> 个人中心
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-dropdown-item" style="width:100%;text-align:left;border:none;background:none;cursor:pointer;">
                                <span>🚪</span> 退出登录
                            </button>
                        </form>
                    </div>
                </div>
            @else
                {{-- 未登录 --}}
                <a href="{{ route('login') }}" class="nav-link" style="color:#e85d5d;">登录</a>
                <a href="{{ route('register') }}" class="nav-btn">免费注册</a>
            @endauth
        </div>
    </div>
</nav>

<style>
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

    [x-cloak] { display: none !important; }
</style>
