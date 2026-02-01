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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .section-title {
            font-weight: 700;
            color: #198754;
            margin-bottom: 12px;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 10px 12px;
        }

        .btn-green {
            background-color: #198754;
            border: none;
            border-radius: 10px;
            padding: 10px 18px;
            font-weight: 600;
            transition: 0.3s;
            color: #fff;
        }

        .btn-green:hover {
            background-color: #146c43;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(25, 135, 84, 0.2);
        }

        .btn-gray {
            background: #e9ecef;
            border: none;
            border-radius: 10px;
            padding: 10px 18px;
            font-weight: 600;
            transition: 0.2s;
            color: #333;
        }

        .btn-gray:hover {
            background: #dee2e6;
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

        .badge-status {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.75rem;
        }
    </style>

    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="page-title mb-0">Disposisi Surat Masuk</h4>
                <p class="text-muted small mb-0">Monitoring tindak lanjut surat masuk berdasarkan disposisi.</p>
            </div>
            <a href="{{ route('surat-masuk.index') }}" class="btn btn-gray">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </a>
        </div>

        {{-- ✅ Pesan sukses --}}
        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- ✅ Error --}}
        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm rounded-4" role="alert">
                <div class="fw-bold mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i> Periksa input Anda</div>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ✅ Informasi surat --}}
        <div class="card card-soft mb-4">
            <div class="p-4">
                <div class="section-title">Informasi Surat</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="text-muted small">Nomor Surat</div>
                        <div class="fw-bold">{{ $data->nomor_surat }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small">Tanggal Surat</div>
                        <div class="fw-bold">{{ \Carbon\Carbon::parse($data->tanggal_surat)->format('d M Y') }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small">Pengirim</div>
                        <div class="fw-bold">{{ $data->pengirim }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small">Perihal</div>
                        <div class="fw-bold">{{ $data->perihal }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ✅ Form disposisi --}}
        <div class="card card-soft mb-4">
            <div class="p-4">
                <div class="section-title">Buat Disposisi</div>

                <form method="POST" action="{{ route('surat-masuk.disposisi.store', $data->id) }}">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tujuan Disposisi</label>
                            <input type="text" name="tujuan" value="{{ old('tujuan') }}" class="form-control"
                                required placeholder="Contoh: Kepala Bidang P2P / Sekretariat / Keuangan">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Prioritas</label>
                            <select name="prioritas" class="form-select" required>
                                <option value="Rendah" {{ old('prioritas') == 'Rendah' ? 'selected' : '' }}>Rendah
                                </option>
                                <option value="Sedang" {{ old('prioritas', 'Sedang') == 'Sedang' ? 'selected' : '' }}>
                                    Sedang</option>
                                <option value="Tinggi" {{ old('prioritas') == 'Tinggi' ? 'selected' : '' }}>Tinggi
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Batas Waktu (Opsional)</label>
                            <input type="date" name="batas_waktu" value="{{ old('batas_waktu') }}"
                                class="form-control">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Instruksi</label>
                            <textarea name="instruksi" rows="4" class="form-control" placeholder="Tuliskan instruksi disposisi (opsional)">{{ old('instruksi') }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-green">
                            <i class="bi bi-send me-2"></i> Simpan Disposisi
                        </button>
                        <a href="{{ route('surat-masuk.disposisi.pdf', $data->id) }}"
                            class="btn btn-gray" target="_blank">
                            Cetak Lembar Disposisi (PDF)
                        </a>
                        <a href="{{ route('surat-masuk.index') }}" class="btn btn-gray">
                            Batal
                        </a>

                    </div>
                </form>
            </div>
        </div>

        {{-- ✅ Riwayat disposisi + ubah status --}}
        <div class="card card-soft">
            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="section-title mb-0">Riwayat Disposisi</div>
                    <span class="badge bg-light text-dark border">
                        Total: {{ $data->disposisis->count() }}
                    </span>
                </div>

                @if ($data->disposisis->count() == 0)
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                        Belum ada disposisi untuk surat ini.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Tujuan</th>
                                    <th>Instruksi</th>
                                    <th>Prioritas</th>
                                    <th>Batas Waktu</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Ubah Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->disposisis as $disp)
                                    @php
                                        $badge = 'bg-warning text-dark';
                                        if ($disp->status == 'Menunggu') {
                                            $badge = 'bg-secondary text-white';
                                        }
                                        if ($disp->status == 'Diproses') {
                                            $badge = 'bg-warning text-dark';
                                        }
                                        if ($disp->status == 'Selesai') {
                                            $badge = 'bg-success text-white';
                                        }
                                    @endphp
                                    <tr>
                                        <td class="fw-semibold">{{ $disp->tujuan }}</td>
                                        <td>{{ $disp->instruksi ?? '-' }}</td>
                                        <td>{{ $disp->prioritas }}</td>
                                        <td>{{ $disp->batas_waktu ? \Carbon\Carbon::parse($disp->batas_waktu)->format('d M Y') : '-' }}
                                        </td>
                                        <td class="text-center">
                                            <span class="badge-status {{ $badge }}">{{ $disp->status }}</span>
                                        </td>
                                        <td class="text-center">
                                            <form method="POST"
                                                action="{{ route('disposisi.updateStatus', $disp->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="form-select form-select-sm"
                                                    onchange="this.form.submit()">
                                                    <option value="Menunggu"
                                                        {{ $disp->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                                    <option value="Diproses"
                                                        {{ $disp->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                                    <option value="Selesai"
                                                        {{ $disp->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>

    </div>
</x-app-layout>
