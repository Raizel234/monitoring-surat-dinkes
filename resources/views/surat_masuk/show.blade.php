<x-app-layout>
    <style>
        .timeline {
            position: relative;
            margin-left: 20px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 7px;
            top: 0;
            width: 2px;
            height: 100%;
            background: #198754;
        }

        .timeline-item {
            position: relative;
            padding-left: 30px;
            margin-bottom: 25px;
        }

        .timeline-dot {
            position: absolute;
            left: 0;
            top: 5px;
            width: 16px;
            height: 16px;
            background: #198754;
            border-radius: 50%;
        }
    </style>

    <div class="mb-4">
    <h3 class="fw-bold text-success mb-1">Detail Surat Masuk</h3>
    <div class="text-muted">Informasi lengkap dan riwayat status surat</div>
</div>

<div class="row g-4">
    {{-- KIRI --}}
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">Informasi Surat</h6>

                <table class="table table-borderless mb-3" style="font-size: 0.95rem;">
                    <tr>
                        <td class="text-muted" style="width: 160px;">Nomor Agenda</td>
                        <td class="fw-semibold">: {{ $data->nomor_agenda ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Nomor Surat</td>
                        <td class="fw-semibold">: {{ $data->nomor_surat }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tanggal Surat</td>
                        <td class="fw-semibold">: {{ \Carbon\Carbon::parse($data->tanggal_surat)->translatedFormat('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Pengirim</td>
                        <td class="fw-semibold">: {{ $data->pengirim }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Perihal</td>
                        <td class="fw-semibold">: {{ $data->perihal }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status</td>
                        <td>
                            @php
                                $badgeClass = 'bg-success text-white';
                                if ($data->status === 'Diproses') $badgeClass = 'bg-warning text-dark';
                                elseif ($data->status === 'Selesai') $badgeClass = 'bg-secondary text-white';
                            @endphp
                            : <span class="badge rounded-pill {{ $badgeClass }}">{{ $data->status }}</span>
                        </td>
                    </tr>
                </table>

                {{-- ✅ METADATA INSTANSI (tampilan instansi tapi rapi) --}}
                <div class="border rounded-4 p-3 bg-light">
                    <div class="fw-bold mb-2">
                        <i class="bi bi-journal-text me-2"></i>Metadata Instansi
                    </div>

                    <div class="row g-2" style="font-size:0.92rem;">
                        <div class="col-6">
                            <div class="text-muted small">Sifat Surat</div>
                            <div class="fw-semibold">{{ $data->sifat_surat ?? '-' }}</div>
                        </div>
                        <div class="col-6">
                            <div class="text-muted small">Jenis Surat</div>
                            <div class="fw-semibold">{{ $data->jenis_surat ?? '-' }}</div>
                        </div>
                        <div class="col-6">
                            <div class="text-muted small">Klasifikasi</div>
                            <div class="fw-semibold">{{ $data->klasifikasi ?? '-' }}</div>
                        </div>
                        <div class="col-6">
                            <div class="text-muted small">Unit Pengolah</div>
                            <div class="fw-semibold">{{ $data->unit_pengolah ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                <div class="mt-3 d-grid gap-2">
                    @if($data->file_surat)
                        <a href="{{ asset('storage/'.$data->file_surat) }}" target="_blank"
                           class="btn btn-primary rounded-pill">
                            <i class="bi bi-file-earmark-pdf me-2"></i> Lihat File
                        </a>
                    @endif

                    {{-- kalau kamu punya tombol cetak lembar kendali --}}
                    @if(Route::has('surat-masuk.kendali.pdf'))
                        <a href="{{ route('surat-masuk.kendali.pdf', $data->id) }}" class="btn btn-outline-dark rounded-pill">
                            <i class="bi bi-printer me-2"></i> Cetak Lembar Kendali
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <a href="{{ route('surat-masuk.index') }}" class="btn btn-secondary mt-3">
            ← Kembali
        </a>
    </div>

    {{-- KANAN --}}
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">Timeline Status Surat</h6>

                {{-- contoh timeline sederhana (sesuaikan kalau kamu punya data activity log) --}}
                <div class="d-flex gap-3">
                    <div style="width:10px;">
                        <div class="rounded-circle bg-success" style="width:12px;height:12px;"></div>
                        <div class="bg-success" style="width:2px;height:60px;margin:0 auto;"></div>
                    </div>
                    <div>
                        <div class="fw-bold">Tambah Surat Masuk</div>
                        <div class="text-muted small">
                            Menambahkan surat masuk | Agenda: {{ $data->nomor_agenda ?? '-' }} | Nomor: {{ $data->nomor_surat }}
                        </div>
                        <div class="text-muted small">{{ $data->created_at?->translatedFormat('d M Y H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- opsional: kotak verifikasi --}}
        <div class="card border-0 shadow-sm rounded-4 mt-4">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-2">Verifikasi Dokumen</h6>
                <div class="text-muted small mb-3">
                    QR Code biasanya muncul di PDF (Laporan/Lembar Kendali). Saat discan akan mengarah ke halaman verifikasi.
                </div>

                @if(Route::has('verifikasi.surat-masuk'))
                    <a class="btn btn-outline-success rounded-pill"
                       href="{{ route('verifikasi.surat-masuk', $data->id) }}" target="_blank">
                        <i class="bi bi-qr-code-scan me-2"></i> Buka Halaman Verifikasi
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

</x-app-layout>
