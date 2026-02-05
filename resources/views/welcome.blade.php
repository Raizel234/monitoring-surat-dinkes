<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="/images/avatar/Lambang_Kabupaten_Sumenep.png">
    <title>Sistem Monitoring Surat | Dinkes Sumenep</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">

    {{-- AOS --}}
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        :root{
            --primary-green: #198754;
            --dark-green: #0f5132;
            --accent-yellow: #ffc107;

            --bg: #f6f8fb;
            --card: #ffffff;
            --text: #111827;
            --muted: #6b7280;
            --border: rgba(0,0,0,.08);
        }

        * { scroll-behavior: smooth; }
        body{
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
        }
        h1, h2, h3, .brand-title{ font-family: 'Playfair Display', serif; }

        /* =========================
           TOPBAR (instansi banget)
        ========================== */
        .topbar{
            background: #0b3b24;
            color: rgba(255,255,255,.88);
            font-size: .85rem;
        }
        .topbar a{ color: rgba(255,255,255,.88); text-decoration: none; }
        .topbar a:hover{ color:#fff; text-decoration: underline; text-underline-offset: 4px; }

        /* =========================
           NAVBAR
        ========================== */
        .navbar{
            background: rgba(25,135,84,.96) !important;
            border-bottom: 3px solid var(--accent-yellow);
            transition: all .25s ease;
        }
        .navbar.shrink{
            padding-top: .25rem !important;
            padding-bottom: .25rem !important;
            box-shadow: 0 10px 30px rgba(0,0,0,.15);
        }
        .navbar .nav-link{
            color: rgba(255,255,255,.90) !important;
            font-weight: 700;
        }
        .navbar .nav-link:hover{
            color:#fff !important;
            text-decoration: underline;
            text-underline-offset: 6px;
        }

        .brand-wrap{ display:flex; align-items:center; gap:12px; }
        .brand-sub{
            font-family: 'Inter', sans-serif;
            letter-spacing: 2px;
            font-weight: 600;
            opacity: .92;
            font-size: .72rem;
        }
        .nav-btn{
            border-radius: 999px;
            padding: 10px 18px;
            font-weight: 800;
        }

        /* =========================
           RUNNING ANNOUNCEMENT
        ========================== */
        .announce{
            background: #fff;
            border-bottom: 1px solid var(--border);
        }
        .announce .pill{
            background: rgba(255,193,7,.18);
            color: #854d0e;
            border: 1px solid rgba(255,193,7,.35);
            font-weight: 800;
            border-radius: 999px;
            padding: 6px 12px;
            font-size: .85rem;
            white-space: nowrap;
        }
        .marquee{
            overflow: hidden;
            position: relative;
            height: 38px;
        }
        .marquee span{
            position: absolute;
            white-space: nowrap;
            will-change: transform;
            animation: marquee 18s linear infinite;
            color: #374151;
            font-weight: 600;
        }
        @keyframes marquee{
            from { transform: translateX(100%); }
            to   { transform: translateX(-120%); }
        }

        /* =========================
           HERO
        ========================== */
        .hero{
            position: relative;
            min-height: 92vh;
            display: flex;
            align-items: center;
            color: #fff;
            background:
                linear-gradient(135deg, rgba(15,81,50,.92), rgba(25,135,84,.70)),
                url('/assets/bg-dinkes.jpg') center/cover no-repeat;
            border-bottom: 1px solid rgba(255,255,255,.12);
        }
        .hero::before{
            content:"";
            position:absolute; inset:0;
            background-image: radial-gradient(rgba(255,255,255,.12) 1px, transparent 1px);
            background-size: 18px 18px;
            opacity: .22;
            pointer-events:none;
        }
        .hero::after{
            content:"";
            position:absolute;
            left:0; right:0; bottom:-1px;
            height: 100px;
            background: var(--bg);
            clip-path: ellipse(75% 100% at 50% 100%);
        }
        .hero-inner{ position: relative; z-index: 2; }

        .badge-gov{
            background: rgba(255,193,7,.95);
            color: #1f2937;
            border-radius: 999px;
            padding: 8px 14px;
            font-weight: 900;
            letter-spacing: .4px;
            box-shadow: 0 10px 25px rgba(0,0,0,.18);
        }
        .hero-title{
            font-size: clamp(2.1rem, 4.2vw, 3.8rem);
            line-height: 1.06;
        }
        .hero-lead{
            color: rgba(255,255,255,.88);
            max-width: 60ch;
        }
        .hero-cta .btn{
            border-radius: 999px;
            padding: 13px 24px;
            font-weight: 900;
        }
        .hero-emblem{
            width: min(320px, 75%);
            filter: drop-shadow(0 22px 30px rgba(0,0,0,.35));
        }

        /* =========================
           SECTIONS
        ========================== */
        .section-padding{ padding: 90px 0; }
        .section-title{
            font-size: clamp(1.7rem, 2.6vw, 2.4rem);
        }
        .title-accent{
            position: relative;
            display:inline-block;
        }
        .title-accent::after{
            content:"";
            position:absolute;
            left:0; bottom:-10px;
            width:58%;
            height:5px;
            background: var(--accent-yellow);
            border-radius: 999px;
        }

        /* =========================
           CARDS
        ========================== */
        .custom-card{
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 18px;
            transition: transform .25s ease, box-shadow .25s ease;
        }
        .custom-card:hover{
            transform: translateY(-8px);
            box-shadow: 0 18px 40px rgba(0,0,0,.10);
        }
        .feature-icon{
            width: 56px; height: 56px;
            border-radius: 16px;
            display:flex; align-items:center; justify-content:center;
            background: rgba(25,135,84,.12);
            color: var(--primary-green);
            font-size: 26px;
            box-shadow: 0 10px 20px rgba(25,135,84,.10);
        }

        /* =========================
           SERVICES (lebih instansi)
        ========================== */
        .service-badge{
            border-radius: 999px;
            padding: 7px 12px;
            font-weight: 800;
            font-size: .82rem;
            background: rgba(25,135,84,.10);
            color: var(--primary-green);
            border: 1px solid rgba(25,135,84,.20);
            display:inline-flex;
            align-items:center;
            gap:8px;
        }

        /* =========================
           STATS COUNTER
        ========================== */
        .stat-box{
            background: linear-gradient(135deg, rgba(15,81,50,.95), rgba(25,135,84,.88));
            color: #fff;
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,.12);
        }
        .stat-num{
            font-size: 2.2rem;
            font-weight: 900;
            line-height: 1;
        }
        .stat-label{
            color: rgba(255,255,255,.86);
            font-weight: 700;
        }

        /* =========================
           TIMELINE / FLOW
        ========================== */
        .flow-step{
            position: relative;
            padding-left: 52px;
        }
        .flow-step::before{
            content:"";
            position:absolute;
            left:18px;
            top: 6px;
            width: 14px;
            height: 14px;
            border-radius: 999px;
            background: var(--accent-yellow);
            box-shadow: 0 8px 18px rgba(255,193,7,.28);
        }
        .flow-step::after{
            content:"";
            position:absolute;
            left:24px;
            top: 24px;
            bottom: -10px;
            width: 2px;
            background: rgba(0,0,0,.08);
        }
        .flow-step:last-child::after{ display:none; }

        /* =========================
           PROFILE
        ========================== */
        .profile-img{
            width: 128px;
            height: 128px;
            object-fit: cover;
            border: 6px solid #eaf7ee;
            box-shadow: 0 14px 24px rgba(0,0,0,.10);
            transition: .25s ease;
        }
        .profile-img:hover{
            border-color: rgba(255,193,7,.9);
            transform: rotate(1.2deg);
        }

        /* =========================
           CONTACT BOX
        ========================== */
        .contact-box{
            background: #111827;
            border-radius: 18px;
            border-left: 6px solid var(--accent-yellow);
        }
        .contact-item{
            display:flex; gap:12px; align-items:center;
            padding: 10px 0;
            color: rgba(255,255,255,.88);
        }
        .contact-badge{
            width: 44px; height: 44px;
            border-radius: 14px;
            display:flex; align-items:center; justify-content:center;
            background: rgba(255,255,255,.10);
            color: #fff;
        }

        /* =========================
           FOOTER
        ========================== */
        footer{
            background: #0b1220;
            padding: 60px 0 30px;
        }
        .footer-link{
            color: rgba(255,255,255,.65);
            text-decoration: none;
        }
        .footer-link:hover{ color:#fff; }
        .footer-meta{
            color: rgba(255,255,255,.55);
            risky: none;
        }

        /* =========================
           Back to top
        ========================== */
        .to-top{
            position: fixed;
            right: 18px;
            bottom: 18px;
            width: 48px;
            height: 48px;
            border-radius: 999px;
            border: none;
            background: var(--primary-green);
            color: #fff;
            box-shadow: 0 14px 28px rgba(0,0,0,.20);
            display: none;
            z-index: 999;
        }
        .to-top.show{ display:inline-flex; align-items:center; justify-content:center; }

        @media (max-width: 992px){
            .hero{ min-height: 88vh; }
            .hero::after{ height: 80px; }
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
                <a class="footer-link" target="_blank" rel="noreferrer" href="https://www.youtube.com/@dinkeskabsumenep9556"><i class="bi bi-youtube"></i></a>
                <a class="footer-link" target="_blank" rel="noreferrer" href="https://www.instagram.com/dinkes_sumenep?igsh=MWxyb3B2eWliYmc5ZQ=="><i class="bi bi-instagram"></i></a>
                <a class="footer-link" target="_blank" rel="noreferrer" href="https://www.tiktok.com/"><i class="bi bi-tiktok"></i></a>
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

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                <li class="nav-item"><a class="nav-link" href="#alur">Alur</a></li>
                <li class="nav-item"><a class="nav-link" href="#struktur">Struktural</a></li>
                <li class="nav-item"><a class="nav-link" href="#faq">FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>

                @auth
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-warning nav-btn shadow-sm" href="{{ route('dashboard') }}">
                            <i class="bi bi-grid-fill me-2"></i>Dashboard
                        </a>
                    </li>
                @else
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-outline-light nav-btn" href="{{ route('login') }}">
                            Masuk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light nav-btn text-success fw-bold" href="{{ route('register') }}">
                            Registrasi
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
                        Sistem Monitoring Administrasi Surat Dinkes Sumenep — Gunakan menu “Masuk Sistem” untuk mengelola surat masuk/keluar, cetak laporan, dan cetak lembar kendali. Pastikan data surat diisi lengkap untuk keperluan arsip instansi.
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- HERO --}}
<section class="hero">
    <div class="container hero-inner">
        <div class="row align-items-center g-5">
            <div class="col-lg-7 text-center text-lg-start" data-aos="fade-right">
                <div class="d-inline-flex align-items-center gap-2 badge-gov mb-3">
                    <i class="bi bi-shield-lock-fill"></i>
                    <span>E-GOVERNMENT • SUMENEP</span>
                </div>

                <h1 class="hero-title fw-bold mb-3">
                    Sistem Monitoring<br>
                    <span class="text-warning">Administrasi Surat</span>
                </h1>

                <p class="hero-lead fs-5 mb-4">
                    Platform resmi internal untuk pencatatan, pemantauan, dan pengarsipan surat masuk & surat keluar
                    Dinas Kesehatan Kabupaten Sumenep — cepat, terstruktur, dan audit-ready.
                </p>

                <div class="hero-cta d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                    <a href="{{ route('login') }}" class="btn btn-light text-success shadow-lg">
                        Masuk Sistem <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                    <a href="#layanan" class="btn btn-outline-light">
                        Lihat Layanan
                    </a>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start small" style="color: rgba(255,255,255,.82);">
                    <span><i class="bi bi-check2-circle me-1 text-warning"></i> Arsip Digital</span>
                    <span><i class="bi bi-check2-circle me-1 text-warning"></i> Monitoring Status</span>
                    <span><i class="bi bi-check2-circle me-1 text-warning"></i> Cetak Dokumen</span>
                </div>
            </div>

            <div class="col-lg-5 d-none d-lg-flex justify-content-center" data-aos="zoom-in">
                <img src="/images/avatar/Lambang_Kabupaten_Sumenep.png" class="hero-emblem" alt="Lambang">
            </div>
        </div>
    </div>
