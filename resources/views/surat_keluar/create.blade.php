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
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            font-size: 0.85rem;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
        }

        .form-label i {
            margin-right: 8px;
            color: #198754;
            font-size: 1.1rem;
        }

        .form-control, .form-select {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            transition: all 0.3s;
            background-color: #fdfdfd;
        }

        .form-control:focus, .form-select:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.1);
            background-color: #fff;
        }

        .btn-save {
            background-color: #198754;
            border: none;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-save:hover {
            background-color: #146c43;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3);
        }

        .btn-back {
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 600;
            color: #6c757d;
            border: 1px solid #dee2e6;
            background: #fff;
            transition: 0.3s;
        }

        .btn-back:hover {
            background: #f8f9fa;
            color: #333;
        }

        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .section-header hr {
            flex-grow: 1;
            margin: 0 15px;
            opacity: 0.1;
        }

        .section-header span {
            font-size: 0.8rem;
            font-weight: 700;
            color: #999;
            text-transform: uppercase;
        }
    </style>

    <div class="py-4 px-3">
        <div class="max-w-5xl mx-auto">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="page-title mb-0">Tambah Surat Keluar</h4>
                    <p class="text-muted small">Registrasi surat keluar baru dari Dinas Kesehatan.</p>
                </div>
                <a href="{{ route('surat-keluar.index') }}" class="btn btn-back">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <div class="card form-card">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('surat-keluar.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="section-header">
                            <span><i class="bi bi-info-square me-2"></i>Detail Administrasi</span>
                            <hr>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-8">
                                <label class="form-label"><i class="bi bi-hash"></i>Nomor Surat Keluar</label>
                                <input type="text" name="nomor_surat" class="form-control" placeholder="Masukan nomor resmi surat..." required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label"><i class="bi bi-calendar-event"></i>Tanggal Keluar</label>
                                <input type="date" name="tanggal_surat" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-send"></i>Tujuan Surat</label>
                                <input type="text" name="tujuan" class="form-control" placeholder="Nama Instansi/Orang tujuan" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-card-text"></i>Perihal</label>
                                <input type="text" name="perihal" class="form-control" placeholder="Inti dari isi surat" required>
                            </div>
                        </div>

                        <div class="section-header mt-5">
                            <span><i class="bi bi-paperclip me-2"></i>Lampiran & Status</span>
                            <hr>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-7">
                                <label class="form-label"><i class="bi bi-file-earmark-pdf"></i>File Scan Surat (PDF)</label>
                                <input type="file" name="file_surat" class="form-control" accept=".pdf">
                                <div class="mt-2 small text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Format PDF, Max size 5MB
                                </div>
                            </div>

                            <div class="col-md-5">
                                <label class="form-label"><i class="bi bi-activity"></i>Status Awal</label>
                                <select name="status" class="form-select">
                                    <option value="Draft">Draft (Arsip Internal)</option>
                                    <option value="Dikirim">Dikirim (Sudah Keluar)</option>
                                    <option value="Selesai">Selesai (Sudah Diterima Tujuan)</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-5 pt-3 d-flex justify-content-end gap-3 border-top">
                            <button type="reset" class="btn btn-light px-4 text-secondary fw-semibold rounded-pill">Reset</button>
                            <button type="submit" class="btn btn-success btn-save text-white rounded-pill px-5">
                                <i class="bi bi-check-circle-fill me-2"></i> Simpan Surat Keluar
                            </button>
                        </div>
                        @include('partials.metadata_instansi')

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
