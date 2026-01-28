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
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.06);
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
            background: rgba(25,135,84,0.25);
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
        <h4 class="page-title mb-1">Detail Surat Keluar</h4>
        <p class="text-muted small mb-0">Informasi lengkap dan riwayat status surat keluar.</p>
    </div>

    <div class="row g-4">
        {{-- KIRI: Informasi Surat --}}
        <div class="col-lg-6">
            <div class="card-box">
                <h6 class="fw-bold mb-3">Informasi Surat</h6>

                <table class="info-table w-100">
                    <tr>
                        <td class="info-label">Nomor Agenda</td>
                        <td>: {{ $data->nomor_agenda ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="info-label">Nomor Surat</td>
                        <td>: {{ $data->nomor_surat }}</td>
                    </tr>
                    <tr>
                        <td class="info-label">Tanggal Surat</td>
                        <td>: {{ \Carbon\Carbon::parse($data->tanggal_surat)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td class="info-label">Tujuan</td>
                        <td>: {{ $data->tujuan }}</td>
                    </tr>
                    <tr>
                        <td class="info-label">Perihal</td>
                        <td>: {{ $data->perihal }}</td>
                    </tr>
                    <tr>
                        <td class="info-label">Status</td>
                        <td>
                            @php
                                $badgeClass = 'bg-warning text-dark';
                                if ($data->status === 'Terkirim') $badgeClass = 'bg-success text-white';
                                elseif ($data->status === 'Draft') $badgeClass = 'bg-secondary text-white';
                            @endphp
                            : <span class="badge-status {{ $badgeClass }}">{{ $data->status }}</span>
                        </td>
                    </tr>
                </table>

                <div class="mt-4">
                    @if ($data->file_surat)
                        <a href="{{ asset('storage/' . $data->file_surat) }}" target="_blank"
                           class="btn btn-primary w-100 btn-file">
                            <i class="bi bi-file-earmark-pdf-fill me-2"></i> Lihat File
                        </a>
                    @else
                        <button class="btn btn-outline-secondary w-100 btn-file" disabled>
                            <i class="bi bi-file-earmark-x me-2"></i> Tidak Ada File
                        </button>
                    @endif
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('surat-keluar.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        {{-- KANAN: Timeline --}}
        <div class="col-lg-6">
            <div class="card-box">
                <h6 class="fw-bold mb-3">Timeline Status Surat</h6>

                @if(isset($timeline) && $timeline->count())
                    @foreach ($timeline as $t)
                        <div class="timeline-item">
                            <div class="fw-bold">{{ $t->aksi }}</div>
                            <div class="text-muted small">
                                {{ $t->keterangan }}
                                <br>
                                {{ \Carbon\Carbon::parse($t->created_at)->format('d M Y H:i') }}
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-muted small">Belum ada timeline.</div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
