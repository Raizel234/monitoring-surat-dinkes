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

    {{-- alert --}}
    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif

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
                            <td class="fw-semibold">:
                                {{ \Carbon\Carbon::parse($data->tanggal_surat)->translatedFormat('d M Y') }}</td>
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
                                    if ($data->status === 'Diproses') {
                                        $badgeClass = 'bg-warning text-dark';
                                    } elseif ($data->status === 'Selesai') {
                                        $badgeClass = 'bg-secondary text-white';
                                    }
                                @endphp
                                : <span class="badge rounded-pill {{ $badgeClass }}">{{ $data->status }}</span>
                            </td>
                        </tr>
                    </table>

                    {{-- METADATA INSTANSI --}}
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

                        @if (Route::has('surat-masuk.kendali.pdf'))
                            <a href="{{ route('surat-masuk.kendali.pdf', $data->id) }}"
                                class="btn btn-outline-dark rounded-pill">
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

            {{-- TIMELINE --}}
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Timeline Status Surat</h6>

                    {{-- kalau punya $logs, tampilkan --}}
                    @if (!empty($logs) && $logs->count())
                        <div class="timeline">
                            @foreach ($logs as $log)
                                <div class="timeline-item">
                                    <div class="timeline-dot"></div>
                                    <div class="fw-bold">{{ $log->action ?? 'Aktivitas' }}</div>
                                    <div class="text-muted small">{{ $log->description ?? '-' }}</div>
                                    <div class="text-muted small">
                                        {{ $log->created_at?->translatedFormat('d M Y H:i') }}</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-muted small">
                            Timeline belum tersedia.
                        </div>
                    @endif
                </div>
            </div>

            {{-- VERIFIKASI --}}
            <div class="card border-0 shadow-sm rounded-4 mt-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-2">Verifikasi Dokumen</h6>
                    <div class="text-muted small mb-3">
                        QR Code muncul di PDF. Scan untuk cek keaslian dan status dokumen.
                    </div>

                    @if (Route::has('verifikasi.surat_masuk'))
                        <a class="btn btn-outline-success rounded-pill"
                            href="{{ route('verifikasi.surat_masuk', $data->id) }}" target="_blank">
                            <i class="bi bi-qr-code-scan me-2"></i> Buka Halaman Verifikasi
                        </a>
                    @endif
                </div>
            </div>

            {{-- HISTORI DIBACA --}}
            <div class="card border-0 shadow-sm rounded-4 mt-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Histori Dibaca</h6>

                    @forelse($data->recipients as $r)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <div>
                                <div class="fw-semibold">{{ $r->user->name ?? '-' }}</div>
                                <div class="small text-muted">
                                    {{ $r->user->jabatan ?? '-' }}
                                    {{ $r->user->instansi ? ' - ' . $r->user->instansi : '' }}
                                </div>
                            </div>

                            <div class="text-end">
                                @if ($r->read_at)
                                    <span class="badge bg-success">Sudah Dibaca</span>
                                    <div class="small text-muted">{{ $r->read_at->translatedFormat('d M Y H:i') }}
                                    </div>
                                @else
                                    <span class="badge bg-secondary">Belum Dibaca</span>
                                @endif

                                {{-- ✅ hanya penerima yg bisa toggle statusnya sendiri --}}
                                @if (auth()->id() === (int) $r->user_id)
                                    <<form method="POST"
                                        action="{{ route('surat-masuk.recipient.toggle-read', [$data->id, $r->id]) }}"
                                        class="mt-2">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-success rounded-pill">
                                            {{ $r->read_at ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}
                                        </button>
                                        </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-muted small">Belum ada penerima.</div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
