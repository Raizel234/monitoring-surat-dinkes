<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="/images/avatar/Lambang_Kabupaten_Sumenep.png" >
    <title>Sistem Monitoring Surat | Dinkes Sumenep</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-green: #198754;
            --dark-green: #0f5132;
            --soft-green: #e8f5e9;
            --accent-yellow: #ffc107;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: #333;
            overflow-x: hidden;
            background-color: #fcfcfc;
        }

        h1, h2, h3, .navbar-brand {
            font-family: 'Playfair Display', serif;
        }

        /* NAVBAR - Efek Blur & Transparan */
        .navbar {
            backdrop-filter: blur(15px);
            background: rgba(25, 135, 84, 0.95) !important;
            padding: 12px 0;
            transition: all 0.3s;
            border-bottom: 3px solid var(--accent-yellow);
        }

        /* HERO SECTION */
        .hero {
            position: relative;
            background: linear-gradient(rgba(15, 81, 50, 0.85), rgba(25, 135, 84, 0.75)),
                        url('/assets/bg-dinkes.jpg') center/cover no-repeat;
            height: 100vh;
            min-height: 700px;
            display: flex;
            align-items: center;
            color: white;
            clip-path: ellipse(150% 100% at 50% 0%); /* Efek lengkung bawah modern */
        }

        /* CUSTOM CARD */
        .custom-card {
            border: none;
            border-radius: 20px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: #ffffff;
        }

        .custom-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12) !important;
        }

        /* AVATAR/PROFILE IMAGE */
        .profile-img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border: 6px solid var(--soft-green);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .profile-img:hover {
            border-color: var(--accent-yellow);
            transform: rotate(3deg);
        }

        /* ICON BOX */
        .icon-box {
            width: 70px;
            height: 70px;
            background: var(--soft-green);
            color: var(--primary-green);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(25, 135, 84, 0.1);
        }

        /* SECTION STYLING */
        .section-padding {
            padding: 100px 0;
        }

        .text-underline-custom {
            position: relative;
            display: inline-block;
        }

        .text-underline-custom::after {
            content: '';
            position: absolute;
            width: 60%;
            height: 5px;
            background: var(--accent-yellow);
            bottom: -8px;
            left: 0;
            border-radius: 10px;
        }

        footer {
            background: #111;
            padding: 60px 0 30px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
             <img src="/images/avatar/Lambang_Kabupaten_Sumenep.png" width="45" class="me-3">
             <div class="lh-1">
                 <span class="fs-4 d-block">DINAS KESEHATAN</span>
                 <small style="font-size: 0.7rem; font-weight: normal; letter-spacing: 2px; font-family: 'Inter';">KABUPATEN SUMENEP</small>
             </div>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                    <li class="nav-item">
                        <a class="btn btn-warning px-4 rounded-pill fw-bold shadow-sm" href="{{ route('dashboard') }}">
                            <i class="bi bi-grid-fill me-2"></i>DASHBOARD
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link me-3 fw-semibold" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light px-4 rounded-pill fw-semibold" href="{{ route('register') }}">Registrasi</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<section class="hero">
    <div class="container text-center text-lg-start">
        <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill fw-bold">
                    <i class="bi bi-cpu-fill me-2"></i>E-GOVERNMENT SUMENEP
                </span>
                <h1 class="display-3 fw-bold mb-3">Sistem Monitoring <br><span class="text-warning">Administrasi Surat</span></h1>
                <p class="fs-5 mb-5 opacity-90">Digitalisasi tata kelola persuratan Dinas Kesehatan Kabupaten Sumenep. Cepat, Terstruktur, dan Terpantau secara Real-time.</p>

                <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                    <a href="{{ route('login') }}" class="btn btn-light btn-lg px-5 py-3 rounded-pill shadow-lg fw-bold text-success">
                        Masuk Sistem <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                    <a href="#section_2" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill fw-semibold">
                        Tentang Sistem
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-center" data-aos="zoom-in">
                <img src="/images/avatar/Lambang_Kabupaten_Sumenep.png" width="280" class="img-fluid drop-shadow" style="filter: drop-shadow(0 20px 30px rgba(0,0,0,0.3));">
            </div>
        </div>
    </div>
</section>

<div class="container" style="margin-top: -80px; position: relative; z-index: 10;">
    <div class="row g-4 text-center">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card custom-card shadow p-4 border-bottom border-warning border-4">
                <i class="bi bi-lightning-charge-fill fs-1 text-warning mb-2"></i>
                <h5 class="fw-bold">Efisiensi Waktu</h5>
                <p class="text-muted small">Disposisi dan monitoring surat hanya dalam hitungan detik.</p>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card custom-card shadow p-4 border-bottom border-success border-4">
                <i class="bi bi-shield-check fs-1 text-success mb-2"></i>
                <h5 class="fw-bold">Data Aman</h5>
                <p class="text-muted small">Arsip digital tersimpan aman dalam database terenkripsi.</p>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card custom-card shadow p-4 border-bottom border-primary border-4">
                <i class="bi bi-graph-up-arrow fs-1 text-primary mb-2"></i>
                <h5 class="fw-bold">Transparansi</h5>
                <p class="text-muted small">Pantau status surat masuk dan keluar secara terbuka.</p>
            </div>
        </div>
    </div>
</div>

<section class="section-padding" id="section_2">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-up">
                <div class="icon-box"><i class="bi bi-building"></i></div>
                <h2 class="display-5 mb-4 fw-bold">Tentang <span class="text-success text-underline-custom">Dinas Kesehatan</span></h2>
                <p class="lead text-muted mb-4">Dinas Kesehatan Kabupaten Sumenep adalah pilar utama dalam merencanakan dan mengawasi kebijakan kesehatan di wilayah Kabupaten Sumenep.</p>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="p-3 bg-white rounded shadow-sm border-start border-success border-4">
                            <h6 class="fw-bold mb-1">Visi Kami</h6>
                            <p class="small text-muted mb-0">Pelayanan kesehatan prima bagi warga Sumenep.</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-white rounded shadow-sm border-start border-warning border-4">
                            <h6 class="fw-bold mb-1">Misi Kami</h6>
                            <p class="small text-muted mb-0">Transformasi digital pelayanan publik.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="card custom-card shadow-lg p-5 bg-success text-white">
                    <i class="bi bi-quote fs-1 opacity-50"></i>
                    <p class="fs-4 fst-italic mb-4">"Melayani masyarakat dengan profesionalisme, transparansi, dan komitmen berkelanjutan demi Sumenep sehat."</p>
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-group">
                            <img src="/images/avatar/kadinkes.jpg" class="rounded-circle border border-2 border-white shadow-sm" width="50" height="50">
                            <img src="/images/avatar/sekdin.jpg" class="rounded-circle border border-2 border-white shadow-sm" width="50" height="50">
                        </div>
                        <span class="small fw-bold">Tenaga Kesehatan Kompeten</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-light" id="section_3">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-6 fw-bold">Pimpinan <span class="text-success">Struktural</span></h2>
            <p class="text-muted">Dedikasi tinggi untuk manajemen kesehatan yang lebih baik.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card custom-card h-100 shadow-sm text-center p-4">
                    <img src="/images/avatar/kadis.png" class="profile-img rounded-circle mx-auto mb-4" alt="Kadis">
                    <span class="badge bg-success-subtle text-success mb-2 px-3 py-2 rounded-pill fw-bold">KEPALA DINAS</span>
                    <h5 class="fw-bold">drg. Ellya Fardasah. M.Kes</h5>
                    <p class="text-muted small">Kepala Dinas Kesehatan Kabupaten Sumenep</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card custom-card h-100 shadow-sm text-center p-4">
                    <img src="/images/avatar/sekretaris.png" class="profile-img rounded-circle mx-auto mb-4" alt="Sekdin">
                    <span class="badge bg-success-subtle text-success mb-2 px-3 py-2 rounded-pill fw-bold">SEKRETARIS</span>
                    <h5 class="fw-bold">Slamet Boedihardjo, S.Sos., M.Si</h5>
                    <p class="text-muted small">Sekretaris Dinas Kesehatan</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card custom-card h-100 shadow-sm text-center p-4">
                    <img src="/images/avatar/kabid.png" class="profile-img rounded-circle mx-auto mb-4" alt="Kabid">
                    <span class="badge bg-success-subtle text-success mb-2 px-3 py-2 rounded-pill fw-bold">KEPALA BIDANG</span>
                    <h5 class="fw-bold">Moh. Nur Insan, S.Kep.Ns., M.Kes</h5>
                    <p class="text-muted small">Kabid Sumber Daya Kesehatan</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card custom-card h-100 shadow-sm text-center p-4">
                    <img src="/images/avatar/kabid2.png" class="profile-img rounded-circle mx-auto mb-4" alt="Kabid">
                    <span class="badge bg-success-subtle text-success mb-2 px-3 py-2 rounded-pill fw-bold">KEPALA BIDANG</span>
                    <h5 class="fw-bold">Achmad Syamsyuri, S.Kep.Ns., M.H.</h5>
                    <p class="text-muted small">Kabid Pencegahan dan Pengendalian Penyakit</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card custom-card h-100 shadow-sm text-center p-4">
                    <img src="/images/avatar/kabid3.png" class="profile-img rounded-circle mx-auto mb-4" alt="Kabid">
                    <span class="badge bg-success-subtle text-success mb-2 px-3 py-2 rounded-pill fw-bold">KEPALA BIDANG</span>
                    <h5 class="fw-bold">Siti Hairiyah, S.Kep.Ns., M.Kes.</h5>
                    <p class="text-muted small">Kabid Pelayanan Kesehatan</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card custom-card h-100 shadow-sm text-center p-4">
                    <img src="/images/avatar/kabid4.png" class="profile-img rounded-circle mx-auto mb-4" alt="Kabid">
                    <span class="badge bg-success-subtle text-success mb-2 px-3 py-2 rounded-pill fw-bold">KEPALA BIDANG</span>
                    <h5 class="fw-bold">Ida Winarni, S.ST., M.Kes.</h5>
                    <p class="text-muted small">Kabid Pengendalian Penduduk dan Keluarga Berencana</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card custom-card h-100 shadow-sm text-center p-4">
                    <img src="/images/avatar/kabid5.png" class="profile-img rounded-circle mx-auto mb-4" alt="Kabid">
                    <span class="badge bg-success-subtle text-success mb-2 px-3 py-2 rounded-pill fw-bold">KEPALA BIDANG</span>
                    <h5 class="fw-bold">Desy Febryana, S.Kep.Ns., M.Kes.</h5>
                    <p class="text-muted small">Kabid Kesehatan Masyarakat</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
               <div class="card custom-card h-100 shadow-sm text-center p-4">
                   <img src="/images/avatar/kabid.png" class="profile-img rounded-circle mx-auto mb-4" alt="Kabid">
                   <span class="badge bg-success-subtle text-success mb-2 px-3 py-2 rounded-pill fw-bold">KEPALA SUB</span>
                   <h5 class="fw-bold">Nurul Syamsyi, S.Kep.Ns,M.Kes</h5>
                   <p class="text-muted small">Kepala Sub Bagian Hukum</p>
               </div>
           </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card custom-card h-100 shadow-sm text-center p-4">
                    <img src="/images/avatar/PakRahadi.png" class="profile-img rounded-circle mx-auto mb-4" alt="Kabid">
                    <span class="badge bg-success-subtle text-success mb-2 px-3 py-2 rounded-pill fw-bold">ARSIPARIS</span>
                    <h5 class="fw-bold">RB. Moh. Rahadi S.H</h5>
                    <p class="text-muted small"> Arsiparis Ahli Muda</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-white" id="section_7">
    <div class="container">
        <div class="row g-4 align-items-stretch">
            <div class="col-lg-7" data-aos="fade-right">
                <div class="card custom-card shadow-sm p-4 h-100">
                    <h4 class="fw-bold mb-4 d-flex align-items-center">
                        <i class="bi bi-geo-alt-fill text-danger me-2"></i> Kantor Kami
                    </h4>
                    <div class="rounded-4 overflow-hidden shadow-inner">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2268478494!2d113.858!3d-7.012!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMDAnNDMuMiJTIDExM8KwNTEnMjguOCJF!5e0!3m2!1sid!2sid!4v1700000000000"
                                width="100%" height="320" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <div class="col-lg-5" data-aos="fade-left">
                <div class="card custom-card shadow-lg bg-dark text-white p-5 h-100 border-start border-warning border-5">
                    <h4 class="fw-bold mb-4 text-warning">Hubungi Kami</h4>
                    <div class="space-y-4">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-box mb-0 me-3" style="width: 50px; height: 50px; background: rgba(255,255,255,0.1); color: white;">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <span>Jl. Jokotole No. 05 Sumenep Jawa Timur</span>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-box mb-0 me-3" style="width: 50px; height: 50px; background: rgba(255,255,255,0.1); color: white;">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <span>(0328) 662122</span>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-box mb-0 me-3" style="width: 50px; height: 50px; background: rgba(255,255,255,0.1); color: white;">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <span>dinkessumenep@gmail.com</span>
                        </div>
                    </div>
                    <a href="mailto:dinkessumenep@gmail.com" class="btn btn-warning w-100 rounded-pill fw-bold py-3 mt-auto shadow">
                        <i class="bi bi-send-fill me-2"></i>Kirim Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="text-white">
    <div class="container text-center">
        <img src="/images/avatar/Lambang_Kabupaten_Sumenep.png" width="60" class="mb-4">
        <h5 class="fw-bold mb-1">Dinas Kesehatan Kabupaten Sumenep</h5>
        <p class="text-muted small mb-4">Pemerintah Kabupaten Sumenep, Madura, Jawa Timur</p>
        <div class="d-flex justify-content-center gap-3 mb-4">
            <a href="https://www.youtube.com/@dinkeskabsumenep9556" class="text-white opacity-50 hover-opacity-100 fs-4"><i class="bi bi-youtube"></i></a>
            <a href="https://www.instagram.com/dinkes_sumenep?igsh=MWxyb3B2eWliYmc5ZQ==" class="text-white opacity-50 hover-opacity-100 fs-4"><i class="bi bi-instagram"></i></a>
            <a href="https://www.instagram.com/dinkes_sumenep?igsh=MWxyb3B2eWliYmc5ZQ==" class="text-white opacity-50 hover-opacity-100 fs-4"><i class="bi bi-tiktok"></i></a>

        </div>
        <hr class="opacity-10">
        <p class="small text-muted mb-0">© {{ date('Y') }} Sistem Monitoring Administrasi Surat. All Rights Reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    // Initialize Animations
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });

    // Smooth scroll for anchors
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if(target) {
                window.scrollTo({
                    top: target.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
</script>

</body>
</html>