</section>

{{-- FEATURE HIGHLIGHT --}}
<div class="container" style="margin-top:-70px; position:relative; z-index: 5;">
    <div class="row g-4">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="custom-card p-4 h-100 shadow-sm">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="feature-icon" style="background: rgba(255,193,7,.20); color:#b45309;">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>
                    <h5 class="fw-bold mb-0">Efisiensi Waktu</h5>
                </div>
                <p class="text-muted mb-0">
                    Proses pencatatan, disposisi, dan cetak laporan lebih cepat, mengurangi kerja manual.
                </p>
            </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="custom-card p-4 h-100 shadow-sm">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h5 class="fw-bold mb-0">Standar Administrasi</h5>
                </div>
                <p class="text-muted mb-0">
                    Format data dan dokumen dibuat rapi agar sesuai kebutuhan arsip dan administrasi instansi.
                </p>
            </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="custom-card p-4 h-100 shadow-sm">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="feature-icon" style="background: rgba(59,130,246,.12); color:#1d4ed8;">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h5 class="fw-bold mb-0">Transparansi Status</h5>
                </div>
                <p class="text-muted mb-0">
                    Pantau status surat masuk/keluar, riwayat tindakan, serta akses cetak lembar kendali.
                </p>
            </div>
        </div>
    </div>
