<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', '小太阳幼教站') }}</title>

    <!-- Fonts -->
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

        /* ── 页面容器 ── */
        .auth-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: linear-gradient(180deg, #fff8f5 0%, #fce4e0 100%);
        }

        /* ── 卡片 ── */
        .auth-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border-radius: 24px;
            padding: 40px 36px;
            box-shadow: 0 8px 32px rgba(232, 93, 93, 0.10);
            border: 1px solid #fce4e0;
        }

        /* ── Logo区 ── */
        .auth-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
            margin-bottom: 32px;
        }
        .auth-logo-icon {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, #f97373, #f9a8d4);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            box-shadow: 0 3px 10px rgba(249,115,115,.3);
        }
        .auth-logo-text {
            font-size: 22px; font-weight: 700;
            color: #e85d5d;
        }

        /* ── 标题 ── */
        .auth-title {
            font-size: 20px;
            font-weight: 700;
            text-align: center;
            color: #4a3728;
            margin-bottom: 6px;
        }
        .auth-subtitle {
            font-size: 14px;
            text-align: center;
            color: #8b6f5e;
            margin-bottom: 28px;
        }

        /* ── 表单标签 ── */
        .auth-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #5c4a3a;
            margin-bottom: 6px;
        }

        /* ── 输入框 ── */
        .auth-input {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #f0d6d0;
            border-radius: 12px;
            font-size: 14px;
            color: #4a3728;
            background: #fefcfb;
            outline: none;
            transition: all .2s;
        }
        .auth-input:focus {
            border-color: #f97373;
            box-shadow: 0 0 0 3px rgba(249,115,115,.12);
        }
        .auth-input::placeholder {
            color: #c4a99a;
        }

        /* ── 错误提示 ── */
        .auth-error {
            font-size: 12px;
            color: #e85d5d;
            margin-top: 4px;
        }

        /* ── 按钮 ── */
        .auth-btn {
            width: 100%;
            padding: 12px 20px;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(135deg, #f97373, #f9a8d4);
            cursor: pointer;
            transition: all .2s;
            box-shadow: 0 3px 10px rgba(249,115,115,.25);
        }
        .auth-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 16px rgba(249,115,115,.35);
        }
        .auth-btn:active {
            transform: translateY(0);
        }

        /* ── 底部链接 ── */
        .auth-footer {
            text-align: center;
            margin-top: 24px;
            font-size: 13px;
            color: #8b6f5e;
        }
        .auth-footer a {
            color: #e85d5d;
            font-weight: 600;
            text-decoration: none;
            transition: color .2s;
        }
        .auth-footer a:hover {
            color: #f97373;
        }

        /* ── 输入组间距 ── */
        .auth-field {
            margin-bottom: 18px;
        }

        /* ── Checkbox ── */
        .auth-checkbox {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #8b6f5e;
            cursor: pointer;
        }
        .auth-checkbox input[type="checkbox"] {
            width: 16px; height: 16px;
            border-radius: 4px;
            border: 1.5px solid #f0d6d0;
            accent-color: #f97373;
        }

        /* ── Session Status ── */
        .auth-session-status {
            padding: 10px 14px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            font-size: 13px;
            color: #166534;
            margin-bottom: 18px;
        }
    </style>
</head>
<body>
    <div class="auth-page">
        <div class="auth-card">
            {{-- Logo --}}
            <a href="/" class="auth-logo">
                <span class="auth-logo-icon">☀️</span>
                <span class="auth-logo-text">小太阳幼教站</span>
            </a>

            {{ $slot }}
        </div>
    </div>
</body>
</html>
