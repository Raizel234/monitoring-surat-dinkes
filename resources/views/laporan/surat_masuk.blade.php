<x-app-layout>
    <style>
        .page-title {
            font-family: 'Playfair Display', serif;
            color: #198754;
            font-weight: 700;
        }
        .card-soft {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            background: #fff;
        }
        .badge-status {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.7rem;
        }
        .btn-action {
            border-radius: 10px;
            font-weight: 600;
            padding: 10px 18px;
        }
        .form-control, .form-select {
            border-radius: 12px;
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="page-title mb-0">Laporan Surat Masuk</h4>
            <p class="text-muted small mb-0">Filter data surat masuk dan export PDF.</p>
        </div>

        <a href="{{ route('laporan.surat_masuk.pdf', request()->query()) }}"
           class="btn btn-danger btn-action">
            <i class="bi bi-file-earmark-pdf-fill me-2"></i> Export PDF
        </a>
    </div>

    <div class="card card-soft mb-4">
        <div class="p-3">
            <form method="GET" action="{{ route('laporan.surat_masuk') }}">
                <div class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label small text-muted mb-1">Cari (Nomor/Pengirim/Perihal)</label>
                        <input type="text" name="q" value="{{ request('q') }}" class="form-control">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua</option>
                            <option value="Diterima" {{ request('status')=='Diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="Diproses" {{ request('status')=='Diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="Selesai"  {{ request('status')=='Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Dari</label>
                        <input type="date" name="from" value="{{ request('from') }}" class="form-control">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Sampai</label>
                        <input type="date" name="to" value="{{ request('to') }}" class="form-control">
                    </div>

                    <div class="col-md-2 d-flex gap-2">
                        <button class="btn btn-success btn-action w-100">
                            <i class="bi bi-search me-1"></i> Filter
                        </button>
                        <a href="{{ route('laporan.surat_masuk') }}" class="btn btn-outline-secondary btn-action w-100">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-soft">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nomor Surat</th>
                        <th>Pengirim</th>
                        <th>Perihal</th>
                        <th>Tanggal</th>
                        <th class="text-center">Disposisi</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $d)
                        <tr>
                            <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $d->nomor_surat }}</td>
                            <td>{{ $d->pengirim }}</td>
                            <td>{{ $d->perihal }}</td>
                            <td>
                                <i class="bi bi-calendar-event me-1 text-muted"></i>
                                {{ \Carbon\Carbon::parse($d->tanggal_surat)->format('d M Y') }}
                            </td>
                            <td class="text-center">{{ $d->disposisis_count ?? 0 }}</td>
                            <td class="text-center">
                                @php
                                    $badge = 'bg-success text-white';
                                    if ($d->status === 'Diproses') $badge = 'bg-warning text-dark';
                                    if ($d->status === 'Selesai')  $badge = 'bg-secondary text-white';
                                @endphp
                                <span class="badge-status {{ $badge }}">{{ $d->status }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-folder2-open fs-1 d-block mb-3"></i>
                                Data tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