</div>

{{-- LAYANAN SISTEM --}}
<section class="section-padding" id="layanan">
    <div class="container">
        <div class="row align-items-end g-3 mb-4">
            <div class="col-lg-7" data-aos="fade-up">
                <h2 class="section-title fw-bold mb-2">
                    Layanan <span class="text-success title-accent">Sistem</span>
                </h2>
                <p class="text-muted mb-0">
                    Modul utama yang umum digunakan pada sistem persuratan instansi pemerintahan.
                </p>
            </div>
            <div class="col-lg-5 text-lg-end" data-aos="fade-up" data-aos-delay="120">
                <span class="service-badge"><i class="bi bi-patch-check-fill"></i> Template Instansi + Dokumen Resmi</span>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="custom-card p-4 h-100 shadow-sm">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="feature-icon"><i class="bi bi-inbox-fill"></i></div>
                        <h5 class="fw-bold mb-0">Surat Masuk</h5>
                    </div>
                    <p class="text-muted mb-3">Input data surat masuk, unggah berkas, status, dan pencatatan agenda.</p>
                    <ul class="small text-muted mb-0 ps-3">
                        <li>Pencarian & filter periode</li>
                        <li>Detail surat & timeline</li>
                        <li>Cetak lembar kendali</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="160">
                <div class="custom-card p-4 h-100 shadow-sm">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="feature-icon" style="background: rgba(255,193,7,.18); color:#b45309;"><i class="bi bi-send-fill"></i></div>
                        <h5 class="fw-bold mb-0">Surat Keluar</h5>
                    </div>
                    <p class="text-muted mb-3">Kelola surat keluar, tujuan, status pengiriman, dan arsip digital.</p>
                    <ul class="small text-muted mb-0 ps-3">
                        <li>Nomor agenda otomatis</li>
                        <li>Detail surat & file</li>
                        <li>Cetak lembar kendali</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="220">
                <div class="custom-card p-4 h-100 shadow-sm">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="feature-icon" style="background: rgba(59,130,246,.12); color:#1d4ed8;"><i class="bi bi-printer-fill"></i></div>
                        <h5 class="fw-bold mb-0">Laporan & Arsip</h5>
                    </div>
                    <p class="text-muted mb-3">Export PDF laporan surat masuk/keluar dengan kop instansi dan tanda tangan.</p>
                    <ul class="small text-muted mb-0 ps-3">
                        <li>Filter status & periode</li>
                        <li>PDF siap cetak</li>
                        <li>Audit administrasi</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="280">
                <div class="custom-card p-4 h-100 shadow-sm">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="feature-icon"><i class="bi bi-clock-history"></i></div>
                        <h5 class="fw-bold mb-0">Log Aktivitas</h5>
                    </div>
                    <p class="text-muted mb-3">Riwayat aktivitas untuk memudahkan monitoring dan kontrol perubahan data.</p>
                    <ul class="small text-muted mb-0 ps-3">
                        <li>Jejak tindakan pengguna</li>
                        <li>Waktu & modul terlibat</li>
                        <li>Siap untuk audit</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="340">
                <div class="custom-card p-4 h-100 shadow-sm">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="feature-icon" style="background: rgba(16,185,129,.14); color:#0f766e;"><i class="bi bi-person-vcard-fill"></i></div>
                        <h5 class="fw-bold mb-0">Profil & Pengguna</h5>
                    </div>
                    <p class="text-muted mb-3">Pengaturan profil pengguna & keamanan akses sistem.</p>
                    <ul class="small text-muted mb-0 ps-3">
                        <li>Profil pegawai</li>
                        <li>Session aman</li>
                        <li>Pengembangan role bertahap</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="custom-card p-4 h-100 shadow-sm">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="feature-icon" style="background: rgba(147,51,234,.12); color:#6d28d9;"><i class="bi bi-qr-code-scan"></i></div>
                        <h5 class="fw-bold mb-0">Verifikasi Dokumen</h5>
                    </div>
                    <p class="text-muted mb-3">Dapat dikembangkan untuk QR verifikasi dokumen resmi (anti pemalsuan).</p>
                    <ul class="small text-muted mb-0 ps-3">
                        <li>Scan QR</li>
                        <li>Detail surat & status</li>
                        <li>Riwayat proses</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- STATS --}}
