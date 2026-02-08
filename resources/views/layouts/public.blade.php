<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="/images/avatar/Lambang_Kabupaten_Sumenep.png">
    <title>@yield('title', 'Portal Berita | Dinkes Sumenep')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">

    <style>
        :root{
            --primary:#198754;
            --dark:#0f5132;
            --accent:#ffc107;
            --bg:#f6f8fb;
            --card:#fff;
            --text:#111827;
            --muted:#6b7280;
            --border: rgba(0,0,0,.08);
        }
        body{ font-family: Inter, sans-serif; background: var(--bg); color: var(--text); }
        h1,h2,h3,.brand-title{ font-family: "Playfair Display", serif; }

        .topbar{
            background:#0b3b24;
            color:rgba(255,255,255,.88);
            font-size:.85rem;
        }
        .topbar a{ color:rgba(255,255,255,.88); text-decoration:none; }
        .topbar a:hover{ color:#fff; text-decoration:underline; text-underline-offset:4px; }

        .navbar{
            background:rgba(25,135,84,.96) !important;
            border-bottom:3px solid var(--accent);
        }
        .navbar .nav-link{
            color:rgba(255,255,255,.92) !important;
            font-weight:800;
        }
        .navbar .nav-link:hover{ color:#fff !important; text-decoration:underline; text-underline-offset:6px; }
        .brand-wrap{ display:flex; align-items:center; gap:12px; }
        .brand-sub{ letter-spacing:2px; font-weight:700; opacity:.92; font-size:.72rem; }

        footer{ background:#0b1220; padding:40px 0 20px; }
        .footer-link{ color:rgba(255,255,255,.70); text-decoration:none; }
        .footer-link:hover{ color:#fff; }
        .footer-meta{ color:rgba(255,255,255,.55); }
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
<nav class="navbar navbar-expand-lg navbar-dark sticky-top py-2">
    <div class="container">
        <a class="navbar-brand fw-bold brand-wrap" href="{{ url('/') }}">
            <img src="/images/avatar/Lambang_Kabupaten_Sumenep.png" width="44" height="44" alt="Logo">
            <div class="lh-1">
                <span class="brand-title d-block fs-5">DINAS KESEHATAN</span>
                <span class="brand-sub">KABUPATEN SUMENEP</span>
            </div>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navPublic">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navPublic">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#layanan">Layanan</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#alur">Alur</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#struktur">Struktural</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('berita.public.index') }}">Berita</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#kontak">Kontak</a></li>

                @auth
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-warning rounded-pill fw-bold px-4" href="{{ route('dashboard') }}">
                            <i class="bi bi-grid-fill me-2"></i>Dashboard
                        </a>
                    </li>
                @else
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-outline-light rounded-pill fw-bold px-4" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light rounded-pill text-success fw-bold px-4" href="{{ route('register') }}">Registrasi</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{-- CONTENT --}}
<main>
    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="text-white mt-5">
    <div class="container">
        <div class="row g-4 align-items-start">
            <div class="col-lg-6">
                <div class="d-flex align-items-center gap-3">
                    <img src="/images/avatar/Lambang_Kabupaten_Sumenep.png" width="58" alt="">
                    <div class="lh-1">
                        <div class="fw-bold">Dinas Kesehatan Kabupaten Sumenep</div>
                        <div class="small footer-meta">Pemerintah Kabupaten Sumenep — Madura, Jawa Timur</div>
                    </div>
                </div>
                <div class="small footer-meta mt-3">
                    Portal informasi resmi & publikasi kegiatan Dinas Kesehatan Kabupaten Sumenep.
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="fw-bold mb-2">Tautan</div>
                <div class="d-grid gap-2">
                    <a class="footer-link" href="{{ route('berita.public.index') }}">Berita</a>
                    <a class="footer-link" href="{{ url('/') }}#layanan">Layanan</a>
                    <a class="footer-link" href="{{ url('/') }}#alur">Alur</a>
                    <a class="footer-link" href="{{ url('/') }}#kontak">Kontak</a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="fw-bold mb-2">Kontak</div>
                <div class="small footer-meta">
                    Email: <a class="footer-link" href="mailto:dinkessumenep@gmail.com">dinkessumenep@gmail.com</a><br>
                    Telp: (0328) 662122
                </div>
            </div>
        </div>

        <hr class="opacity-10 my-4">
        <div class="text-center small footer-meta">
            © {{ date('Y') }} Dinas Kesehatan Kabupaten Sumenep — All Rights Reserved.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
