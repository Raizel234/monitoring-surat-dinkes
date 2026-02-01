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
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            background: #fff;
            border-top: 5px solid #ffc107; /* Warna kuning sebagai penanda mode edit */
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            font-size: 0.9rem;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .form-label i {
            margin-right: 8px;
            color: #198754;
        }

        .form-control, .form-select {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.1);
        }

        .btn-update {
            background-color: #198754;
            border: none;
            border-radius: 12px;
            padding: 12px 25px;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-update:hover {
            background-color: #146c43;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3);
        }

        .current-file-box {
            background-color: #f8f9fa;
            border-radius: 12px;
            padding: 15px;
            border: 1px dashed #dee2e6;
            margin-top: 10px;
        }

        .section-divider {
            height: 1px;
            background: #eee;
            margin: 2rem 0;
            position: relative;
        }

        .section-divider span {
            position: absolute;
            top: -12px;
            left: 20px;
            background: #fff;
            padding: 0 10px;
            color: #999;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }
    </style>

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="page-title mb-0">Edit Surat Masuk</h4>
                <p class="text-muted small">Memperbarui data surat: <strong>{{ $data->nomor_surat }}</strong></p>
            </div>
            <a href="{{ route('surat-masuk.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
            </a>
        </div>

        <div class="card form-card">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('surat-masuk.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="section-divider">
                        <span><i class="bi bi-pencil-square me-1"></i> Perubahan Informasi</span>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-8">
                            <label class="form-label"><i class="bi bi-hash"></i>Nomor Surat</label>
                            <input type="text" name="nomor_surat" class="form-control"
                                   value="{{ old('nomor_surat', $data->nomor_surat) }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label"><i class="bi bi-calendar-check"></i>Tanggal Surat</label>
                            <input type="date" name="tanggal_surat" class="form-control"
                                   value="{{ old('tanggal_surat', $data->tanggal_surat) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-building"></i>Instansi Pengirim</label>
                            <input type="text" name="pengirim" class="form-control"
                                   value="{{ old('pengirim', $data->pengirim) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-card-heading"></i>Perihal</label>
                            <input type="text" name="perihal" class="form-control"
                                   value="{{ old('perihal', $data->perihal) }}" required>
                        </div>
                    </div>

                    <div class="section-divider">
                        <span><i class="bi bi-paperclip me-1"></i> Berkas & Validasi</span>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-7">
                            <label class="form-label"><i class="bi bi-file-earmark-pdf"></i>Ganti File Surat (Opsional)</label>
                            <input type="file" name="file_surat" class="form-control" accept=".pdf">

                            @if ($data->file_surat)
                                <div class="current-file-box d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center text-primary">
                                        <i class="bi bi-file-earmark-check fs-4 me-2"></i>
                                        <span class="small fw-bold">File saat ini sudah tersimpan</span>
                                    </div>
                                    <a href="{{ asset('storage/' . $data->file_surat) }}" target="_blank" class="btn btn-sm btn-primary rounded-pill px-3">
                                        <i class="bi bi-eye me-1"></i> Lihat Berkas
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-5">
                            <label class="form-label"><i class="bi bi-flag"></i>Update Status</label>
                            <select name="status" class="form-select">
                                <option value="Diterima" {{ $data->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="Diproses" {{ $data->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="Selesai" {{ $data->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-5 d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-success btn-update px-5 text-white">
                            <i class="bi bi-check-circle me-2"></i> Perbarui Data Surat
                        </button>
                    </div>
                    @include('partials.metadata_instansi')

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
