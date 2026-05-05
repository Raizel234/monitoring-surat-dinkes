@extends('layouts.landing')


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
@section('content')
 {{-- STRUKTURAL --}}
    <section class="section-padding bg-white" id="struktur">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title fw-bold mb-2">Pimpinan <span class="text-success">Struktural</span></h2>
                <p class="text-muted mb-0">Struktur pimpinan untuk menegaskan tampilan instansi.</p>
            </div>

            @php
                $pejabat = [
                    [
                        'jabatan' => 'KEPALA DINAS',
                        'nama' => 'drg. Ellya Fardasah. M.Kes',
                        'ket' => 'Kepala Dinas Kesehatan Kabupaten Sumenep',
                        'img' => '/images/avatar/kadis.png',
                    ],
                    [
                        'jabatan' => 'SEKRETARIS',
                        'nama' => 'Slamet Boedihardjo, S.Sos., M.Si',
                        'ket' => 'Sekretaris Dinas Kesehatan',
                        'img' => '/images/avatar/sekretaris.png',
                    ],
                    [
                        'jabatan' => 'KEPALA BIDANG',
                        'nama' => 'Moh. Nur Insan, S.Kep.Ns., M.Kes',
                        'ket' => 'Kabid Sumber Daya Kesehatan',
                        'img' => '/images/avatar/kabid.png',
                    ],
                    [
                        'jabatan' => 'KEPALA BIDANG',
                        'nama' => 'Achmad Syamsyuri, S.Kep.Ns., M.H.',
                        'ket' => 'Kabid Pencegahan dan Pengendalian Penyakit',
                        'img' => '/images/avatar/kabid2.png',
                    ],
                    [
                        'jabatan' => 'KEPALA BIDANG',
                        'nama' => 'Siti Hairiyah, S.Kep.Ns., M.Kes.',
                        'ket' => 'Kabid Pelayanan Kesehatan',
                        'img' => '/images/avatar/kabid3.png',
                    ],
                    [
                        'jabatan' => 'KEPALA BIDANG',
                        'nama' => 'Ida Winarni, S.ST., M.Kes.',
                        'ket' => 'Kabid Pengendalian Penduduk dan Keluarga Berencana',
                        'img' => '/images/avatar/kabid4.png',
                    ],
                    [
                        'jabatan' => 'KEPALA BIDANG',
                        'nama' => 'Desy Febryana, S.Kep.Ns., M.Kes.',
                        'ket' => 'Kabid Kesehatan Masyarakat',
                        'img' => '/images/avatar/kabid5.png',
                    ],
                    [
                        'jabatan' => 'KEPALA SUB',
                        'nama' => 'Nurul Syamsyi, S.Kep.Ns, M.Kes',
                        'ket' => 'Kepala Sub Bagian Hukum',
                        'img' => '/images/avatar/kabid.png',
                    ],
                    [
                        'jabatan' => 'ARSIPARIS',
                        'nama' => 'RB. Moh. Rahadi S.H',
                        'ket' => 'Arsiparis Ahli Muda',
                        'img' => '/images/avatar/PakRahadi.png',
                    ],
                ];
            @endphp

            <div class="row g-4 justify-content-center">
                @foreach ($pejabat as $i => $p)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ 100 + $i * 60 }}">
                        <div class="custom-card h-100 shadow-sm text-center p-4">
                            <img src="{{ $p['img'] }}" class="profile-img rounded-circle mx-auto mb-3"
                                alt="">
                            <span class="badge bg-success-subtle text-success mb-2 px-3 py-2 rounded-pill fw-bold"
                                style="font-family: 'Inter',sans-serif;">
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
@endsection
