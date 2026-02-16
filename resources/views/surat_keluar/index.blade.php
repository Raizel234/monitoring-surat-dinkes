<x-app-layout>
    <style>
        .page-title {
            font-family: 'Playfair Display', serif;
            color: #0f5132;
            font-weight: 700;
        }

        .table-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
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
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.7rem;
            text-transform: uppercase;
            display: inline-block;
            min-width: 88px;
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

        .filter-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            background: #fff;
        }

        .meta-pill {
            font-size: 0.72rem;
            border-radius: 999px;
            padding: 4px 10px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: #fff;
            color: #666;
        }

        .tujuan-box {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .tujuan-title {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: #8a8a8a;
            font-weight: 700;
        }

        .tujuan-value {
            font-weight: 600;
            color: #2f2f2f;
        }

        .tujuan-sub {
            font-size: .8rem;
            color: #6c757d;
        }
    </style>

    @php
        $templateLabels = [
            'lembar_kendali' => 'Lembar Kendali',
            'nota_dinas' => 'Nota Dinas',
            'surat_keputusan' => 'SK',
        ];

        function statusBadgeClass($status)
        {
            return match ($status) {
                'Draft' => 'bg-light text-dark border',
                'Dikirim' => 'bg-warning text-dark',
                'Terkirim' => 'bg-success text-white',
                'Selesai' => 'bg-primary text-white',
                default => 'bg-secondary text-white',
            };
        }
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-4 px-2">
        <div>
            <h4 class="page-title mb-0">Data Surat Keluar</h4>
            <p class="text-muted small mb-0">Arsip surat keluar. Semua pegawai dapat melihat.</p>
        </div>


    </div>

    {{-- ✅ Filter --}}
    <div class="card filter-card mb-4">
        <div class="p-3">
            <form method="GET" action="{{ route('surat-keluar.index') }}">
                <div class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label small text-muted mb-1">Cari (Nomor/Tujuan/Perihal)</label>
                        <input type="text" name="q" value="{{ request('q') }}" class="form-control rounded-3"
                            placeholder="Contoh: 100/.. / Puskesmas / Permohonan">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Status</label>
                        <select name="status" class="form-select rounded-3">
                            <option value="">Semua</option>
                            <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                            <option value="Dikirim" {{ request('status') == 'Dikirim' ? 'selected' : '' }}>Dikirim
                            </option>
                            <option value="Terkirim" {{ request('status') == 'Terkirim' ? 'selected' : '' }}>Terkirim
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
                        <a href="{{ route('surat-keluar.index') }}" class="btn btn-outline-secondary w-100 rounded-3">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
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
                        <th>Nomor & Tanggal Surat</th>
                        <th>Tujuan</th>
                        <th class="text-center">Lampiran</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($data as $d)
                        @php
                            $jenis = $d->jenis_surat ?? 'lembar_kendali';
                            $jenisLabel = $templateLabels[$jenis] ?? $jenis;

                            $pegawai = $d->tujuanUser; // relation
                        @endphp

                        <tr>
                            <td class="text-center fw-bold text-muted">
                                {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                            </td>

                            <td>
                                <div class="fw-bold text-dark">{{ $d->nomor_surat }}</div>

                                <div class="small text-muted">
                                    Agenda: {{ $d->nomor_agenda ?? '-' }}
                                    <span class="ms-2 meta-pill">
                                        <i class="bi bi-layout-text-sidebar-reverse me-1"></i>{{ $jenisLabel }}
                                    </span>
                                </div>

                                <div class="small text-muted">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ !empty($d->tanggal_surat) ? \Carbon\Carbon::parse($d->tanggal_surat)->format('d/m/Y') : '-' }}
                                </div>

                                @if ($d->sifat_surat || $d->klasifikasi || $d->unit_pengolah || $d->kategori_surat)
                                    <div class="small text-muted mt-1">
                                        @if ($d->kategori_surat)
                                            Jenis: {{ $d->kategori_surat }}
                                        @endif
                                        @if ($d->sifat_surat)
                                            {{ $d->kategori_surat ? ' | ' : '' }}Sifat: {{ $d->sifat_surat }}
                                        @endif
                                        @if ($d->klasifikasi)
                                            {{ $d->kategori_surat || $d->sifat_surat ? ' | ' : '' }}Klas:
                                            {{ $d->klasifikasi }}
                                        @endif
                                        @if ($d->unit_pengolah)
                                            {{ $d->kategori_surat || $d->sifat_surat || $d->klasifikasi ? ' | ' : '' }}Unit:
                                            {{ $d->unit_pengolah }}
                                        @endif
                                    </div>
                                @endif
                            </td>

                            {{-- ✅ Tujuan beda: instansi vs pegawai --}}
                            <td>
                                <div class="tujuan-box">
                                    <div class="d-flex gap-2 align-items-start">
                                        <div class="bg-light p-2 rounded-3 text-primary">
                                            <i class="bi bi-geo-alt-fill"></i>
                                        </div>
                                        <div>
                                            <div class="tujuan-title">Tujuan Instansi</div>
                                            <div class="tujuan-value">{{ $d->tujuan ?? '-' }}</div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 align-items-start mt-2">
                                        <div class="bg-light p-2 rounded-3 text-success">
                                            <i class="bi bi-person-badge"></i>
                                        </div>
                                        <div>
                                            <div class="tujuan-title">Tujuan Pegawai (Metadata)</div>

                                            @if ($pegawai)
                                                <div class="tujuan-value">{{ $pegawai->name }}</div>
                                                <div class="tujuan-sub">
                                                    {{ $pegawai->jabatan ?? '-' }}
                                                    {{ $pegawai->jabatan && $pegawai->instansi ? ' • ' : '' }}
                                                    {{ $pegawai->instansi ?? '' }}
                                                </div>
                                            @else
                                                <div class="tujuan-sub">-</div>
                                            @endif
                                        </div>
                                    </div>
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
                                <span class="badge-status {{ statusBadgeClass($d->status) }}">
                                    {{ $d->status ?? '-' }}
                                </span>
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    @if (auth()->user()->role === 'admin')
                                        <a href="{{ route('surat-keluar.edit', $d->id) }}"
                                            class="btn btn-warning action-btn text-white" title="Edit Surat">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    @endif
                                    @if (auth()->user()->role === 'pegawai')
                                        <a href="{{ route('surat-keluar.edit', $d->id) }}"
                                            class="btn btn-warning action-btn text-white" title="Edit Surat">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('surat-keluar.show', $d->id) }}"
                                        class="btn btn-info action-btn text-white" title="Detail">
                                        <i class="bi bi-eye"></i>
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
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-3 opacity-25"></i>
                                    <p class="mb-0 fw-bold">Belum Ada Data</p>
                                    <small>Silakan tambahkan surat keluar baru.</small>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if (method_exists($data, 'links'))
            <div class="p-3">
                {{ $data->withQueryString()->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
