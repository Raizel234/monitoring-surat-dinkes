<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="/images/avatar/Lambang_Kabupaten_Sumenep.png">
  <title>Sistem Monitoring Surat | Dinkes Sumenep</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --dinas-primary: #198754;
      --dinas-dark: #0f5132;
      --dinas-accent: #ffc107;
      --sidebar-width: 280px;

      /* LIGHT THEME */
      --bg: #f0f2f5;
      --card: #ffffff;
      --text: #111827;
      --muted: #6b7280;
      --border: rgba(0, 0, 0, 0.06);
    }

    /* DARK THEME */
    body.dark-mode {
      --bg: #0b1220;
      --card: #0f172a;
      --text: #e5e7eb;
      --muted: #9ca3af;
      --border: rgba(255, 255, 255, 0.08);

      /* Sidebar tetap hijau, tapi sedikit digelapkan */
      --dinas-dark: #0b3b24;
      --dinas-primary: #146c43;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--bg);
      margin: 0;
      color: var(--text);
    }

    /* SIDEBAR */
    .sidebar {
      background: linear-gradient(180deg, var(--dinas-dark) 0%, var(--dinas-primary) 100%);
      color: #fff;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      width: var(--sidebar-width);
      z-index: 1000;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      display: flex;
      flex-direction: column;
      box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
      overflow: hidden; /* penting: biar scroll di dalam */
    }

    /* Header brand */
    .sidebar-brand {
      padding: 25px 20px;
      display: flex;
      align-items: center;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      background: rgba(0, 0, 0, 0.1);
    }

    .sidebar-brand img {
      height: 45px;
      filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    }

    .brand-text {
      line-height: 1.2;
      margin-left: 12px;
    }

    .brand-text .main {
      font-size: 1.1rem;
      font-weight: 800;
      display: block;
      letter-spacing: 0.5px;
    }

    .brand-text .sub {
      font-size: 0.65rem;
      text-transform: uppercase;
      color: var(--dinas-accent);
      font-weight: 600;
    }

    /* Bagian sidebar yang bisa scroll */
    .sidebar-scroll {
      flex: 1;
      overflow-y: auto;
      overflow-x: hidden;
      padding-bottom: 10px;
    }

    .sidebar-scroll::-webkit-scrollbar {
      width: 8px;
    }

    .sidebar-scroll::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.18);
      border-radius: 10px;
    }

    /* User card */
    .sidebar-user {
      padding: 20px;
      margin: 15px;
      background: rgba(255, 255, 255, 0.08);
      border-radius: 15px;
      display: flex;
      align-items: center;
    }

    .user-avatar {
      width: 45px;
      height: 45px;
      background: var(--dinas-accent);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--dinas-dark);
      font-weight: bold;
      font-size: 1.2rem;
    }

    /* NAV */
    .sidebar .nav {
      padding: 10px 15px;
    }

    .nav-label {
      font-size: 0.7rem;
      text-transform: uppercase;
      font-weight: 700;
      color: rgba(255, 255, 255, 0.4);
      margin: 20px 0 10px 10px;
      letter-spacing: 1px;
    }

    .sidebar .nav-link {
      color: rgba(255, 255, 255, 0.85) !important;
      padding: 12px 15px;
      margin-bottom: 5px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      transition: 0.2s;
      font-weight: 500;
    }

    .sidebar .nav-link i {
      font-size: 1.15rem;
      margin-right: 12px;
      width: 22px;
      text-align: center;
      transition: 0.2s;
    }

    .sidebar .nav-link:hover {
      background: rgba(255, 255, 255, 0.1);
      color: #fff !important;
      transform: translateX(5px);
    }

    .sidebar .nav-link.active {
      background: var(--dinas-accent);
      color: var(--dinas-dark) !important;
      box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
    }

    /* Dark mode toggle button */
    .theme-toggle {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      color: #fff;
      margin: 0 15px 10px;
      padding: 10px 12px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      transition: 0.3s;
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
      font-weight: 600;
      font-size: 0.9rem;
    }

    /* CONTENT */
    .content-wrapper {
      margin-left: var(--sidebar-width);
      padding: 30px;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      transition: all 0.3s ease;
    }

    .content-card {
      background: var(--card);
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      border: 1px solid var(--border);
      flex: 1;
    }

    .main-footer {
      margin-top: auto;
      padding: 20px 0;
      text-align: center;
      color: var(--muted);
      font-size: 0.85rem;
    }

    /* LOGOUT */
    .btn-logout {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      color: #fff;
      margin: 15px;
      padding: 12px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      width: calc(100% - 30px);
      transition: 0.3s;
    }

    .btn-logout:hover {
      background: #dc3545;
      border-color: #dc3545;
      color: #fff;
    }

    /* Mobile */
    .sidebar-toggle {
      display: none;
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1100;
      width: 55px;
      height: 55px;
      border-radius: 50%;
      background: var(--dinas-primary);
      color: #fff;
      border: none;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 992px) {
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
        padding: 20px;
      }

      .sidebar-toggle {
        display: block;
      }
    }
  </style>
