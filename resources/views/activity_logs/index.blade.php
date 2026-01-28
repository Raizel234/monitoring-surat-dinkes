<x-app-layout>
    <style>
        .page-title {
            font-family: 'Playfair Display', serif;
            color: #198754;
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
            background-color: #f9fffb;
            transition: 0.2s;
        }
        .badge-type {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.7rem;
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-4 px-2">
        <div>
            <h4 class="page-title mb-0">Log Aktivitas</h4>
            <p class="text-muted small mb-0">Riwayat aktivitas pengguna pada sistem.</p>
        </div>
    </div>

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
                        <th>Waktu</th>
                        <th>Aksi</th>
                        <th>Modul</th>
                        <th>Deskripsi</th>
                        <th class="text-center">User</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $d)
                        <tr>
                            <td class="text-center fw-bold text-muted">
                                {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                            </td>
                            <td>
                                <div class="fw-semibold">
                                    {{ \Carbon\Carbon::parse($d->created_at)->format('d M Y') }}
                                </div>
                                <div class="small text-muted">
                                    {{ \Carbon\Carbon::parse($d->created_at)->format('H:i:s') }}
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-success badge-type">{{ $d->aksi ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="fw-semibold text-dark">{{ $d->modul ?? '-' }}</span>
                            </td>
                            <td class="text-muted">
                                {{ $d->keterangan ?? '-' }}
                            </td>
                            <td class="text-center">
                                <div class="fw-semibold">{{ $d->user_name ?? '-' }}</div>
                                <div class="small text-muted">{{ $d->user_email ?? '-' }}</div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-folder2-open fs-1 d-block mb-3"></i>
                                Belum ada log aktivitas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($data, 'links'))
            <div class="p-3">
                {{ $data->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
