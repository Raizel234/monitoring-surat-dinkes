<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="/images/avatar/Lambang_Kabupaten_Sumenep.png">
    <title>Sistem Monitoring Surat | Dinkes Sumenep</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --dinas-primary: #198754;
            --dinas-dark: #0f5132;
            --dinas-accent: #ffc107;

            --sidebar-width: 280px;
            --sidebar-mini: 88px;

            --bg: #f0f2f5;
            --card: #ffffff;
            --text: #111827;
            --muted: #6b7280;
            --border: rgba(0, 0, 0, 0.06);

            --shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            --radius: 18px;
        }

        body.dark-mode {
            --bg: #0b1220;
            --card: #0f172a;
            --text: #e5e7eb;
            --muted: #9ca3af;
            --border: rgba(255, 255, 255, 0.08);

            --dinas-dark: #0b3b24;
            --dinas-primary: #146c43;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            margin: 0;
            color: var(--text);
        }

        /* =========================
       SIDEBAR
    ========================= */
        .sidebar {
            background: linear-gradient(180deg, var(--dinas-dark) 0%, var(--dinas-primary) 100%);
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            z-index: 1000;
            transition: all .28s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 18px rgba(0, 0, 0, 0.12);
            overflow: hidden;
        }

        .sidebar-brand {
            min-height: 98px;
            padding: 18px 20px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(0, 0, 0, 0.12);
        }

        .sidebar-brand img {
            height: 50px;
            width: 50px;
            object-fit: contain;
            flex: 0 0 auto;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, .25));
        }

        .brand-text {
            min-width: 0;
            line-height: 1.12;
        }

        .brand-text .main {
            font-size: 1.05rem;
            font-weight: 900;
            display: block;
            letter-spacing: .6px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .brand-text .sub {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            font-size: .68rem;
            text-transform: uppercase;
            color: var(--dinas-accent);
            font-weight: 800;
            letter-spacing: .65px;
            margin-top: 4px;
            opacity: .95;
        }

        .sidebar-scroll {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding-bottom: 12px;
        }

        .sidebar-scroll::-webkit-scrollbar {
            width: 8px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.18);
            border-radius: 10px;
        }

        .sidebar-user {
            padding: 18px;
            margin: 14px 15px 10px;
            background: rgba(255, 255, 255, 0.09);
            border: 1px solid rgba(255, 255, 255, 0.10);
            border-radius: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 46px;
            height: 46px;
            background: var(--dinas-accent);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dinas-dark);
            font-weight: 900;
            font-size: 1.15rem;
            flex: 0 0 auto;
            box-shadow: 0 8px 18px rgba(0, 0, 0, .15);
        }

        .nav-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            font-weight: 900;
            color: rgba(255, 255, 255, 0.45);
            margin: 18px 0 10px 18px;
            letter-spacing: 1px;
        }

        .sidebar .nav {
            padding: 0 15px 12px;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.88) !important;
            padding: 11px 14px;
            margin-bottom: 6px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: 0.18s ease;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.06);
            background: rgba(255, 255, 255, 0.00);
        }

        .sidebar .nav-link i {
            font-size: 1.15rem;
            width: 22px;
            text-align: center;
            flex: 0 0 auto;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.10);
            border-color: rgba(255, 255, 255, 0.10);
            transform: translateX(4px);
            color: #fff !important;
        }

        .sidebar .nav-link.active {
            background: rgba(255, 193, 7, 0.95);
            color: var(--dinas-dark) !important;
            border-color: rgba(255, 193, 7, 0.35);
            box-shadow: 0 10px 22px rgba(255, 193, 7, .18);
        }

        .nav-text {
            min-width: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .menu-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.12);
            margin: 12px 18px 6px;
            border-radius: 99px;
        }

        .theme-toggle {
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.18);
            color: #fff;
            margin: 0 15px 8px;
            padding: 10px 12px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            transition: 0.2s;
            cursor: pointer;
            width: calc(100% - 30px);
        }

        .theme-toggle:hover {
            background: rgba(255, 255, 255, 0.14);
        }

        .theme-toggle .left {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: .92rem;
            white-space: nowrap;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.18);
            color: #fff;
            margin: 12px 15px 16px;
            padding: 12px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: calc(100% - 30px);
            transition: 0.2s;
            font-weight: 700;
        }

        .btn-logout:hover {
            background: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }

        /* =========================
       TOPBAR (Instansi style)
    ========================= */
        .topbar {
            position: sticky;
            top: 0;
            z-index: 900;
            margin-left: var(--sidebar-width);
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 18px;
            background: rgba(255, 255, 255, .86);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            transition: all .28s ease;
        }

        body.dark-mode .topbar {
            background: rgba(15, 23, 42, .78);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .hamburger-btn {
            width: 46px;
            height: 46px;
            border: 0;
            border-radius: 16px;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .2s;
        }

        .hamburger-btn:hover {
            background: rgba(0, 0, 0, .06);
        }

        body.dark-mode .hamburger-btn:hover {
            background: rgba(255, 255, 255, .06);
        }

        .topbar-title-wrap {
            min-width: 0;
            line-height: 1.1;
        }

        .topbar-title {
            font-weight: 900;
            font-size: 14px;
            letter-spacing: .3px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .topbar-sub {
            font-size: 12px;
            color: var(--muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .breadcrumb-lite {
            font-size: 12px;
            color: var(--muted);
            margin-top: 3px;
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        .crumb {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 2px 8px;
            border-radius: 999px;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, .6);
        }

        body.dark-mode .crumb {
            background: rgba(255, 255, 255, .05);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 0 0 auto;
        }

        .pill {
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, .7);
            border-radius: 14px;
            padding: 10px 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, .04);
        }

        body.dark-mode .pill {
            background: rgba(255, 255, 255, .06);
        }

        .pill .meta {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .pill .meta .label {
            font-size: 11px;
            color: var(--muted);
            font-weight: 700;
        }

        .pill .meta .value {
            font-size: 12px;
            font-weight: 900;
        }

        .quick-btn {
            border: 0;
            border-radius: 14px;
            padding: 10px 12px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 800;
            transition: .2s;
        }

        .quick-btn.primary {
            background: var(--dinas-primary);
            color: #fff;
        }

        .quick-btn.primary:hover {
            filter: brightness(0.95);
            transform: translateY(-1px);
        }

        .quick-btn.light {
            background: rgba(0, 0, 0, .06);
            color: var(--text);
        }

        body.dark-mode .quick-btn.light {
            background: rgba(255, 255, 255, .07);
            color: var(--text);
        }

        .quick-btn.light:hover {
            transform: translateY(-1px);
        }

        /* =========================
       CONTENT
    ========================= */
        .content-wrapper {
            margin-left: var(--sidebar-width);
            padding: 18px 30px 30px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all .28s ease;
        }

        .content-card {
            background: var(--card);
            border-radius: var(--radius);
            padding: 28px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            flex: 1;
        }

        .main-footer {
            margin-top: auto;
            padding: 18px 0 14px;
            text-align: center;
            color: var(--muted);
            font-size: 0.85rem;
        }

        /* =========================
       MINI SIDEBAR
    ========================= */
        body.sidebar-mini .sidebar {
            width: var(--sidebar-mini);
        }

        body.sidebar-mini .content-wrapper {
            margin-left: var(--sidebar-mini);
        }

        body.sidebar-mini .topbar {
            margin-left: var(--sidebar-mini);
        }

        body.sidebar-mini .brand-text,
        body.sidebar-mini .sidebar-user .ms-3,
        body.sidebar-mini .nav-label,
        body.sidebar-mini .nav-text,
        body.sidebar-mini #themeToggle .left span {
            display: none !important;
        }

        body.sidebar-mini .sidebar-brand {
            justify-content: center;
            padding: 18px 10px;
            min-height: 86px;
        }

        body.sidebar-mini .sidebar-user {
            justify-content: center;
            margin: 12px;
            padding: 14px;
        }

        body.sidebar-mini .sidebar .nav {
            padding: 0 10px 12px;
        }

        body.sidebar-mini .sidebar .nav-link {
            justify-content: center;
            gap: 0;
        }

        body.sidebar-mini .sidebar .nav-link:hover {
            transform: none;
        }

        body.sidebar-mini .theme-toggle {
            justify-content: center;
        }

        body.sidebar-mini .btn-logout {
            justify-content: center;
        }

        /* =========================
       MOBILE
    ========================= */
        .sidebar-fab {
            display: none;
            position: fixed;
            bottom: 18px;
            right: 18px;
            z-index: 1100;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: var(--dinas-primary);
            color: #fff;
            border: none;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 992px) {
            .topbar {
                margin-left: 0;
            }

            .sidebar {
                transform: translateX(-100%);
                width: 85vw;
                max-width: 320px;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content-wrapper {
                margin-left: 0;
                padding: 18px 18px 24px;
            }

            .sidebar-fab {
                display: block;
            }

            body.sidebar-mini .sidebar {
                width: 85vw;
                max-width: 320px;
            }

            body.sidebar-mini .content-wrapper,
            body.sidebar-mini .topbar {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    @php
        // Breadcrumb sederhana berdasarkan route name (biar terasa instansi)
        $routeName = \Illuminate\Support\Facades\Route::currentRouteName() ?? '';
        $map = [
            'dashboard' => ['Dashboard', 'Ringkasan dan statistik sistem'],
            'surat-masuk.index' => ['Surat Masuk', 'Daftar surat masuk dan disposisi'],
            'surat-masuk.create' => ['Tambah Surat Masuk', 'Input surat masuk baru'],
            'surat-keluar.index' => ['Surat Keluar', 'Daftar surat keluar'],
            'surat-keluar.create' => ['Tambah Surat Keluar', 'Input surat keluar baru'],
            'laporan.surat_masuk' => ['Laporan Surat Masuk', 'Filter dan cetak laporan'],
            'laporan.surat_keluar' => ['Laporan Surat Keluar', 'Filter dan cetak laporan'],
            'activity-logs.index' => ['Log Aktivitas', 'Riwayat aktivitas pengguna'],
        ];

        $title = $map[$routeName][0] ?? 'Sistem Monitoring Surat';
        $desc = $map[$routeName][1] ?? 'Dinas Kesehatan Kabupaten Sumenep';
    @endphp

    <header class="topbar">
        <div class="topbar-left">
            <button type="button" class="hamburger-btn" id="desktopMiniToggle" title="Buka/Tutup Sidebar">
                <i class="bi bi-list fs-3"></i>
            </button>

            <div class="topbar-title-wrap">
                <div class="topbar-title">{{ $title }}</div>
                <div class="topbar-sub">{{ $desc }}</div>

                
            </div>
        </div>

        <div class="topbar-right">
            <div class="pill d-none d-sm-flex">
                <i class="bi bi-clock-history fs-5"></i>
                <div class="meta">
                    <div class="label">Waktu</div>
                    <div class="value" id="clockText">--:--:--</div>
                </div>
            </div>

            <div class="pill d-none d-sm-flex">
                <i class="bi bi-calendar3 fs-5"></i>
                <div class="meta">
                    <div class="label">Tanggal</div>
                    <div class="value">{{ now()->translatedFormat('d M Y') }}</div>
                </div>
            </div>

            
        </div>
    </header>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <img src="/images/avatar/Lambang_Kabupaten_Sumenep.png" alt="Logo Sumenep">
            <div class="brand-text">
                <span class="main">DINAS KESEHATAN</span>
                <span class="sub">Pengendalian Penduduk dan Keluarga Berencana</span>
            </div>
        </div>

        <div class="sidebar-scroll">
            <div class="sidebar-user">
                <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                <div class="ms-3 overflow-hidden">
                    <h6 class="mb-0 fw-bold text-truncate">{{ Auth::user()->name }}</h6>
                    <small class="opacity-75" style="font-size: 0.75rem;">Pegawai Aktif</small>
                </div>
            </div>

            <button type="button" class="theme-toggle" id="themeToggle">
                <div class="left">
                    <i class="bi bi-moon-stars-fill"></i>
                    <span>Dark Mode</span>
                </div>
                <i class="bi bi-toggle-off fs-4" id="themeToggleIcon"></i>
            </button>

            <div class="menu-divider"></div>

            <nav class="nav flex-column">
                <div class="nav-label">Main Menu</div>
                <a href="{{ route('dashboard') }}"
                    class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i> <span class="nav-text">Dashboard</span>
                </a>

                <div class="nav-label">Manajemen Surat</div>
                <a href="{{ route('surat-masuk.index') }}"
                    class="nav-link {{ request()->routeIs('surat-masuk.*') ? 'active' : '' }}">
                    <i class="bi bi-envelope-paper-fill"></i> <span class="nav-text">Surat Masuk</span>
                </a>
                <a href="{{ route('surat-keluar.index') }}"
                    class="nav-link {{ request()->routeIs('surat-keluar.*') ? 'active' : '' }}">
                    <i class="bi bi-send-fill"></i> <span class="nav-text">Surat Keluar</span>
                </a>

                <div class="nav-label">Laporan</div>
                <a href="{{ route('laporan.surat_masuk') }}"
                    class="nav-link {{ request()->routeIs('laporan.surat_masuk*') ? 'active' : '' }}">
                    <i class="bi bi-clipboard-data-fill"></i> <span class="nav-text">Laporan Surat Masuk</span>
                </a>
                <a href="{{ route('laporan.surat_keluar') }}"
                    class="nav-link {{ request()->routeIs('laporan.surat_keluar*') ? 'active' : '' }}">
                    <i class="bi bi-clipboard-check-fill"></i> <span class="nav-text">Laporan Surat Keluar</span>
                </a>

                <div class="nav-label">Log Activity</div>
                <a href="{{ route('activity-logs.index') }}"
                    class="nav-link {{ request()->routeIs('activity-logs.*') ? 'active' : '' }}">
                    <i class="bi bi-clock-history"></i> <span class="nav-text">Log Aktivitas</span>
                </a>

                <div class="nav-label">Pengaturan</div>
                <a href="/profile" class="nav-link">
                    <i class="bi bi-person-gear"></i> <span class="nav-text">Profil Saya</span>
                </a>
            </nav>
        </div>

        <div class="mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-logout">
                    <i class="bi bi-power"></i> <span class="nav-text">Keluar Sistem</span>
                </button>
            </form>
        </div>
    </aside>

    <button class="sidebar-fab" id="sidebarFab" title="Menu">
        <i class="bi bi-list fs-3"></i>
    </button>

    <main class="content-wrapper">
        <div class="content-card">
            {{ $slot }}
        </div>

        <footer class="main-footer">
            <strong>© {{ date('Y') }} Dinkes Kabupaten Sumenep</strong>
            <span class="d-none d-sm-inline-block"> — Sistem Monitoring Administrasi Surat</span>
        </footer>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // ===== CLOCK REALTIME =====
        function pad(n) {
            return n.toString().padStart(2, '0');
        }

        function updateClock() {
            const now = new Date();
            const h = pad(now.getHours());
            const m = pad(now.getMinutes());
            const s = pad(now.getSeconds());
            const el = document.getElementById('clockText');
            if (el) el.textContent = `${h}:${m}:${s}`;
        }
        updateClock();
        setInterval(updateClock, 1000);

        // ===== MOBILE SIDEBAR =====
        const sidebar = document.getElementById('sidebar');
        const sidebarFab = document.getElementById('sidebarFab');

        sidebarFab?.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            const icon = sidebarFab.querySelector('i');
            if (sidebar.classList.contains('show')) {
                icon.classList.replace('bi-list', 'bi-x-lg');
            } else {
                icon.classList.replace('bi-x-lg', 'bi-list');
            }
        });

        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 992 && sidebar.classList.contains('show')) {
                if (!sidebar.contains(e.target) && !sidebarFab.contains(e.target)) {
                    sidebar.classList.remove('show');
                    sidebarFab.querySelector('i').classList.replace('bi-x-lg', 'bi-list');
                }
            }
        });

        // ===== DESKTOP MINI SIDEBAR =====
        const desktopMiniToggle = document.getElementById('desktopMiniToggle');

        function applyMiniState(isMini) {
            document.body.classList.toggle('sidebar-mini', isMini);
            localStorage.setItem('sidebarMini', isMini ? '1' : '0');
        }

        const savedMini = localStorage.getItem('sidebarMini');
        if (savedMini === '1' && window.innerWidth > 992) applyMiniState(true);

        desktopMiniToggle.addEventListener('click', () => {
            if (window.innerWidth <= 992) return;
            applyMiniState(!document.body.classList.contains('sidebar-mini'));
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth <= 992) {
                document.body.classList.remove('sidebar-mini');
            } else {
                const saved = localStorage.getItem('sidebarMini');
                if (saved === '1') document.body.classList.add('sidebar-mini');
            }
        });

        // ===== DARK MODE =====
        const themeToggle = document.getElementById('themeToggle');
        const themeToggleIcon = document.getElementById('themeToggleIcon');

        function applyTheme(isDark) {
            document.body.classList.toggle('dark-mode', isDark);
            themeToggleIcon.className = isDark ? 'bi bi-toggle-on fs-4' : 'bi bi-toggle-off fs-4';
        }

        const savedTheme = localStorage.getItem('theme');
        applyTheme(savedTheme === 'dark');

        themeToggle.addEventListener('click', () => {
            const isDarkNow = !document.body.classList.contains('dark-mode');
            applyTheme(isDarkNow);
            localStorage.setItem('theme', isDarkNow ? 'dark' : 'light');
        });
    </script>

</body>

</html>
