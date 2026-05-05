<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dinkes Sumenep</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-green: #198754;
            --dark-green: #0f5132;
            --accent-yellow: #ffc107;

            --bg: #f6f8fb;
            --card: #ffffff;
            --text: #111827;
            --muted: #6b7280;
            --border: rgba(0, 0, 0, .08);
        }

        * {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        .brand-title {
            font-family: 'Playfair Display', serif;
        }

        /* =========================
           TOPBAR (instansi banget)
        ========================== */
        .topbar {
            background: #0b3b24;
            color: rgba(255, 255, 255, .88);
            font-size: .85rem;
        }

        .topbar a {
            color: rgba(255, 255, 255, .88);
            text-decoration: none;
        }

        .topbar a:hover {
            color: #fff;
            text-decoration: underline;
            text-underline-offset: 4px;
        }

        /* =========================
           NAVBAR
        ========================== */
        .navbar {
            background: rgba(25, 135, 84, .96) !important;
            border-bottom: 3px solid var(--accent-yellow);
            transition: all .25s ease;
        }

        .navbar.shrink {
            padding-top: .25rem !important;
            padding-bottom: .25rem !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .15);
        }

        .navbar .nav-link {
            color: rgba(255, 255, 255, .90) !important;
            font-weight: 700;
        }

        .navbar .nav-link:hover {
            color: #fff !important;
            text-decoration: underline;
            text-underline-offset: 6px;
        }

        .brand-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-sub {
            font-family: 'Inter', sans-serif;
            letter-spacing: 2px;
            font-weight: 600;
            opacity: .92;
            font-size: .72rem;
        }

        .nav-btn {
            border-radius: 999px;
            padding: 10px 18px;
            font-weight: 800;
        }

        /* =========================
           RUNNING ANNOUNCEMENT
        ========================== */
        .announce {
            background: #fff;
            border-bottom: 1px solid var(--border);
        }

        .announce .pill {
            background: rgba(255, 193, 7, .18);
            color: #854d0e;
            border: 1px solid rgba(255, 193, 7, .35);
            font-weight: 800;
            border-radius: 999px;
            padding: 6px 12px;
            font-size: .85rem;
            white-space: nowrap;
        }

        .marquee {
            overflow: hidden;
            position: relative;
            height: 38px;
        }

        .marquee span {
            position: absolute;
            white-space: nowrap;
            will-change: transform;
            animation: marquee 18s linear infinite;
            color: #374151;
            font-weight: 600;
        }

        @keyframes marquee {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(-120%);
            }
        }

        /* =========================
           HERO
        ========================== */
        .hero {
            position: relative;
            min-height: 92vh;
            display: flex;
            align-items: center;
            color: #fff;
            background:
                linear-gradient(135deg, rgba(15, 81, 50, .92), rgba(25, 135, 84, .70)),
                url('/assets/bg-dinkes.jpg') center/cover no-repeat;
            border-bottom: 1px solid rgba(255, 255, 255, .12);
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255, 255, 255, .12) 1px, transparent 1px);
            background-size: 18px 18px;
            opacity: .22;
            pointer-events: none;
        }

        .hero::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: -1px;
            height: 100px;
            background: var(--bg);
            clip-path: ellipse(75% 100% at 50% 100%);
        }

        .hero-inner {
            position: relative;
            z-index: 2;
        }

        .badge-gov {
            background: rgba(255, 193, 7, .95);
            color: #1f2937;
            border-radius: 999px;
            padding: 8px 14px;
            font-weight: 900;
            letter-spacing: .4px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .18);
        }

        .hero-title {
            font-size: clamp(2.1rem, 4.2vw, 3.8rem);
            line-height: 1.06;
        }

        .hero-lead {
            color: rgba(255, 255, 255, .88);
            max-width: 60ch;
        }

        .hero-cta .btn {
            border-radius: 999px;
            padding: 13px 24px;
            font-weight: 900;
        }

        .hero-emblem {
            width: min(320px, 75%);
            filter: drop-shadow(0 22px 30px rgba(0, 0, 0, .35));
        }

        /* =========================
           SECTIONS
        ========================== */
        .section-padding {
            padding: 90px 0;
        }

        .section-title {
            font-size: clamp(1.7rem, 2.6vw, 2.4rem);
        }

        .title-accent {
            position: relative;
            display: inline-block;
        }

        .title-accent::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -10px;
            width: 58%;
            height: 5px;
            background: var(--accent-yellow);
            border-radius: 999px;
        }

        /* =========================
           CARDS
        ========================== */
        .custom-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 18px;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .custom-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, .10);
        }

        .feature-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(25, 135, 84, .12);
            color: var(--primary-green);
            font-size: 26px;
            box-shadow: 0 10px 20px rgba(25, 135, 84, .10);
        }

        /* =========================
           SERVICES (lebih instansi)
        ========================== */
        .service-badge {
            border-radius: 999px;
            padding: 7px 12px;
            font-weight: 800;
            font-size: .82rem;
            background: rgba(25, 135, 84, .10);
            color: var(--primary-green);
            border: 1px solid rgba(25, 135, 84, .20);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* =========================
           STATS COUNTER
        ========================== */
        .stat-box {
            background: linear-gradient(135deg, rgba(15, 81, 50, .95), rgba(25, 135, 84, .88));
            color: #fff;
            border-radius: 18px;
            border: 1px solid rgba(255, 255, 255, .12);
        }

        .stat-num {
            font-size: 2.2rem;
            font-weight: 900;
            line-height: 1;
        }

        .stat-label {
            color: rgba(255, 255, 255, .86);
            font-weight: 700;
        }

        /* =========================
           TIMELINE / FLOW
        ========================== */
        .flow-step {
            position: relative;
            padding-left: 52px;
        }

        .flow-step::before {
            content: "";
            position: absolute;
            left: 18px;
            top: 6px;
            width: 14px;
            height: 14px;
            border-radius: 999px;
            background: var(--accent-yellow);
            box-shadow: 0 8px 18px rgba(255, 193, 7, .28);
        }

        .flow-step::after {
            content: "";
            position: absolute;
            left: 24px;
            top: 24px;
            bottom: -10px;
            width: 2px;
            background: rgba(0, 0, 0, .08);
        }

        .flow-step:last-child::after {
            display: none;
        }

        /* =========================
           PROFILE
        ========================== */
        .profile-img {
            width: 128px;
            height: 128px;
            object-fit: cover;
            border: 6px solid #eaf7ee;
            box-shadow: 0 14px 24px rgba(0, 0, 0, .10);
            transition: .25s ease;
        }

        .profile-img:hover {
            border-color: rgba(255, 193, 7, .9);
            transform: rotate(1.2deg);
        }

        /* =========================
           CONTACT BOX
        ========================== */
        .contact-box {
            background: #111827;
            border-radius: 18px;
            border-left: 6px solid var(--accent-yellow);
        }

        .contact-item {
            display: flex;
            gap: 12px;
            align-items: center;
            padding: 10px 0;
            color: rgba(255, 255, 255, .88);
        }

        .contact-badge {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, .10);
            color: #fff;
        }

        /* =========================
           FOOTER
        ========================== */
        footer {
            background: #0b1220;
            padding: 60px 0 30px;
        }

        .footer-link {
            color: rgba(255, 255, 255, .65);
            text-decoration: none;
        }

        .footer-link:hover {
            color: #fff;
        }

        .footer-meta {
            color: rgba(255, 255, 255, .55);
            risky: none;
        }

        /* =========================
           Back to top
        ========================== */
        .to-top {
            position: fixed;
            right: 18px;
            bottom: 18px;
            width: 48px;
            height: 48px;
            border-radius: 999px;
            border: none;
            background: var(--primary-green);
            color: #fff;
            box-shadow: 0 14px 28px rgba(0, 0, 0, .20);
            display: none;
            z-index: 999;
        }

        .to-top.show {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 992px) {
            .hero {
                min-height: 88vh;
            }

            .hero::after {
                height: 80px;
            }
        }

        /* =========================
           NEWS SLIDER (Berita geser kanan)
        ========================== */
        .news-slider {
            position: relative;
        }

        .news-track {
            display: flex;
            gap: 18px;
            overflow-x: auto;
            padding: 6px 2px 14px;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        .news-track::-webkit-scrollbar {
            height: 10px;
        }

        .news-track::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, .12);
            border-radius: 999px;
        }

        .news-track::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, .04);
            border-radius: 999px;
        }

        .news-item {
            flex: 0 0 auto;
            width: 340px;
            scroll-snap-align: start;
        }

        @media (max-width: 992px) {
            .news-item {
                width: 300px;
            }
        }

        @media (max-width: 576px) {
            .news-item {
                width: 86vw;
            }
        }

        .news-nav-btn {
            position: absolute;
            top: 40%;
            transform: translateY(-50%);
            width: 44px;
            height: 44px;
            border-radius: 999px;
            border: 1px solid rgba(0, 0, 0, .10);
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 14px 28px rgba(0, 0, 0, .12);
            z-index: 5;
            transition: .2s ease;
        }

        .news-nav-btn:hover {
            transform: translateY(-50%) scale(1.05);
        }

        .news-nav-btn.prev {
            left: -12px;
        }

        .news-nav-btn.next {
            right: -12px;
        }

        @media (max-width: 576px) {
            .news-nav-btn.prev {
                left: 6px;
            }

            .news-nav-btn.next {
                right: 6px;
            }
        }

        .news-slider-pad {
            padding-left: 24px;
            padding-right: 24px;
        }
    </style>
