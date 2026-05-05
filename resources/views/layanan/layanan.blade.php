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
                    <span class="service-badge"><i class="bi bi-patch-check-fill"></i> Template Instansi + Dokumen
                        Resmi</span>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="custom-card p-4 h-100 shadow-sm">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="feature-icon"><i class="bi bi-inbox-fill"></i></div>
                            <h5 class="fw-bold mb-0">Surat Masuk</h5>
                        </div>
                        <p class="text-muted mb-3">Input data surat masuk, unggah berkas, status, dan pencatatan
                            agenda.</p>
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
                            <div class="feature-icon" style="background: rgba(255,193,7,.18); color:#b45309;"><i
                                    class="bi bi-send-fill"></i></div>
                            <h5 class="fw-bold mb-0">Surat Keluar</h5>
                        </div>
                        <p class="text-muted mb-3">Kelola surat keluar, tujuan, status pengiriman, dan arsip digital.
                        </p>
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
                            <div class="feature-icon" style="background: rgba(59,130,246,.12); color:#1d4ed8;"><i
                                    class="bi bi-printer-fill"></i></div>
                            <h5 class="fw-bold mb-0">Laporan & Arsip</h5>
                        </div>
                        <p class="text-muted mb-3">Export PDF laporan surat masuk/keluar dengan kop instansi dan tanda
                            tangan.</p>
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
                        <p class="text-muted mb-3">Riwayat aktivitas untuk memudahkan monitoring dan kontrol perubahan
                            data.</p>
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
                            <div class="feature-icon" style="background: rgba(16,185,129,.14); color:#0f766e;"><i
                                    class="bi bi-person-vcard-fill"></i></div>
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
                            <div class="feature-icon" style="background: rgba(147,51,234,.12); color:#6d28d9;"><i
                                    class="bi bi-qr-code-scan"></i></div>
                            <h5 class="fw-bold mb-0">Verifikasi Dokumen</h5>
                        </div>
                        <p class="text-muted mb-3">Dapat dikembangkan untuk QR verifikasi dokumen resmi (anti
                            pemalsuan).</p>
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

    {{-- ALUR --}}
    <section class="section-padding pt-0" id="alur">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6" data-aos="fade-up">
                    <h2 class="section-title fw-bold mb-3">
                        Alur <span class="text-success title-accent">Kerja</span>
                    </h2>
                    <p class="text-muted mb-4">
                        Alur sederhana yang menyerupai praktik administrasi instansi agar data surat rapi dan mudah
                        diaudit.
                    </p>

                    <div class="custom-card p-4 shadow-sm">
                        <div class="flow-step mb-4">
                            <div class="fw-bold">1) Input Data Surat</div>
                            <div class="text-muted small">Nomor surat, tanggal, pengirim/tujuan, perihal, file.</div>
                        </div>
                        <div class="flow-step mb-4">
                            <div class="fw-bold">2) Penetapan Status</div>
                            <div class="text-muted small">Diterima / Diproses / Dikirim / Selesai (sesuai kebutuhan).
                            </div>
                        </div>
                        <div class="flow-step mb-4">
                            <div class="fw-bold">3) Cetak Dokumen</div>
                            <div class="text-muted small">Lembar kendali / laporan PDF berkepala instansi.</div>
                        </div>
                        <div class="flow-step">
                            <div class="fw-bold">4) Arsip & Monitoring</div>
                            <div class="text-muted small">Jejak aktivitas & riwayat memastikan proses dapat ditelusuri.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    <div class="custom-card p-5 shadow-lg"
                        style="background: linear-gradient(135deg, #0f5132, #198754); color:#fff;">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="feature-icon" style="background: rgba(255,255,255,.12); color:#fff;">
                                <i class="bi bi-award-fill"></i>
                            </div>
                            <div>
                                <div class="fw-bold">Standar Instansi</div>
                                <div class="small" style="color: rgba(255,255,255,.80);">Dokumen siap cetak, rapi,
                                    dan konsisten.</div>
                            </div>
                        </div>
                        <p class="mb-4" style="color: rgba(255,255,255,.90);">
                            Landing page ini dibuat agar sistem terasa “resmi” layaknya aplikasi pemerintahan:
                            ada pengumuman, layanan, alur, statistik, struktur, FAQ, dan kontak.
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge rounded-pill text-bg-warning text-dark px-3 py-2 fw-bold">Kop
                                Resmi</span>
                            <span class="badge rounded-pill text-bg-light text-success px-3 py-2 fw-bold">PDF
                                Cetak</span>
                            <span class="badge rounded-pill text-bg-light text-success px-3 py-2 fw-bold">Audit</span>
                        </div>
                    </div>
                </div>
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
                                <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq1">
                                    Bagaimana cara menambahkan surat masuk/keluar?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    Masuk ke Dashboard → pilih menu Surat Masuk / Surat Keluar → klik Tambah → isi data
                                    → simpan.
                                    Setelah tersimpan kamu bisa cetak lembar kendali atau laporan.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq2">
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
                                <button class="accordion-button collapsed fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Apakah bisa ditambah QR Verifikasi?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    Bisa. QR biasanya ditaruh di PDF (laporan/kendali/disposisi) dan mengarah ke halaman
                                    verifikasi publik.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Apakah tampilan bisa dibuat lebih “pemerintahan” lagi?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    Bisa banget. Umumnya ditambah topbar layanan, banner pengumuman, struktur
                                    organisasi, dokumen publik,
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

@endsection
