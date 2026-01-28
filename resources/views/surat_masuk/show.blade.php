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
        <h4 class="fw-bold text-success mb-1">Detail Surat Masuk</h4>
        <p class="text-muted small mb-0">Informasi lengkap dan riwayat status surat</p>
    </div>

    <div class="row g-4">
        {{-- INFO SURAT --}}
        <div class="col-lg-6">
            <div class="card shadow-sm rounded-4 p-4">
                <h6 class="fw-bold mb-3">Informasi Surat</h6>
                <table class="table table-borderless small">
                    <tr>
                        <td class="text-muted">Nomor Agenda</td>
                        <td>: {{ $data->nomor_agenda }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Nomor Surat</td>
                        <td>: {{ $data->nomor_surat }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tanggal Surat</td>
                        <td>: {{ \Carbon\Carbon::parse($data->tanggal_surat)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Pengirim</td>
                        <td>: {{ $data->pengirim }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Perihal</td>
                        <td>: {{ $data->perihal }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status</td>
                        <td>
                            <span class="badge bg-success">{{ $data->status }}</span>
                        </td>
                    </tr>
                </table>

                @if($data->file_surat)
                    <a href="{{ asset('storage/'.$data->file_surat) }}" target="_blank"
                       class="btn btn-outline-primary btn-sm rounded-pill">
                        <i class="bi bi-file-earmark-pdf"></i> Lihat File
                    </a>
                @endif
            </div>
        </div>

        {{-- TIMELINE --}}
        <div class="col-lg-6">
            <div class="card shadow-sm rounded-4 p-4">
                <h6 class="fw-bold mb-3">Timeline Status Surat</h6>

                @if($logs->count())
                    <div class="timeline">
                        @foreach($logs as $log)
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="fw-semibold">{{ $log->aksi }}</div>
                                <div class="text-muted small">
                                    {{ $log->keterangan }}
                                </div>
                                <div class="text-muted small">
                                    {{ \Carbon\Carbon::parse($log->created_at)->format('d M Y H:i') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted small">Belum ada riwayat.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('surat-masuk.index') }}" class="btn btn-secondary btn-sm">
            ← Kembali
        </a>
    </div>
</x-app-layout>
