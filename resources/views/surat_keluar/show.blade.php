<x-app-layout>
    <style>
        .page-title {
            font-family: 'Playfair Display', serif;
            color: #198754;
            font-weight: 700;
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 0.72rem;
            display: inline-block;
            white-space: nowrap;
        }

        .meta-box {
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 18px;
            background: #f8f9fa;
            padding: 16px;
        }

        .meta-label {
            font-size: .78rem;
            color: #6c757d;
        }

        .meta-value {
            font-weight: 700;
            color: #1f2d3d;
        }

        .info-row td {
            padding: 8px 0;
            vertical-align: top;
            font-size: .95rem;
        }

        .mini-card {
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 18px;
            background: #fff;
            padding: 16px;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 999px;
            border: 1px solid rgba(0,0,0,0.08);
            background: #fff;
            font-size: .85rem;
            font-weight: 600;
        }

        .pill .icon {
            width: 28px;
            height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #f1f3f5;
        }
    </style>

    @php
        $templateLabels = [
            'lembar_kendali' => 'Lembar Kendali',
            'nota_dinas' => 'Nota Dinas',
            'surat_keputusan' => 'Surat Keputusan (SK)',
        ];

        $jenisTemplate = $data->jenis_surat ?? 'lembar_kendali';
        $jenisTemplateLabel = $templateLabels[$jenisTemplate] ?? $jenisTemplate;

        $status = $data->status ?? '-';

        $statusClass = match ($status) {
            'Draft' => 'bg-light text-dark border',
            'Dikirim' => 'bg-warning text-dark',
            'Terkirim' => 'bg-success text-white',
            'Selesai' => 'bg-primary text-white',
            default => 'bg-secondary text-white',
        };

        // ✅ tujuan pegawai dari metadata (dropdown)
        $tujuanPegawai = $data->tujuanUser ?? null;
    @endphp

    <div class="mb-4">
        <h3 class="fw-bold text-success mb-1">Detail Surat Keluar</h3>
        <div class="text-muted">Informasi lengkap dan riwayat status surat keluar.</div>
    </div>

    <div class="row g-4">
        {{-- LEFT --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Informasi Surat</h6>

                    <table class="table table-borderless mb-3">
                        <tr class="info-row">
                            <td class="text-muted" style="width: 160px;">Nomor Agenda</td>
                            <td class="fw-semibold">: {{ $data->nomor_agenda ?? '-' }}</td>
                        </tr>

                        <tr class="info-row">
                            <td class="text-muted">Nomor Surat</td>
                            <td class="fw-semibold">: {{ $data->nomor_surat ?? '-' }}</td>
                        </tr>

                        <tr class="info-row">
                            <td class="text-muted">Tanggal Surat</td>
                            <td class="fw-semibold">:
                                @if(!empty($data->tanggal_surat))
                                    {{ \Carbon\Carbon::parse($data->tanggal_surat)->translatedFormat('d M Y') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>

                        {{-- ✅ Tujuan Instansi --}}
                        <tr class="info-row">
                            <td class="text-muted">Tujuan Instansi</td>
                            <td class="fw-semibold">: {{ $data->tujuan ?? '-' }}</td>
                        </tr>

                        {{-- ✅ Tujuan Pegawai (Metadata) --}}
                        <tr class="info-row">
                            <td class="text-muted">Tujuan Pegawai (Metadata)</td>
                            <td class="fw-semibold">:
                                @if($tujuanPegawai)
                                    {{ $tujuanPegawai->name }}
                                    @if($tujuanPegawai->jabatan || $tujuanPegawai->instansi)
                                        <div class="text-muted small">
                                            {{ $tujuanPegawai->jabatan ?? '-' }}
                                            {{ ($tujuanPegawai->jabatan && $tujuanPegawai->instansi) ? ' • ' : '' }}
                                            {{ $tujuanPegawai->instansi ?? '' }}
                                        </div>
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                        </tr>

                        <tr class="info-row">
                            <td class="text-muted">Perihal</td>
                            <td class="fw-semibold">: {{ $data->perihal ?? '-' }}</td>
                        </tr>

                        <tr class="info-row">
                            <td class="text-muted">Status</td>
                            <td>:
                                <span class="badge-status {{ $statusClass }}">{{ $status }}</span>
                            </td>
                        </tr>
                    </table>

                    {{-- METADATA INSTANSI --}}
                    <div class="meta-box">
                        <div class="fw-bold mb-2">
                            <i class="bi bi-journal-text me-2"></i>Metadata Instansi
                        </div>

                        <div class="row g-3">
                            <div class="col-6">
                                <div class="meta-label">Sifat Surat</div>
                                <div class="meta-value">{{ $data->sifat_surat ?? '-' }}</div>
                            </div>

                            <div class="col-6">
                                <div class="meta-label">Template Cetak</div>
                                <div class="meta-value">{{ $jenisTemplateLabel }}</div>
                            </div>

                            <div class="col-6">
                                <div class="meta-label">Jenis Surat (Kategori)</div>
                                <div class="meta-value">{{ $data->kategori_surat ?? '-' }}</div>
                            </div>

                            <div class="col-6">
                                <div class="meta-label">Klasifikasi</div>
                                <div class="meta-value">{{ $data->klasifikasi ?? '-' }}</div>
                            </div>

                            <div class="col-6">
                                <div class="meta-label">Unit Pengolah</div>
                                <div class="meta-value">{{ $data->unit_pengolah ?? '-' }}</div>
                            </div>
                        </div>
                    </div>

                    {{-- FILE + CETAK --}}
                    <div class="mt-3 d-grid gap-2">
                        @if (!empty($data->file_surat))
                            <a href="{{ asset('storage/' . $data->file_surat) }}" target="_blank"
                               class="btn btn-primary rounded-pill">
                                <i class="bi bi-file-earmark-pdf me-2"></i> Lihat File
                            </a>
                        @endif

                        @if (Route::has('surat-keluar.cetak'))
                            <div class="mini-card">
                                <div class="fw-bold mb-2">
                                    <i class="bi bi-printer me-2"></i> Cetak Dokumen
                                </div>

                                <a href="{{ route('surat-keluar.cetak', [$data->id, $jenisTemplate]) }}"
                                   class="btn btn-success w-100 rounded-pill" target="_blank">
                                    <i class="bi bi-lightning-charge me-2"></i>
                                    Cetak Sesuai Jenis ({{ $jenisTemplateLabel }})
                                </a>
                            </div>
                        @endif

                        @if (Route::has('surat-keluar.kendali.pdf'))
                            <a href="{{ route('surat-keluar.kendali.pdf', $data->id) }}"
                               class="btn btn-outline-secondary rounded-pill" target="_blank">
                                <i class="bi bi-printer me-2"></i> Cetak Lembar Kendali (Route Lama)
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <a href="{{ route('surat-keluar.index') }}" class="btn btn-secondary mt-3">← Kembali</a>
        </div>

        {{-- RIGHT --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Timeline Status Surat</h6>

                    <div class="d-flex gap-3">
                        <div style="width:10px;">
                            <div class="rounded-circle bg-success" style="width:12px;height:12px;"></div>
                            <div class="bg-success" style="width:2px;height:60px;margin:0 auto; opacity:.25;"></div>
                        </div>

                        <div>
                            <div class="fw-bold">Tambah Surat Keluar</div>
                            <div class="text-muted small">
                                Menambahkan surat keluar | Agenda: {{ $data->nomor_agenda ?? '-' }} | Nomor: {{ $data->nomor_surat ?? '-' }}
                            </div>
                            <div class="text-muted small">{{ $data->created_at?->translatedFormat('d M Y H:i') }}</div>
                        </div>
                    </div>

                    {{-- (opsional) update log sederhana --}}
                    @if($data->updated_at && $data->updated_at != $data->created_at)
                        <div class="d-flex gap-3 mt-3">
                            <div style="width:10px;">
                                <div class="rounded-circle bg-success" style="width:12px;height:12px;"></div>
                            </div>

                            <div>
                                <div class="fw-bold">Update Data</div>
                                <div class="text-muted small">Perubahan terakhir pada data surat.</div>
                                <div class="text-muted small">{{ $data->updated_at?->translatedFormat('d M Y H:i') }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mt-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-2">Verifikasi Dokumen</h6>
                    <div class="text-muted small mb-3">
                        QR Code muncul di PDF. Scan untuk cek keaslian dan status dokumen.
                    </div>

                    @if (Route::has('verifikasi.surat_keluar'))
                        <a class="btn btn-outline-success rounded-pill"
                           href="{{ route('verifikasi.surat_keluar', $data->id) }}" target="_blank">
                            <i class="bi bi-qr-code-scan me-2"></i> Buka Halaman Verifikasi
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
