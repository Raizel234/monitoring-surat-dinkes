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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
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

        .btn-add {
            background-color: #198754;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-add:hover {
            background-color: #146c43;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(25, 135, 84, 0.2);
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.7rem;
        }

        .action-btn {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: 0.3s;
        }

        /* ✅ Tombol Disposisi */
        .btn-disposisi {
            background-color: #0d6efd;
            color: #fff;
        }

        .btn-disposisi:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2);
        }

        /* ✅ Filter card (ringan, tidak merusak tampilan) */
        .filter-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            background: white;
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="page-title mb-0">Data Surat Masuk</h4>
            <p class="text-muted small mb-0">Manajemen administrasi surat yang masuk ke sistem.</p>
        </div>
       
    </div>

    {{-- ✅ FILTER & SEARCH --}}
    <div class="card filter-card mb-4">
        <div class="p-3">
            <form method="GET" action="{{ route('surat-masuk.index') }}">
                <div class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label small text-muted mb-1">Cari (Nomor/Pengirim/Perihal)</label>
                        <input type="text" name="q" value="{{ request('q') }}" class="form-control rounded-3"
                            placeholder="Contoh: 440/.. / RSUD / Permohonan">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Status</label>
                        <select name="status" class="form-select rounded-3">
                            <option value="">Semua</option>
                            <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima
                            </option>
                            <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses
                            </option>
                            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Dari Tanggal</label>
                        <input type="date" name="from" value="{{ request('from') }}"
                            class="form-control rounded-3">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Sampai Tanggal</label>
                        <input type="date" name="to" value="{{ request('to') }}" class="form-control rounded-3">
                    </div>

                    <div class="col-md-2 d-flex gap-2">
                        <button class="btn btn-success w-100 rounded-3">
                            <i class="bi bi-search me-1"></i> Filter
                        </button>
                        <a href="{{ route('surat-masuk.index') }}" class="btn btn-outline-secondary w-100 rounded-3">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
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
                        <th>Informasi Surat</th>
                        <th>Pengirim</th>
                        <th>Tanggal Terima</th>
                        <th class="text-center">File</th>
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
                                <div class="small text-muted">Agenda: {{ $d->nomor_agenda }}</div>
                                <div class="small text-muted">
                                    ID: #SRT-{{ str_pad($d->id, 4, '0', STR_PAD_LEFT) }}
                                </div>

                                {{-- Monitoring disposisi --}}
                                <div class="mt-1">
                                    <span class="badge bg-light text-dark border">
                                        Disposisi: {{ $d->disposisis_count ?? 0 }}
                                    </span>
                                </div>
                                @if ($d->sifat_surat || $d->klasifikasi || $d->unit_pengolah)
                                    <div class="small text-muted mt-1">
                                        {{ $d->sifat_surat ? 'Sifat: ' . $d->sifat_surat : '' }}
                                        {{ $d->klasifikasi ? ' | Klas: ' . $d->klasifikasi : '' }}
                                        {{ $d->unit_pengolah ? ' | Unit: ' . $d->unit_pengolah : '' }}
                                    </div>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-light p-2 rounded-circle me-2">
                                        <i class="bi bi-building text-success"></i>
                                    </div>
                                    <span>{{ $d->pengirim }}</span>
                                </div>
                            </td>

                            <td>
                                <i class="bi bi-calendar-event me-1 text-muted"></i>
                                {{ \Carbon\Carbon::parse($d->tanggal_surat)->format('d M Y') }}
                            </td>

                            <td class="text-center">
                                @if ($d->file_surat)
                                    <a href="{{ asset('storage/' . $d->file_surat) }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                        <i class="bi bi-file-earmark-pdf"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-muted small">Tidak ada file</span>
                                @endif
                            </td>

                            <td class="text-center">
                                @php
                                    $badgeClass = 'bg-success text-white';
                                    if ($d->status === 'Diproses') {
                                        $badgeClass = 'bg-warning text-dark';
                                    } elseif ($d->status === 'Selesai') {
                                        $badgeClass = 'bg-secondary text-white';
                                    }
                                @endphp

                                <span class="badge-status {{ $badgeClass }}">
                                    {{ $d->status }}
                                </span>
                            </td>

                            {{-- ===== KOLOM AKSI ===== --}}
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    {{-- DETAIL + TIMELINE --}}
                                    <a href="{{ route('surat-masuk.show', $d->id) }}"
                                        class="btn btn-info action-btn text-white" title="Detail & Timeline">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- DISPOSISI --}}
                                    <a href="{{ route('surat-masuk.disposisi.form', $d->id) }}"
                                        class="btn btn-disposisi action-btn" title="Disposisi Surat">
                                        @if (($d->disposisis_count ?? 0) > 0)
                                            <i class="bi bi-check2-circle"></i>
                                        @else
                                            <i class="bi bi-send"></i>
                                        @endif
                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('surat-masuk.edit', $d->id) }}"
                                        class="btn btn-warning action-btn text-white" title="Edit Data">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    {{-- HAPUS --}}
                                    <form action="{{ route('surat-masuk.destroy', $d->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger action-btn" title="Hapus Data">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-folder2-open fs-1 d-block mb-3"></i>
                                Belum ada data surat masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</x-app-layout>
