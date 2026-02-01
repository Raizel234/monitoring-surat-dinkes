<x-app-layout>
    <style>
        .page-title {
            font-family: 'Playfair Display', serif;
            color: #198754;
            font-weight: 700;
        }

        .form-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            background: #fff;
            border-top: 5px solid #0dcaf0;
            /* Aksen warna cyan/biru muda untuk membedakan dengan surat masuk */
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            font-size: 0.85rem;
            margin-bottom: 8px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
        }

        .form-label i {
            margin-right: 8px;
            color: #198754;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            transition: all 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.1);
        }

        .file-preview-box {
            background-color: #f0f7f4;
            border-radius: 12px;
            padding: 15px;
            border: 1px solid #d1e7dd;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .btn-update {
            background-color: #198754;
            border: none;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-update:hover {
            background-color: #146c43;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3);
        }

        .section-divider {
            height: 1px;
            background: #eee;
            margin: 2.5rem 0 1.5rem 0;
            position: relative;
        }

        .section-divider span {
            position: absolute;
            top: -12px;
            left: 20px;
            background: #fff;
            padding: 0 10px;
            color: #bbb;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>

    <div class="container-fluid py-4 px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="page-title mb-0">Edit Surat Keluar</h4>
                <p class="text-muted small">ID Surat: <span
                        class="badge bg-light text-dark border">#SK-{{ str_pad($data->id, 4, '0', STR_PAD_LEFT) }}</span>
                </p>
            </div>
            <a href="{{ route('surat-keluar.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                <i class="bi bi-arrow-left me-1"></i> Batal & Kembali
            </a>
        </div>

        <div class="card form-card">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('surat-keluar.update', $data->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="section-divider">
                        <span>Inti Dokumentasi</span>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-8">
                            <label class="form-label"><i class="bi bi-hash"></i>Nomor Surat</label>
                            <input type="text" name="nomor_surat" class="form-control"
                                value="{{ old('nomor_surat', $data->nomor_surat) }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label"><i class="bi bi-calendar-check"></i>Tanggal Keluar</label>
                            <input type="date" name="tanggal_surat" class="form-control"
                                value="{{ old('tanggal_surat', $data->tanggal_surat) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-geo-alt"></i>Tujuan Instansi</label>
                            <input type="text" name="tujuan" class="form-control"
                                value="{{ old('tujuan', $data->tujuan) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-card-heading"></i>Perihal Surat</label>
                            <input type="text" name="perihal" class="form-control"
                                value="{{ old('perihal', $data->perihal) }}" required>
                        </div>
                    </div>

                    <div class="section-divider">
                        <span>Berkas & Status Pengiriman</span>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-7">
                            <label class="form-label"><i class="bi bi-file-earmark-arrow-up"></i>Perbarui Berkas
                                (PDF)</label>
                            <input type="file" name="file_surat" class="form-control" accept=".pdf">

                            @if ($data->file_surat)
                                <div class="file-preview-box">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-file-pdf-fill text-danger fs-3 me-3"></i>
                                        <div>
                                            <div class="small fw-bold text-dark">Berkas Terlampir</div>
                                            <div class="text-muted small">Klik lihat untuk memeriksa file lama</div>
                                        </div>
                                    </div>
                                    <a href="{{ asset('storage/' . $data->file_surat) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary px-3 rounded-pill">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-5">
                            <label class="form-label"><i class="bi bi-info-circle"></i>Status Surat</label>
                            <select name="status" class="form-select">
                                <option value="Draft" {{ $data->status == 'Draft' ? 'selected' : '' }}>Draft (Arsip
                                    Internal)</option>
                                <option value="Dikirim" {{ $data->status == 'Dikirim' ? 'selected' : '' }}>Dikirim
                                    (Menunggu Respon)</option>
                                <option value="Selesai" {{ $data->status == 'Selesai' ? 'selected' : '' }}>Selesai
                                    (Terkonfirmasi)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-5 d-flex justify-content-end gap-3 border-top pt-4">
                        <button type="submit" class="btn btn-success btn-update text-white">
                            <i class="bi bi-save2 me-2"></i> Simpan Perubahan
                        </button>
                    </div>
                    @include('partials.metadata_instansi')

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
