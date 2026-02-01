<x-app-layout>
    <style>
        .page-title {
            font-family: 'Playfair Display', serif;
            color: #198754;
            font-weight: 700;
        }

        .card-box {
            background: #fff;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.06);
        }

        .info-table td {
            padding: 8px 0;
            vertical-align: top;
        }

        .info-label {
            width: 160px;
            color: #666;
            font-weight: 600;
        }

        .timeline-item {
            position: relative;
            padding-left: 28px;
            margin-bottom: 18px;
        }

        .timeline-item:before {
            content: "";
            position: absolute;
            left: 10px;
            top: 6px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #198754;
        }

        .timeline-item:after {
            content: "";
            position: absolute;
            left: 14px;
            top: 18px;
            width: 2px;
            height: calc(100% + 10px);
            background: rgba(25, 135, 84, 0.25);
        }

        .timeline-item:last-child:after {
            display: none;
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.72rem;
            display: inline-block;
        }

        .btn-file {
            border-radius: 12px;
            padding: 10px 14px;
            font-weight: 700;
        }
    </style>

    <div class="mb-4">
        <h3 class="fw-bold text-success mb-1">Detail Surat Keluar</h3>
        <div class="text-muted">Informasi lengkap dan riwayat status surat keluar.</div>
    </div>

    <div class="row g-4">
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
                            <td class="fw-semibold">:
                                {{ \Carbon\Carbon::parse($data->tanggal_surat)->translatedFormat('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tujuan</td>
                            <td class="fw-semibold">: {{ $data->tujuan }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Perihal</td>
                            <td class="fw-semibold">: {{ $data->perihal }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Status</td>
                            <td>
                                @php
                                    $badge =
                                        $data->status === 'Terkirim' ? 'bg-success text-white' : 'bg-warning text-dark';
                                @endphp
                                : <span class="badge rounded-pill {{ $badge }}">{{ $data->status }}</span>
                            </td>
                        </tr>
                    </table>

                    {{-- ✅ METADATA INSTANSI --}}
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
                        @if ($data->file_surat)
                            <a href="{{ asset('storage/' . $data->file_surat) }}" target="_blank"
                                class="btn btn-primary rounded-pill">
                                <i class="bi bi-file-earmark-pdf me-2"></i> Lihat File
                            </a>
                        @endif

                        @if (Route::has('surat-keluar.kendali.pdf'))
                            <a href="{{ route('surat-keluar.kendali.pdf', $data->id) }}"
                                class="btn btn-outline-dark rounded-pill">
                                <i class="bi bi-printer me-2"></i> Cetak Lembar Kendali
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <a href="{{ route('surat-keluar.index') }}" class="btn btn-secondary mt-3">← Kembali</a>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Timeline Status Surat</h6>

                    <div class="d-flex gap-3">
                        <div style="width:10px;">
                            <div class="rounded-circle bg-success" style="width:12px;height:12px;"></div>
                            <div class="bg-success" style="width:2px;height:60px;margin:0 auto;"></div>
                        </div>
                        <div>
                            <div class="fw-bold">Tambah Surat Keluar</div>
                            <div class="text-muted small">
                                Menambahkan surat keluar | Agenda: {{ $data->nomor_agenda ?? '-' }} | Nomor:
                                {{ $data->nomor_surat }}
                            </div>
                            <div class="text-muted small">{{ $data->created_at?->translatedFormat('d M Y H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mt-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-2">Verifikasi Dokumen</h6>
                    <div class="text-muted small mb-3">
                        QR Code muncul di PDF. Scan untuk cek keaslian dan status dokumen.
                    </div>

                    @if (Route::has('verifikasi.surat-keluar'))
                        <a class="btn btn-outline-success rounded-pill"
                            href="{{ route('verifikasi.surat-keluar', $data->id) }}" target="_blank">
                            <i class="bi bi-qr-code-scan me-2"></i> Buka Halaman Verifikasi
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