<section class="section-padding pt-0">
    <div class="container">
        <div class="stat-box p-5 shadow-lg" data-aos="zoom-in">
            <div class="row g-4 align-items-center">
                <div class="col-lg-5">
                    <h3 class="fw-bold mb-2">Ringkasan Sistem</h3>
                    <p class="mb-0" style="color: rgba(255,255,255,.86);">
                        Statistik ini dapat dihubungkan ke database jika kamu mau. Untuk sementara dibuat animasi counter.
                    </p>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-6 col-md-3">
                            <div class="custom-card p-3 text-center" style="background: rgba(255,255,255,.10); border-color: rgba(255,255,255,.14);">
                                <div class="stat-num counter" data-target="1200">0</div>
                                <div class="stat-label small">Surat Masuk</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="custom-card p-3 text-center" style="background: rgba(255,255,255,.10); border-color: rgba(255,255,255,.14);">
                                <div class="stat-num counter" data-target="950">0</div>
                                <div class="stat-label small">Surat Keluar</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="custom-card p-3 text-center" style="background: rgba(255,255,255,.10); border-color: rgba(255,255,255,.14);">
                                <div class="stat-num counter" data-target="38">0</div>
                                <div class="stat-label small">Unit</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="custom-card p-3 text-center" style="background: rgba(255,255,255,.10); border-color: rgba(255,255,255,.14);">
                                <div class="stat-num counter" data-target="24">0</div>
                                <div class="stat-label small">Jam Layanan</div>
                            </div>
                        </div>
                        <div class="small mt-2" style="color: rgba(255,255,255,.70);">
                            *Angka contoh. Bisa kamu minta aku hubungkan ke tabel surat_masuks & surat_keluars.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ALUR --}}
