<x-app-layout>
    <style>
        .page-title {
            font-family: 'Playfair Display', serif;
            color: #0f5132; /* Hijau lebih gelap untuk Surat Keluar */
            font-weight: 700;
        }

        .table-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            overflow: hidden;
            background: white;
        }

        .table thead {
            background-color: #f8f9fa;
        }

        .table thead th {
            border: none;
            color: #495057;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            padding: 15px;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            color: #444;
            border-bottom: 1px solid #f1f1f1;
        }

        .table tbody tr:hover {
            background-color: #fcfcfc;
            transition: 0.2s;
        }

        .btn-add {
            background-color: #198754;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-add:hover {
            background-color: #0f5132;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.7rem;
            text-transform: uppercase;
        }

        .action-btn {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: 0.3s;
            border: none;
        }

        /* ✅ Filter card (ringan, tidak merusak tampilan) */
        .filter-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            background: #fff;
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-4 px-2">
        <div>
            <h4 class="page-title mb-0">Data Surat Keluar</h4>
            <p class="text-muted small mb-0">Arsip surat yang dikirimkan oleh Dinas Kesehatan Sumenep.</p>
        </div>
        <a href="{{ route('surat-keluar.create') }}" class="btn btn-success btn-add">
            <i class="bi bi-send-plus me-2"></i> Tambah Surat Keluar
        </a>
    </div>

    {{-- ✅ Form Filter & Search --}}
    <div class="card filter-card mb-4">
        <div class="p-3">
            <form method="GET" action="{{ route('surat-keluar.index') }}">
                <div class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label small text-muted mb-1">Cari (Nomor/Tujuan/Perihal)</label>
                        <input type="text" name="q" value="{{ request('q') }}"
                               class="form-control rounded-3"
                               placeholder="Contoh: 100/.. / Puskesmas / Permohonan">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Status</label>
                        <select name="status" class="form-select rounded-3">
                            <option value="">Semua</option>
                            <option value="Draft" {{ request('status')=='Draft' ? 'selected' : '' }}>Draft</option>
                            <option value="Dikirim" {{ request('status')=='Dikirim' ? 'selected' : '' }}>Dikirim</option>
                            <option value="Terkirim" {{ request('status')=='Terkirim' ? 'selected' : '' }}>Terkirim</option>
                            <option value="Selesai" {{ request('status')=='Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Dari Tanggal</label>
                        <input type="date" name="from" value="{{ request('from') }}"
                               class="form-control rounded-3">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Sampai Tanggal</label>
                        <input type="date" name="to" value="{{ request('to') }}"
                               class="form-control rounded-3">
                    </div>

                    <div class="col-md-2 d-flex gap-2">
                        <button class="btn btn-success w-100 rounded-3">
                            <i class="bi bi-search me-1"></i> Filter
                        </button>
                        <a href="{{ route('surat-keluar.index') }}" class="btn btn-outline-secondary w-100 rounded-3">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 d-flex align-items-center mb-4" role="alert">
            <i class="bi bi-check-all me-2 fs-4"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card table-card">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nomor & Tanggal Surat</th>
                        <th>Tujuan Instansi</th>
                        <th class="text-center">Lampiran</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $d)
                        <tr>
                            <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $d->nomor_surat }}</div>
                                <div class="small text-muted">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ \Carbon\Carbon::parse($d->tanggal_surat)->format('d/m/Y') }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-light p-2 rounded-3 me-2 text-primary">
                                        <i class="bi bi-geo-alt-fill"></i>
                                    </div>
                                    <span class="fw-medium text-secondary">{{ $d->tujuan }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                @if ($d->file_surat)
                                    <a href="{{ asset('storage/' . $d->file_surat) }}" target="_blank"
                                        class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow-sm">
                                        <i class="bi bi-file-earmark-pdf-fill me-1"></i> PDF
                                    </a>
                                @else
                                    <span class="badge bg-light text-muted border fw-normal">Kosong</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="badge-status {{ $d->status == 'Terkirim' ? 'bg-success text-white' : 'bg-warning text-dark' }}">
                                    {{ $d->status }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('surat-keluar.edit', $d->id) }}"
                                       class="btn btn-warning action-btn text-white"
                                       title="Edit Surat">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('surat-keluar.destroy', $d->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data surat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger action-btn" title="Hapus Surat">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-3 opacity-25"></i>
                                    <p class="mb-0 fw-bold">Belum Ada Data</p>
                                    <small>Silakan tambahkan surat keluar baru melalui tombol di atas.</small>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
