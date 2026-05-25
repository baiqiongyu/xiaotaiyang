<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', '小太阳幼教站') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, 'PingFang SC', 'Microsoft YaHei', sans-serif;
            background: #fff8f5;
            color: #4a3728;
        }

        /* ── Nav ── */
        /* ===== 导航栏（复用组件样式） ===== */
        .nav {
            background: rgba(255,248,245,.92);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #fce4e0;
            height: 64px;
        }
        .nav-inner {
            max-width: 1200px; margin: 0 auto; padding: 0 24px;
            height: 100%; display: flex; align-items: center; justify-content: space-between;
        }
        .nav-logo {
            display: flex; align-items: center; gap: 10px; text-decoration: none;
        }
        .nav-logo-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #f97373, #f9a8d4);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; box-shadow: 0 2px 8px rgba(249,115,115,.3);
        }
        .nav-logo-text {
            font-size: 18px; font-weight: 700; color: #e85d5d;
        }
        .nav-links { display: flex; align-items: center; gap: 6px; }
        .nav-link {
            padding: 6px 16px; border-radius: 8px; font-size: 14px;
            font-weight: 500; color: #8b6f5e; text-decoration: none;
            transition: all .2s;
        }
        .nav-link:hover { background: #fce4e0; color: #e85d5d; }
        .nav-btn {
            padding: 8px 20px; border-radius: 8px; font-size: 14px;
            font-weight: 600; border: none; cursor: pointer;
            background: linear-gradient(135deg, #f97373, #f9a8d4);
            color: white; text-decoration: none;
            transition: all .2s; box-shadow: 0 2px 8px rgba(249,115,115,.25);
        }
        .nav-btn:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(249,115,115,.35); }

        /* ── Page header ── */
        .app-header {
            background: #fff;
            border-bottom: 1px solid #fce4e0;
            padding: 20px 24px;
        }
        .app-header-inner {
            max-width: 1200px; margin: 0 auto;
        }
        .app-header-title {
            font-size: 20px; font-weight: 700; color: #4a3728;
        }

        /* ── Content ── */
        .app-content {
            max-width: 1200px; margin: 0 auto; padding: 32px 24px;
        }

        /* ── Card ── */
        .app-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            border: 1px solid #fce4e0;
            box-shadow: 0 2px 8px rgba(232,93,93,.06);
        }
    </style>
</head>
<body>
    {{-- 导航栏组件 --}}
    <x-navbar sticky />

    {{-- Page Header --}}
    @isset($header)
        <div class="app-header">
            <div class="app-header-inner">
                <div class="app-header-title">{{ $header }}</div>
            </div>
        </div>
    @endisset

    {{-- Content --}}
    <main class="app-content">
        {{ $slot }}
    </main>
</body>
</html>
