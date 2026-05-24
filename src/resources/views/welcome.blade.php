<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>小太阳幼教站 · 陪伴每个孩子的成长</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, 'PingFang SC', 'Microsoft YaHei', sans-serif;
            color: #4a3728;
            background: #fff8f5;
        }

        /* ===== NAV ===== */
        .nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            background: rgba(255,248,245,.9);
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

        /* ===== HERO ===== */
        .hero {
            padding: 140px 24px 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .hero-bg {
            position: absolute; inset: 0;
            background: linear-gradient(180deg, #fce4e0 0%, #fff8f5 100%);
            z-index: 0;
        }
        .hero-dec {
            position: absolute; z-index: 0;
            font-size: 40px; opacity: .15;
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .hero-content { position: relative; z-index: 1; max-width: 720px; margin: 0 auto; }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 16px; border-radius: 20px;
            background: #fce4e0; color: #e85d5d;
            font-size: 13px; font-weight: 600; margin-bottom: 24px;
        }
        .hero h1 {
            font-size: 48px; font-weight: 800; color: #4a3728;
            line-height: 1.2; margin-bottom: 20px;
        }
        .hero h1 .highlight {
            background: linear-gradient(135deg, #f97373, #f9a8d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero p {
            font-size: 18px; color: #8b6f5e; line-height: 1.7;
            margin-bottom: 36px; max-width: 560px; margin-inline: auto;
        }
        .hero-btns { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
        .hero-btn-primary {
            padding: 14px 32px; border-radius: 12px; border: none;
            background: linear-gradient(135deg, #f97373, #f9a8d4);
            color: white; font-size: 16px; font-weight: 600; cursor: pointer;
            text-decoration: none; transition: all .2s;
            box-shadow: 0 4px 14px rgba(249,115,115,.3);
        }
        .hero-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(249,115,115,.4); }
        .hero-btn-secondary {
            padding: 14px 32px; border-radius: 12px; border: 2px solid #f9a8d4;
            background: transparent; color: #e85d5d; font-size: 16px;
            font-weight: 600; cursor: pointer; text-decoration: none;
            transition: all .2s;
        }
        .hero-btn-secondary:hover { background: #fce4e0; }

        /* ===== SECTIONS ===== */
        .section {
            padding: 80px 24px;
            max-width: 1200px; margin: 0 auto;
        }
        .section-label {
            text-align: center; margin-bottom: 16px;
            font-size: 14px; font-weight: 600; color: #f97373;
            text-transform: uppercase; letter-spacing: .05em;
        }
        .section-title {
            text-align: center; font-size: 32px; font-weight: 700;
            color: #4a3728; margin-bottom: 12px;
        }
        .section-desc {
            text-align: center; font-size: 16px; color: #8b6f5e;
            max-width: 560px; margin: 0 auto 48px; line-height: 1.6;
        }

        /* ===== FEATURES ===== */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
        }
        .feature-card {
            background: white; border-radius: 16px; padding: 28px 24px;
            border: 1px solid #fce4e0;
            transition: all .25s ease; cursor: default;
        }
        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(249,115,115,.1);
            border-color: #f9a8d4;
        }
        .feature-icon {
            width: 52px; height: 52px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; margin-bottom: 16px;
        }
        .feature-card h3 {
            font-size: 16px; font-weight: 700; color: #4a3728;
            margin-bottom: 8px;
        }
        .feature-card p {
            font-size: 14px; color: #8b6f5e; line-height: 1.6;
        }

        /* ===== ABOUT ===== */
        .about-section {
            background: white; border-radius: 20px; padding: 48px;
            border: 1px solid #fce4e0;
            display: grid; grid-template-columns: 1fr 1fr; gap: 40px;
            align-items: center;
        }
        .about-section h2 {
            font-size: 28px; font-weight: 700; color: #4a3728;
            margin-bottom: 16px;
        }
        .about-section p {
            font-size: 15px; color: #8b6f5e; line-height: 1.8;
            margin-bottom: 12px;
        }
        .about-illustration {
            text-align: center; font-size: 120px; line-height: 1;
        }

        /* ===== FOOTER ===== */
        .footer {
            background: #4a3728; color: #d4c5b8;
            padding: 48px 24px 24px;
        }
        .footer-inner {
            max-width: 1200px; margin: 0 auto;
            display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 40px;
        }
        .footer h4 {
            color: white; font-size: 14px; font-weight: 600;
            margin-bottom: 16px;
        }
        .footer p, .footer a {
            font-size: 13px; color: #d4c5b8; line-height: 1.8;
            text-decoration: none; display: block;
        }
        .footer a:hover { color: #f9a8d4; }
        .footer-bottom {
            max-width: 1200px; margin: 0 auto;
            padding-top: 24px; margin-top: 40px;
            border-top: 1px solid #5a4738;
            text-align: center; font-size: 12px; color: #8b7565;
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: 32px; }
            .about-section { grid-template-columns: 1fr; }
            .about-illustration { font-size: 80px; }
            .footer-inner { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- ===== NAV ===== -->
    <nav class="nav">
        <div class="nav-inner">
            <a href="/" class="nav-logo">
                <div class="nav-logo-icon">☀️</div>
                <span class="nav-logo-text">小太阳幼教站</span>
            </a>
            <div class="nav-links">
                <a href="#features" class="nav-link">功能介绍</a>
                <a href="#about" class="nav-link">关于我们</a>
                <a href="{{ route('login') }}" class="nav-link" style="color:#e85d5d;">登录</a>
                <a href="{{ route('register') }}" class="nav-btn">免费注册</a>
            </div>
        </div>
    </nav>

    <!-- ===== HERO ===== -->
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-dec" style="top:20%;left:8%;">🌸</div>
        <div class="hero-dec" style="top:15%;right:12%;animation-delay:2s;">⭐</div>
        <div class="hero-dec" style="bottom:25%;left:15%;animation-delay:4s;">🌈</div>
        <div class="hero-dec" style="bottom:20%;right:8%;animation-delay:1s;">🦋</div>
        <div class="hero-content">
            <div class="hero-badge">✨ 专为幼师打造的贴心工具</div>
            <h1>让每一份 <span class="highlight">爱</span>，<br>都有更好的陪伴</h1>
            <p>从教案撰写到家园沟通，从环创设到成长记录——小太阳幼教站，用温暖的技术，守护每一位幼师的初心。</p>
            <div class="hero-btns">
                <a href="{{ route('register') }}" class="hero-btn-primary">免费开始使用</a>
                <a href="#features" class="hero-btn-secondary">了解功能</a>
            </div>
        </div>
    </section>

    <!-- ===== FEATURES ===== -->
    <section class="section" id="features">
        <div class="section-label">✨ 核心功能</div>
        <h2 class="section-title">幼师工作，也可以很轻松</h2>
        <p class="section-desc">我们用心的设计，只为帮你省下每一分钟，让你把更多精力留给孩子们</p>
        <div class="features">
            <div class="feature-card">
                <div class="feature-icon" style="background:#fce4e0;">📝</div>
                <h3>教案 & 文案生成</h3>
                <p>输入关键词，一键生成规范的观察记录、教案、期末评语。告别熬夜写文案。</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background:#fef3c7;">🎨</div>
                <h3>环创灵感库</h3>
                <p>按主题分类的海量环创方案，每个配材料清单和步骤说明，环创不再愁。</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background:#dbeafe;">💬</div>
                <h3>家长沟通助手</h3>
                <p>回复模板、通知公告快速生成、班级简报——让家园沟通更轻松高效。</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background:#fce7f3;">📋</div>
                <h3>班级管理工具</h3>
                <p>出勤记录、喂药登记、午睡记录、家园联系本……小工具解决大麻烦。</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background:#e0f2fe;">🌱</div>
                <h3>成长记录册</h3>
                <p>图文记录每个孩子的成长瞬间，一键生成成长档案，家长看了都感动。</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background:#f5f3ff;">🤝</div>
                <h3>更多工具持续更新</h3>
                <p>我们一直在倾听幼师的声音，不断添加新的实用工具，陪你一起成长。</p>
            </div>
        </div>
    </section>

    <!-- ===== ABOUT ===== -->
    <section class="section" id="about">
        <div class="about-section">
            <div>
                <div class="section-label" style="text-align:left;">💡 关于我们</div>
                <h2>因为懂得，所以用心</h2>
                <p>
                    小太阳幼教站的诞生，源于一位幼师家属的观察——她每天忙到深夜写教案、做环创、回复家长消息，
                    那些重复而琐碎的工作占用了太多本该属于孩子的时光。
                </p>
                <p>
                    我们想用技术的力量，把幼师从繁琐的文案工作中解放出来，
                    让她们有更多时间去陪伴、去观察、去爱那些可爱的孩子们。
                </p>
                <p style="font-weight:600;color:#e85d5d;">
                    小太阳，愿每个幼师都能被温柔以待 🌻
                </p>
            </div>
            <div class="about-illustration">
                🌻
                <div style="font-size:16px;color:#8b6f5e;margin-top:16px;">
                    每一个认真工作的你<br>
                    都值得被看见
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CTA ===== -->
    <section style="text-align:center;padding:60px 24px 80px;max-width:600px;margin:0 auto;">
        <div style="font-size:48px;margin-bottom:16px;">☀️</div>
        <h2 style="font-size:28px;font-weight:700;color:#4a3728;margin-bottom:12px;">准备好试试了吗？</h2>
        <p style="font-size:16px;color:#8b6f5e;margin-bottom:32px;line-height:1.6;">
            完全免费，注册即可使用所有工具<br>
            让我们一起，把每一份爱都用在最珍贵的地方
        </p>
        <a href="{{ route('register') }}" class="hero-btn-primary" style="display:inline-block;">
            立即免费注册
        </a>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
        <div class="footer-inner">
            <div>
                <h4 style="display:flex;align-items:center;gap:8px;">
                    <span>☀️</span> 小太阳幼教站
                </h4>
                <p>用温暖的技术，守护每一位幼师的初心。</p>
                <p style="margin-top:8px;">为爱而生，因你而在 💕</p>
            </div>
            <div>
                <h4>快速链接</h4>
                <a href="#features">功能介绍</a>
                <a href="#about">关于我们</a>
                <a href="{{ route('login') }}">登录</a>
                <a href="{{ route('register') }}">注册</a>
            </div>
            <div>
                <h4>联系我们</h4>
                <a>💬 留言板（即将上线）</a>
                <a>📧 xiaotaiyang@email.com</a>
                <a>更多联系方式敬请期待</a>
            </div>
        </div>
        <div class="footer-bottom">
            © {{ date('Y') }} 小太阳幼教站 · 用爱陪伴成长
        </div>
    </footer>

</body>
</html>
