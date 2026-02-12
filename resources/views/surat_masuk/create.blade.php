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

        .btn-save {
            background-color: #198754;
            border: none;
            border-radius: 12px;
            padding: 12px 25px;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-save:hover {
            background-color: #146c43;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3);
        }

        .btn-cancel {
            border-radius: 12px;
            padding: 12px 25px;
            font-weight: 600;
            background-color: #f8f9fa;
            color: #6c757d;
            border: 1px solid #dee2e6;
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
                <h4 class="page-title mb-0">Tambah Surat Masuk</h4>
                <p class="text-muted small">Silakan lengkapi formulir di bawah ini dengan benar.</p>
            </div>
            <a href="{{ route('surat-masuk.index') }}" class="btn btn-cancel btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card form-card">
            <div class="card-body p-4 p-md-5">
                {{-- ERROR VALIDATION --}}
                @if ($errors->any())
                    <div class="alert alert-danger rounded-4">
                        <div class="fw-bold mb-1">Ada input yang belum benar:</div>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('surat-masuk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="section-divider">
                        <span><i class="bi bi-info-circle me-1"></i> Informasi Utama</span>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-8">
                            <label class="form-label"><i class="bi bi-hash"></i>Nomor Surat</label>
                            <input type="text" name="nomor_surat" class="form-control"
                                value="{{ old('nomor_surat') }}" placeholder="Contoh: 005/123/435.102.1/2026" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label"><i class="bi bi-calendar-event"></i>Tanggal Surat</label>
                            <input type="date" name="tanggal_surat" class="form-control"
                                value="{{ old('tanggal_surat') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-building"></i>Instansi Pengirim</label>
                            <input type="text" name="pengirim" class="form-control" value="{{ old('pengirim') }}"
                                placeholder="Masukkan nama instansi pengirim" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-card-text"></i>Perihal / Hal</label>
                            <input type="text" name="perihal" class="form-control" value="{{ old('perihal') }}"
                                placeholder="Ringkasan isi surat" required>
                        </div>
                    </div>

                    <div class="section-divider">
                        <span><i class="bi bi-paperclip me-1"></i> Lampiran & Status</span>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-7">
                            <label class="form-label"><i class="bi bi-file-earmark-pdf"></i>Unggah Scan Surat
                                (PDF)</label>
                            <input type="file" name="file_surat" class="form-control" accept=".pdf">
                            <small class="text-muted mt-2 d-block">Maksimal ukuran file: 5MB</small>
                        </div>

                        <div class="col-md-5">
                            <label class="form-label"><i class="bi bi-check2-circle"></i>Status Awal</label>
                            <select name="status" class="form-select">
                                <option value="Diterima"
                                    {{ old('status', 'Diterima') == 'Diterima' ? 'selected' : '' }}>
                                    Diterima</option>
                                <option value="Diproses" {{ old('status') == 'Diproses' ? 'selected' : '' }}>Diproses
                                </option>
                                <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai
                                </option>
                            </select>
                        </div>
                    </div>

                    {{-- ✅ METADATA INSTANSI (PASTI ADA DROPDOWN DATASLIST PEGAWAI UNTUK SURAT MASUK) --}}
                    @include('partials.metadata_instansi', [
                        'context' => 'surat_masuk',
                        'pegawai' => $pegawai ?? collect(),
                    ])

                    <hr class="my-5 opacity-50">

                    <div class="d-flex justify-content-end gap-3">
                        <button type="reset" class="btn btn-light px-4 rounded-3">Reset</button>
                        <button type="submit" class="btn btn-success btn-save px-5 text-white">
                            <i class="bi bi-cloud-arrow-up me-2"></i> Simpan Data Surat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