<section class="section-padding pt-0" id="alur">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6" data-aos="fade-up">
                <h2 class="section-title fw-bold mb-3">
                    Alur <span class="text-success title-accent">Kerja</span>
                </h2>
                <p class="text-muted mb-4">
                    Alur sederhana yang menyerupai praktik administrasi instansi agar data surat rapi dan mudah diaudit.
                </p>

                <div class="custom-card p-4 shadow-sm">
                    <div class="flow-step mb-4">
                        <div class="fw-bold">1) Input Data Surat</div>
                        <div class="text-muted small">Nomor surat, tanggal, pengirim/tujuan, perihal, file.</div>
                    </div>
                    <div class="flow-step mb-4">
                        <div class="fw-bold">2) Penetapan Status</div>
                        <div class="text-muted small">Diterima / Diproses / Dikirim / Selesai (sesuai kebutuhan).</div>
                    </div>
                    <div class="flow-step mb-4">
                        <div class="fw-bold">3) Cetak Dokumen</div>
                        <div class="text-muted small">Lembar kendali / laporan PDF berkepala instansi.</div>
                    </div>
                    <div class="flow-step">
                        <div class="fw-bold">4) Arsip & Monitoring</div>
                        <div class="text-muted small">Jejak aktivitas & riwayat memastikan proses dapat ditelusuri.</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="custom-card p-5 shadow-lg" style="background: linear-gradient(135deg, #0f5132, #198754); color:#fff;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="feature-icon" style="background: rgba(255,255,255,.12); color:#fff;">
                            <i class="bi bi-award-fill"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Standar Instansi</div>
                            <div class="small" style="color: rgba(255,255,255,.80);">Dokumen siap cetak, rapi, dan konsisten.</div>
                        </div>
                    </div>
                    <p class="mb-4" style="color: rgba(255,255,255,.90);">
                        Landing page ini dibuat agar sistem terasa “resmi” layaknya aplikasi pemerintahan:
                        ada pengumuman, layanan, alur, statistik, struktur, FAQ, dan kontak.
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge rounded-pill text-bg-warning text-dark px-3 py-2 fw-bold">Kop Resmi</span>
                        <span class="badge rounded-pill text-bg-light text-success px-3 py-2 fw-bold">PDF Cetak</span>
                        <span class="badge rounded-pill text-bg-light text-success px-3 py-2 fw-bold">Audit</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- STRUKTURAL --}}
