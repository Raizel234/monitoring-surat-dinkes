<x-app-layout>
    <style>
        .page-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: #198754;
        }

        /* Styling Kartu Statistik */
        .stat-card {
            border: none;
            border-radius: 20px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }

        .stat-icon-bg {
            position: absolute;
            right: -10px;
            bottom: -10px;
            font-size: 5rem;
            opacity: 0.1;
            z-index: -1;
            transform: rotate(-15deg);
        }

        .card-masuk {
            background: linear-gradient(135deg, #198754 0%, #2ecc71 100%);
            color: white;
        }

        .card-keluar {
            background: linear-gradient(135deg, #146c43 0%, #198754 100%);
            color: white;
        }

        /* ✅ Tambahan kartu monitoring (tetap gaya sama) */
        .card-proses {
            background: linear-gradient(135deg, #ffc107 0%, #ffdd57 100%);
            color: #1f2937;
        }

        .card-selesai {
            background: linear-gradient(135deg, #6c757d 0%, #adb5bd 100%);
            color: white;
        }

        .card-dispo-menunggu {
            background: linear-gradient(135deg, #0d6efd 0%, #5aa2ff 100%);
            color: white;
        }

        .card-dispo-proses {
            background: linear-gradient(135deg, #20c997 0%, #63e6be 100%);
            color: #0b2e1a;
        }

        .welcome-banner {
            background: #fff;
            border-left: 5px solid #ffc107;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .btn-quick-access {
            border-radius: 12px;
            padding: 12px;
            text-align: center;
            background: #f8f9fa;
            border: 1px solid #eee;
            transition: 0.3s;
            text-decoration: none;
            color: #333;
            display: block;
        }

        .btn-quick-access:hover {
            background: #e9f7ef;
            border-color: #198754;
            color: #198754;
        }
    </style>

    <div class="py-4 px-3">
        <div class="max-w-7xl mx-auto">

            <div class="welcome-banner p-4 mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h4 class="page-title mb-1">Halo, {{ Auth::user()->name }}!</h4>
                    <p class="text-muted mb-0 small">Selamat datang di Sistem Monitoring Administrasi Surat Dinas Kesehatan Sumenep.</p>
                </div>
                <div class="text-muted small">
                    <i class="bi bi-calendar3 me-1"></i> {{ date('d M Y') }}
                </div>
            </div>

            {{-- ✅ KARTU UTAMA (yang sudah ada) --}}
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="card stat-card card-masuk shadow-sm p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="text-uppercase fw-bold opacity-75 small mb-2">Total Surat Masuk</h6>
                                <h2 class="display-5 fw-bold mb-0">{{ $masuk }}</h2>
                            </div>
                            <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                                <i class="bi bi-envelope-check fs-3"></i>
                            </div>
                        </div>
                        <i class="bi bi-envelope-check stat-icon-bg"></i>
                        <a href="{{ route('surat-masuk.index') }}" class="text-white text-decoration-none mt-3 d-inline-block small opacity-75 hover-opacity-100">
                            Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card stat-card card-keluar shadow-sm p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="text-uppercase fw-bold opacity-75 small mb-2">Total Surat Keluar</h6>
                                <h2 class="display-5 fw-bold mb-0">{{ $keluar }}</h2>
                            </div>
                            <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                                <i class="bi bi-send-check fs-3"></i>
                            </div>
                        </div>
                        <i class="bi bi-send-check stat-icon-bg"></i>
                        <a href="{{ route('surat-keluar.index') }}" class="text-white text-decoration-none mt-3 d-inline-block small opacity-75 hover-opacity-100">
                            Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- ✅ KARTU MONITORING TAMBAHAN (tampilan tetap satu gaya) --}}
            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <div class="card stat-card card-proses shadow-sm p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="text-uppercase fw-bold opacity-75 small mb-2">Surat Diproses</h6>
                                <h2 class="display-6 fw-bold mb-0">{{ $masukDiproses }}</h2>
                            </div>
                            <div class="bg-white bg-opacity-50 p-3 rounded-circle">
                                <i class="bi bi-hourglass-split fs-3"></i>
                            </div>
                        </div>
                        <i class="bi bi-hourglass-split stat-icon-bg"></i>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card stat-card card-selesai shadow-sm p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="text-uppercase fw-bold opacity-75 small mb-2">Surat Selesai</h6>
                                <h2 class="display-6 fw-bold mb-0">{{ $masukSelesai }}</h2>
                            </div>
                            <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                                <i class="bi bi-check2-circle fs-3"></i>
                            </div>
                        </div>
                        <i class="bi bi-check2-circle stat-icon-bg"></i>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card stat-card card-dispo-menunggu shadow-sm p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="text-uppercase fw-bold opacity-75 small mb-2">Disposisi Menunggu</h6>
                                <h2 class="display-6 fw-bold mb-0">{{ $disposisiMenunggu }}</h2>
                            </div>
                            <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                                <i class="bi bi-bell fs-3"></i>
                            </div>
                        </div>
                        <i class="bi bi-bell stat-icon-bg"></i>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card stat-card card-dispo-proses shadow-sm p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="text-uppercase fw-bold opacity-75 small mb-2">Disposisi Diproses</h6>
                                <h2 class="display-6 fw-bold mb-0">{{ $disposisiDiproses }}</h2>
                            </div>
                            <div class="bg-white bg-opacity-50 p-3 rounded-circle">
                                <i class="bi bi-arrow-repeat fs-3"></i>
                            </div>
                        </div>
                        <i class="bi bi-arrow-repeat stat-icon-bg"></i>
                    </div>
                </div>
            </div>

            {{-- ✅ DEADLINE DISPOSISI TERDEKAT --}}
            <div class="bg-white p-4 rounded-4 shadow-sm border mb-5">
                <h5 class="fw-bold mb-3 d-flex align-items-center">
                    <i class="bi bi-alarm-fill text-danger me-2"></i> Deadline Disposisi Terdekat
                </h5>

                @if($deadlineDisposisi->count() == 0)
                    <div class="text-muted small">
                        Tidak ada deadline disposisi yang sedang berjalan.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Nomor Surat</th>
                                    <th>Tujuan</th>
                                    <th>Batas Waktu</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deadlineDisposisi as $d)
                                    <tr>
                                        <td class="fw-semibold">
                                            {{ $d->suratMasuk->nomor_surat ?? '-' }}
                                        </td>
                                        <td>{{ $d->tujuan }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($d->batas_waktu)->format('d M Y') }}
                                        </td>
                                        <td>
                                            <span class="badge bg-warning text-dark">{{ $d->status }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            {{-- ✅ BAGIAN YANG SUDAH ADA (Akses Cepat + Info Sistem) --}}
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="bg-white p-4 rounded-4 shadow-sm border">
                        <h5 class="fw-bold mb-4 d-flex align-items-center">
                            <i class="bi bi-lightning-charge-fill text-warning me-2"></i> Akses Cepat
                        </h5>
                        <div class="row g-3">
                            <div class="col-sm-4">
                                <a href="{{ route('surat-masuk.index') }}" class="btn-quick-access">
                                    <i class="bi bi-plus-circle fs-4 d-block mb-2 text-success"></i>
                                    <span class="small fw-semibold">Input Surat Masuk</span>
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a href="{{ route('surat-keluar.index') }}" class="btn-quick-access">
                                    <i class="bi bi-file-earmark-plus fs-4 d-block mb-2 text-primary"></i>
                                    <span class="small fw-semibold">Input Surat Keluar</span>
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a href="{{ route('profile.edit') }}" class="btn-quick-access">
                                    <i class="bi bi-person-badge fs-4 d-block mb-2 text-secondary"></i>
                                    <span class="small fw-semibold">Pengaturan Profil</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="bg-white p-4 rounded-4 shadow-sm border h-100">
                        <h5 class="fw-bold mb-3">Info Sistem</h5>
                        <ul class="list-unstyled small text-muted">
                            <li class="mb-2 d-flex justify-content-between">
                                <span>Versi Aplikasi</span>
                                <span class="badge bg-light text-dark border">v1.0.2</span>
                            </li>
                            <li class="mb-2 d-flex justify-content-between">
                                <span>Status Database</span>
                                <span class="text-success"><i class="bi bi-check-circle-fill me-1"></i> Terhubung</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <span>Server</span>
                                <span>Production</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