</head>

<body>

  <aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
      <img src="/images/avatar/Lambang_Kabupaten_Sumenep.png" alt="Logo Sumenep">
      <div class="brand-text">
        <span class="main">DINAS KESEHATAN</span>
        <span class="sub">Pengendalian Penduduk dan Keluarga Berencana</span>
      </div>
    </div>

    <!-- SCROLL AREA -->
    <div class="sidebar-scroll">

      <div class="sidebar-user">
        <div class="user-avatar">
          {{ substr(Auth::user()->name, 0, 1) }}
        </div>
        <div class="ms-3 overflow-hidden">
          <h6 class="mb-0 fw-bold text-truncate">{{ Auth::user()->name }}</h6>
          <small class="opacity-75" style="font-size: 0.7rem;">Pegawai Aktif</small>
        </div>
      </div>

      <!-- DARK MODE BUTTON -->
      <button type="button" class="theme-toggle" id="themeToggle">
        <div class="left">
          <i class="bi bi-moon-stars-fill"></i>
          <span>Dark Mode</span>
        </div>
        <i class="bi bi-toggle-off fs-4" id="themeToggleIcon"></i>
      </button>

      <nav class="nav flex-column">
        <div class="nav-label">Main Menu</div>
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>

        <div class="nav-label">Manajemen Surat</div>
        <a href="{{ route('surat-masuk.index') }}" class="nav-link {{ request()->routeIs('surat-masuk.*') ? 'active' : '' }}">
          <i class="bi bi-send-check"></i> Surat Masuk
        </a>
        <a href="{{ route('surat-keluar.index') }}" class="nav-link {{ request()->routeIs('surat-keluar.*') ? 'active' : '' }}">
          <i class="bi bi-send-check"></i> Surat Keluar
        </a>

        <div class="nav-label">Laporan</div>
        <a href="{{ route('laporan.surat_masuk') }}" class="nav-link {{ request()->routeIs('laporan.surat_masuk*') ? 'active' : '' }}">
          <i class="bi bi-clipboard-data-fill"></i> Laporan Surat Masuk
        </a>
        <a href="{{ route('laporan.surat_keluar') }}" class="nav-link {{ request()->routeIs('laporan.surat_keluar*') ? 'active' : '' }}">
          <i class="bi bi-clipboard-check-fill"></i> Laporan Surat Keluar
        </a>

        <div class="nav-label">Log Activity</div>
        <a href="{{ route('activity-logs.index') }}" class="nav-link {{ request()->routeIs('activity-logs.*') ? 'active' : '' }}">
          <i class="bi bi-clock-history"></i> Log Aktivitas
        </a>

        <div class="nav-label">Pengaturan</div>
        <a href="/profile" class="nav-link">
          <i class="bi bi-person-gear"></i> Profil Saya
        </a>
      </nav>
    </div>

    <!-- LOGOUT (tetap nempel di bawah, tidak ikut scroll) -->
    <div class="mt-auto">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-logout">
          <i class="bi bi-power me-2"></i> Keluar Sistem
        </button>
      </form>
    </div>
  </aside>

  <button class="sidebar-toggle shadow" id="sidebarToggle">
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
    // SIDEBAR TOGGLE (MOBILE)
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');

    sidebarToggle.addEventListener('click', () => {
      sidebar.classList.toggle('show');
      const icon = sidebarToggle.querySelector('i');
      if (sidebar.classList.contains('show')) {
        icon.classList.replace('bi-list', 'bi-x-lg');
      } else {
        icon.classList.replace('bi-x-lg', 'bi-list');
      }
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', (e) => {
      if (window.innerWidth <= 992 && !sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
        sidebar.classList.remove('show');
        sidebarToggle.querySelector('i').classList.replace('bi-x-lg', 'bi-list');
      }
    });

    // DARK MODE (save to localStorage)
    const themeToggle = document.getElementById('themeToggle');
    const themeToggleIcon = document.getElementById('themeToggleIcon');

    function applyTheme(isDark) {
      document.body.classList.toggle('dark-mode', isDark);
      themeToggleIcon.className = isDark ? 'bi bi-toggle-on fs-4' : 'bi bi-toggle-off fs-4';
    }

    // init theme from storage
    const savedTheme = localStorage.getItem('theme');
    const isDarkInit = savedTheme === 'dark';
    applyTheme(isDarkInit);

    themeToggle.addEventListener('click', () => {
      const isDarkNow = !document.body.classList.contains('dark-mode');
      applyTheme(isDarkNow);
      localStorage.setItem('theme', isDarkNow ? 'dark' : 'light');
    });
  </script>
</body>

</html>