<section class="section-padding bg-white" id="struktur">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title fw-bold mb-2">Pimpinan <span class="text-success">Struktural</span></h2>
            <p class="text-muted mb-0">Struktur pimpinan untuk menegaskan tampilan instansi.</p>
        </div>

        @php
            $pejabat = [
                ['jabatan'=>'KEPALA DINAS','nama'=>'drg. Ellya Fardasah. M.Kes','ket'=>'Kepala Dinas Kesehatan Kabupaten Sumenep','img'=>'/images/avatar/kadis.png'],
                ['jabatan'=>'SEKRETARIS','nama'=>'Slamet Boedihardjo, S.Sos., M.Si','ket'=>'Sekretaris Dinas Kesehatan','img'=>'/images/avatar/sekretaris.png'],
                ['jabatan'=>'KEPALA BIDANG','nama'=>'Moh. Nur Insan, S.Kep.Ns., M.Kes','ket'=>'Kabid Sumber Daya Kesehatan','img'=>'/images/avatar/kabid.png'],
                ['jabatan'=>'KEPALA BIDANG','nama'=>'Achmad Syamsyuri, S.Kep.Ns., M.H.','ket'=>'Kabid Pencegahan dan Pengendalian Penyakit','img'=>'/images/avatar/kabid2.png'],
                ['jabatan'=>'KEPALA BIDANG','nama'=>'Siti Hairiyah, S.Kep.Ns., M.Kes.','ket'=>'Kabid Pelayanan Kesehatan','img'=>'/images/avatar/kabid3.png'],
                ['jabatan'=>'KEPALA BIDANG','nama'=>'Ida Winarni, S.ST., M.Kes.','ket'=>'Kabid Pengendalian Penduduk dan Keluarga Berencana','img'=>'/images/avatar/kabid4.png'],
                ['jabatan'=>'KEPALA BIDANG','nama'=>'Desy Febryana, S.Kep.Ns., M.Kes.','ket'=>'Kabid Kesehatan Masyarakat','img'=>'/images/avatar/kabid5.png'],
                ['jabatan'=>'KEPALA SUB','nama'=>'Nurul Syamsyi, S.Kep.Ns, M.Kes','ket'=>'Kepala Sub Bagian Hukum','img'=>'/images/avatar/kabid.png'],
                ['jabatan'=>'ARSIPARIS','nama'=>'RB. Moh. Rahadi S.H','ket'=>'Arsiparis Ahli Muda','img'=>'/images/avatar/PakRahadi.png'],
            ];
        @endphp

        <div class="row g-4 justify-content-center">
            @foreach($pejabat as $i => $p)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ 100 + ($i*60) }}">
                    <div class="custom-card h-100 shadow-sm text-center p-4">
                        <img src="{{ $p['img'] }}" class="profile-img rounded-circle mx-auto mb-3" alt="">
                        <span class="badge bg-success-subtle text-success mb-2 px-3 py-2 rounded-pill fw-bold" style="font-family: 'Inter',sans-serif;">
                            {{ $p['jabatan'] }}
                        </span>
                        <h5 class="fw-bold mb-1">{{ $p['nama'] }}</h5>
                        <p class="text-muted small mb-0">{{ $p['ket'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="section-padding" id="faq">
    <div class="container">
        <div class="row g-4 align-items-start">
            <div class="col-lg-5" data-aos="fade-up">
                <h2 class="section-title fw-bold mb-3">
                    FAQ <span class="text-success title-accent">Layanan</span>
                </h2>
                <p class="text-muted mb-0">
                    Pertanyaan yang paling sering ditanyakan pada sistem persuratan instansi.
                </p>
            </div>
            <div class="col-lg-7" data-aos="fade-up" data-aos-delay="120">
                <div class="accordion custom-card shadow-sm" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Bagaimana cara menambahkan surat masuk/keluar?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Masuk ke Dashboard → pilih menu Surat Masuk / Surat Keluar → klik Tambah → isi data → simpan.
                                Setelah tersimpan kamu bisa cetak lembar kendali atau laporan.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Apakah laporan bisa difilter?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Bisa. Kamu dapat filter berdasarkan kata kunci, status, serta periode tanggal surat.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Apakah bisa ditambah QR Verifikasi?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Bisa. QR biasanya ditaruh di PDF (laporan/kendali/disposisi) dan mengarah ke halaman verifikasi publik.
                                Kalau kamu mau, aku bisa buatkan modul verifikasi + halaman publiknya.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Apakah tampilan bisa dibuat lebih “pemerintahan” lagi?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Bisa banget. Umumnya ditambah topbar layanan, banner pengumuman, struktur organisasi, dokumen publik,
                                serta halaman layanan/standar pelayanan.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="small text-muted mt-3">
                    *FAQ bisa kamu ubah sesuai kebutuhan dinas.
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="section-padding pt-0">
    <div class="container">
        <div class="custom-card p-5 shadow-lg" style="background: linear-gradient(135deg, rgba(255,193,7,.22), rgba(25,135,84,.10));" data-aos="zoom-in">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <h3 class="fw-bold mb-2">Siap Menggunakan Sistem?</h3>
                    <p class="text-muted mb-0">
                        Masuk ke sistem untuk mulai mengelola surat masuk/keluar, cetak laporan, dan arsip instansi.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('login') }}" class="btn btn-success btn-lg rounded-pill fw-bold px-4 py-3 shadow">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Masuk Sistem
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CONTACT --}}
<section class="section-padding pt-0" id="kontak">
    <div class="container">
        <div class="row g-4 align-items-stretch">
            <div class="col-lg-7" data-aos="fade-right">
                <div class="custom-card shadow-sm p-4 h-100">
                    <h4 class="fw-bold mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-geo-alt-fill text-danger"></i> Kantor Kami
                    </h4>
                    <div class="rounded-4 overflow-hidden" style="border:1px solid var(--border);">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2268478494!2d113.858!3d-7.012!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMDAnNDMuMiJTIDExM8KwNTEnMjguOCJF!5e0!3m2!1sid!2sid!4v1700000000000"
                            width="100%" height="330" style="border:0;" allowfullscreen loading="lazy"></iframe>
                    </div>
                    <div class="small text-muted mt-3">
                        <i class="bi bi-info-circle me-1"></i> Lokasi bisa kamu sesuaikan sesuai alamat resmi instansi.
                    </div>
                </div>
            </div>

            <div class="col-lg-5" data-aos="fade-left">
                <div class="contact-box shadow-lg p-5 h-100 d-flex flex-column">
                    <h4 class="fw-bold mb-4 text-warning">Hubungi Kami</h4>

                    <div class="contact-item">
                        <div class="contact-badge"><i class="bi bi-geo-alt"></i></div>
                        <div>Jl. Jokotole No. 05 Sumenep, Jawa Timur</div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-badge"><i class="bi bi-telephone"></i></div>
                        <div>(0328) 662122</div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-badge"><i class="bi bi-envelope"></i></div>
                        <div>dinkessumenep@gmail.com</div>
                    </div>

                    <div class="mt-auto pt-3">
                        <a href="mailto:dinkessumenep@gmail.com" class="btn btn-warning w-100 rounded-pill fw-bold py-3 shadow">
                            <i class="bi bi-send-fill me-2"></i>Kirim Email
                        </a>
                        <div class="text-center small mt-3" style="color: rgba(255,255,255,.65);">
                            Jam layanan: Senin–Jumat (08.00–15.00)
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
                    Sistem Monitoring Administrasi Surat untuk mendukung transformasi digital layanan persuratan instansi.
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="fw-bold mb-2">Tautan</div>
                <div class="d-grid gap-2">
                    <a class="footer-link" href="#layanan">Layanan</a>
                    <a class="footer-link" href="#alur">Alur</a>
                    <a class="footer-link" href="#faq">FAQ</a>
                    <a class="footer-link" href="#kontak">Kontak</a>
                </div>
            </div>

            <div class="col-lg-4 col-6">
                <div class="fw-bold mb-2">Media Sosial</div>
                <div class="d-flex gap-3 align-items-center">
                    <a class="footer-link fs-4" target="_blank" rel="noreferrer" href="https://www.youtube.com/@dinkeskabsumenep9556"><i class="bi bi-youtube"></i></a>
                    <a class="footer-link fs-4" target="_blank" rel="noreferrer" href="https://www.instagram.com/dinkes_sumenep?igsh=MWxyb3B2eWliYmc5ZQ=="><i class="bi bi-instagram"></i></a>
                    <a class="footer-link fs-4" target="_blank" rel="noreferrer" href="https://www.tiktok.com/"><i class="bi bi-tiktok"></i></a>
                </div>

                <div class="small footer-meta mt-3">
                    Email: <a class="footer-link" href="mailto:dinkessumenep@gmail.com">dinkessumenep@gmail.com</a><br>
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