</head>

<body>


    {{-- TOPBAR --}}
    <div class="topbar py-2">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                <div class="d-flex flex-wrap gap-3 align-items-center">
                    <span class="d-inline-flex align-items-center gap-2">
                        <i class="bi bi-geo-alt-fill text-warning"></i>
                        <span>Jl. Jokotole No. 05 Sumenep</span>
                    </span>
                    <span class="d-inline-flex align-items-center gap-2">
                        <i class="bi bi-telephone-fill text-warning"></i>
                        <span>(0328) 662122</span>
                    </span>
                    <span class="d-none d-md-inline-flex align-items-center gap-2">
                        <i class="bi bi-envelope-fill text-warning"></i>
                        <a href="mailto:dinkessumenep@gmail.com">dinkessumenep@gmail.com</a>
                    </span>
                </div>

                <div class="d-flex gap-2 align-items-center">
                    <a class="footer-link" target="_blank" rel="noreferrer"
                        href="https://www.youtube.com/@dinkeskabsumenep9556"><i class="bi bi-youtube"></i></a>
                    <a class="footer-link" target="_blank" rel="noreferrer"
                        href="https://www.instagram.com/dinkes_sumenep?igsh=MWxyb3B2eWliYmc5ZQ=="><i
                            class="bi bi-instagram"></i></a>
                    <a class="footer-link" target="_blank" rel="noreferrer" href="https://www.tiktok.com/"><i
                            class="bi bi-tiktok"></i></a>
                </div>
            </div>
        </div>
    </div>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top py-2" id="topNavbar">
        <div class="container">
            <a class="navbar-brand fw-bold brand-wrap" href="/">
                <img src="/images/avatar/Lambang_Kabupaten_Sumenep.png" width="44" height="44" alt="Logo">
                <div class="lh-1">
                    <span class="brand-title d-block fs-5">DINAS KESEHATAN</span>
                    <span class="brand-sub">KABUPATEN SUMENEP</span>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Profil
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('profil.visimisi') }}">
                                    Visi & Misi
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profil.struktur') }}">
                                    Struktur
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profil.galeri') }}">
                                    Galeri
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profil.sosmed') }}">
                                    Sosial Media
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('layanan.layanan') }}">Layanan</a></li>



                    @auth
                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-warning nav-btn shadow-sm" href="{{ route('dashboard') }}">
                                <i class="bi bi-grid-fill me-2"></i>Dashboard
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-light nav-btn text-success fw-bold" href="{{ route('login') }}">
                                Login
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- ANNOUNCEMENT BAR (Pengumuman) --}}
    <div class="announce py-2">
        <div class="container">
            <div class="row align-items-center g-2">
                <div class="col-lg-2 col-md-3">
                    <span class="pill d-inline-flex align-items-center gap-2">
                        <i class="bi bi-megaphone-fill"></i> Pengumuman
                    </span>
                </div>
                <div class="col-lg-10 col-md-9">
                    <div class="marquee">
                        <span>
                            Sistem Monitoring Administrasi Surat Dinkes Sumenep — Gunakan menu “Masuk Sistem” untuk
                            mengelola surat masuk/keluar, cetak laporan, dan cetak lembar kendali. Pastikan data surat
                            diisi lengkap untuk keperluan arsip instansi.
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= CONTENT ================= --}}
    @yield('content')

    {{-- FOOTER --}}
    <footer class="text-white">
        <div class="container">
            <div class="row g-4 align-items-start">
                <div class="col-lg-5 text-center text-lg-start">
                    <div class="d-flex align-items-center gap-3 justify-content-center justify-content-lg-start">
                        <img src="/images/avatar/Lambang_Kabupaten_Sumenep.png" width="58" alt="">
                        <div class="lh-1">
                            <div class="fw-bold">Dinas Kesehatan Kabupaten Sumenep</div>
                            <div class="small footer-meta">Pemerintah Kabupaten Sumenep — Madura, Jawa Timur</div>
                        </div>
                    </div>

                    <div class="small footer-meta mt-3">
                        Sistem Monitoring Administrasi Surat untuk mendukung transformasi digital layanan persuratan
                        instansi.
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="fw-bold mb-2">Tautan</div>
                    <div class="d-grid gap-2">
                        <a class="footer-link" href="#layanan">Layanan</a>
                        <a class="footer-link" href="#alur">Alur</a>
                        <a class="footer-link" href="#faq">FAQ</a>
                        <a class="footer-link" href="#kontak">Kontak</a>
                        <a class="footer-link" href="#berita">Berita</a>
                    </div>
                </div>

                <div class="col-lg-4 col-6">
                    <div class="fw-bold mb-2">Media Sosial</div>
                    <div class="d-flex gap-3 align-items-center">
                        <a class="footer-link fs-4" target="_blank" rel="noreferrer"
                            href="https://www.youtube.com/@dinkeskabsumenep9556"><i class="bi bi-youtube"></i></a>
                        <a class="footer-link fs-4" target="_blank" rel="noreferrer"
                            href="https://www.instagram.com/dinkes_sumenep?igsh=MWxyb3B2eWliYmc5ZQ=="><i
                                class="bi bi-instagram"></i></a>
                        <a class="footer-link fs-4" target="_blank" rel="noreferrer"
                            href="https://www.tiktok.com/"><i class="bi bi-tiktok"></i></a>
                    </div>

                    <div class="small footer-meta mt-3">
                        Email: <a class="footer-link"
                            href="mailto:dinkessumenep@gmail.com">dinkessumenep@gmail.com</a><br>
                        Telp: (0328) 662122
                    </div>
                </div>
            </div>

            <hr class="opacity-10 my-4">
            <div class="text-center small footer-meta">
                © {{ date('Y') }} Sistem Monitoring Administrasi Surat — All Rights Reserved.
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Back to top --}}
    <button class="to-top" id="toTop" aria-label="Kembali ke atas">
        <i class="bi bi-arrow-up-short fs-3"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        // AOS
        AOS.init({
            duration: 900,
            once: true,
            offset: 90
        });

        // Navbar shrink + back to top
        const navbar = document.getElementById('topNavbar');
        const toTop = document.getElementById('toTop');

        function onScrollUI() {
            const y = window.scrollY || document.documentElement.scrollTop;
            if (y > 40) navbar.classList.add('shrink');
            else navbar.classList.remove('shrink');

            if (y > 450) toTop.classList.add('show');
            else toTop.classList.remove('show');
        }
        window.addEventListener('scroll', onScrollUI);
        onScrollUI();

        toTop.addEventListener('click', () => window.scrollTo({
            top: 0,
            behavior: 'smooth'
        }));

        // Smooth scroll offset for anchors (navbar height)
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', function(e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (!target) return;
                e.preventDefault();
                const navH = navbar.offsetHeight + 10;
                const top = target.getBoundingClientRect().top + window.pageYOffset - navH;
                window.scrollTo({
                    top,
                    behavior: 'smooth'
                });
            });
        });

        // Counter animation (statistik)
        let counterStarted = false;
        const counters = document.querySelectorAll('.counter');

        function runCounters() {
            if (counterStarted) return;
            counterStarted = true;

            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target') || '0', 10);
                const duration = 1200; // ms
                const startTime = performance.now();

                function update(now) {
                    const progress = Math.min((now - startTime) / duration, 1);
                    const value = Math.floor(progress * target);
                    counter.textContent = value.toLocaleString('id-ID');
                    if (progress < 1) requestAnimationFrame(update);
                    else counter.textContent = target.toLocaleString('id-ID');
                }
                requestAnimationFrame(update);
            });
        }

        // Start counter when stats section visible
        const statSection = document.querySelector('.stat-box');
        if (statSection) {
            const obs = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) runCounters();
                });
            }, {
                threshold: 0.25
            });
            obs.observe(statSection);
        }

        // =========================
        // NEWS SLIDER CONTROLS
        // =========================
        (function() {
            const track = document.getElementById('newsTrack');
            const prev = document.getElementById('newsPrev');
            const next = document.getElementById('newsNext');

            if (!track || !prev || !next) return;

            function getStep() {
                const first = track.querySelector('.news-item');
                if (!first) return 320;
                const style = window.getComputedStyle(track);
                const gap = parseInt(style.columnGap || style.gap || '18', 10) || 18;
                return first.getBoundingClientRect().width + gap;
            }

            prev.addEventListener('click', () => {
                track.scrollBy({
                    left: -getStep(),
                    behavior: 'smooth'
                });
            });

            next.addEventListener('click', () => {
                track.scrollBy({
                    left: getStep(),
                    behavior: 'smooth'
                });
            });
        })();
    </script>


</body>

</html>