{{-- Back to top --}}
<button class="to-top" id="toTop" aria-label="Kembali ke atas">
    <i class="bi bi-arrow-up-short fs-3"></i>
</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
    // AOS
    AOS.init({ duration: 900, once: true, offset: 90 });

    // Navbar shrink + back to top
    const navbar = document.getElementById('topNavbar');
    const toTop = document.getElementById('toTop');

    function onScrollUI(){
        const y = window.scrollY || document.documentElement.scrollTop;
        if (y > 40) navbar.classList.add('shrink');
        else navbar.classList.remove('shrink');

        if (y > 450) toTop.classList.add('show');
        else toTop.classList.remove('show');
    }
    window.addEventListener('scroll', onScrollUI);
    onScrollUI();

    toTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

    // Smooth scroll offset for anchors (navbar height)
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (!target) return;
            e.preventDefault();
            const navH = navbar.offsetHeight + 10;
            const top = target.getBoundingClientRect().top + window.pageYOffset - navH;
            window.scrollTo({ top, behavior: 'smooth' });
        });
    });

    // Counter animation (statistik)
    let counterStarted = false;
    const counters = document.querySelectorAll('.counter');

    function runCounters(){
        if (counterStarted) return;
        counterStarted = true;

        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target') || '0', 10);
            const duration = 1200; // ms
            const startTime = performance.now();

            function update(now){
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
        }, { threshold: 0.25 });
        obs.observe(statSection);
    }
</script>

</body>
</html>
