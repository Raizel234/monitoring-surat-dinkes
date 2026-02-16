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

        .form-control,
        .form-select,
        textarea.form-control {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            transition: all 0.3s;
            background-color: #fdfdfd;
        }

        .form-control:focus,
        .form-select:focus,
        textarea.form-control:focus {
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

        .hint {
            font-size: 0.82rem;
            color: #6c757d;
        }

        .soft-box {
            border: 1px dashed rgba(25, 135, 84, 0.35);
            background: rgba(25, 135, 84, 0.03);
            border-radius: 16px;
            padding: 16px;
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

                    <form action="{{ route('surat-keluar.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- ======================== --}}
                        {{-- DETAIL ADMINISTRASI --}}
                        {{-- ======================== --}}
                        <div class="section-header">
                            <span><i class="bi bi-info-square me-2"></i>Detail Administrasi</span>
                            <hr>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-8">
                                <label class="form-label"><i class="bi bi-hash"></i>Nomor Surat Keluar</label>
                                <input type="text" name="nomor_surat" class="form-control"
                                    value="{{ old('nomor_surat') }}" placeholder="Masukan nomor resmi surat..."
                                    required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label"><i class="bi bi-calendar-event"></i>Tanggal Surat</label>
                                <input type="date" name="tanggal_surat" class="form-control"
                                    value="{{ old('tanggal_surat') }}" required>
                                <div class="hint mt-1">Tanggal yang tertera pada surat.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-send"></i>Tujuan Surat</label>
                                <input type="text" name="tujuan" class="form-control" value="{{ old('tujuan') }}"
                                    placeholder="Nama Instansi/Orang tujuan" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-card-text"></i>Perihal</label>
                                <input type="text" name="perihal" class="form-control" value="{{ old('perihal') }}"
                                    placeholder="Inti dari isi surat" required>
                            </div>
                        </div>

                        {{-- ======================== --}}
                        {{-- JENIS SURAT --}}
                        {{-- ======================== --}}
                        <div class="section-header mt-5">
                            <span><i class="bi bi-ui-checks-grid me-2"></i>Jenis Surat & Template</span>
                            <hr>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-layers"></i>Jenis Surat (Template PDF)</label>
                                <select id="jenis_surat" name="jenis_surat" class="form-select" required>
                                    <option value="lembar_kendali"
                                        {{ old('jenis_surat', 'lembar_kendali') == 'lembar_kendali' ? 'selected' : '' }}>
                                        Lembar Kendali
                                    </option>
                                    <option value="nota_dinas" {{ old('jenis_surat') == 'nota_dinas' ? 'selected' : '' }}>
                                        Nota Dinas
                                    </option>
                                    <option value="surat_keputusan"
                                        {{ old('jenis_surat') == 'surat_keputusan' ? 'selected' : '' }}>
                                        Surat Keputusan (SK)
                                    </option>
                                </select>
                                <div class="hint mt-1">Template PDF mengikuti jenis surat yang dipilih.</div>
                            </div>

                            <div class="col-md-6">
                                <div class="soft-box">
                                    <div class="fw-bold mb-1"><i class="bi bi-printer me-2"></i>Info Cetak</div>
                                    <div class="small text-muted">
                                        Setelah disimpan, masuk halaman detail untuk cetak:
                                        <b>Lembar Kendali / Nota Dinas / SK</b>.
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ======================== --}}
                        {{-- LAMPIRAN & STATUS --}}
                        {{-- ======================== --}}
                        <div class="section-header mt-5">
                            <span><i class="bi bi-paperclip me-2"></i>Lampiran & Status</span>
                            <hr>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-7">
                                <label class="form-label"><i class="bi bi-file-earmark-pdf"></i>File Scan Surat
                                    (PDF)</label>
                                <input type="file" name="file_surat" class="form-control" accept=".pdf">
                                <div class="mt-2 small text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Format PDF, Max 5MB
                                </div>
                            </div>

                            <div class="col-md-5">
                                <label class="form-label"><i class="bi bi-activity"></i>Status Awal</label>
                                <select name="status" class="form-select">
                                    <option value="Draft" {{ old('status', 'Draft') == 'Draft' ? 'selected' : '' }}>
                                        Draft (Arsip Internal)
                                    </option>
                                    <option value="Dikirim" {{ old('status') == 'Dikirim' ? 'selected' : '' }}>
                                        Dikirim (Sudah Keluar)
                                    </option>
                                    <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>
                                        Selesai (Sudah Diterima Tujuan)
                                    </option>
                                </select>
                            </div>
                        </div>

                        {{-- ======================== --}}
                        {{-- FIELD KHUSUS NOTA DINAS --}}
                        {{-- ======================== --}}
                        <div id="section-nota-dinas" class="mt-5" style="display:none;">
                            <div class="section-header">
                                <span><i class="bi bi-file-text me-2"></i>Konten Nota Dinas</span>
                                <hr>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label"><i class="bi bi-person-badge"></i>Yth</label>
                                    <input type="text" name="yth" class="form-control"
                                        value="{{ old('yth') }}"
                                        placeholder="Contoh: Sdr. Kepala Puskesmas Pragaan">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label"><i class="bi bi-building"></i>Dari</label>
                                    <input type="text" name="dari" class="form-control"
                                        value="{{ old('dari') }}"
                                        placeholder="Contoh: Kepala Dinas Kesehatan Kab. Sumenep">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label"><i class="bi bi-people"></i>Tembusan</label>
                                    <textarea name="tembusan" class="form-control" rows="2" placeholder="Pisahkan dengan enter jika lebih dari 1">{{ old('tembusan') }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label"><i class="bi bi-paperclip"></i>Lampiran (Nota
                                        Dinas)</label>
                                    <input type="text" name="lampiran" class="form-control"
                                        value="{{ old('lampiran') }}" placeholder="Contoh: 1 (satu) berkas / -">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label"><i class="bi bi-body-text"></i>Isi Nota Dinas
                                        (Opsional)</label>
                                    <textarea name="isi" class="form-control" rows="5" placeholder="(Opsional) tambahan isi nota dinas...">{{ old('isi') }}</textarea>
                                    <div class="hint mt-1">Bagian isi tambahan (boleh dikosongkan).</div>
                                </div>
                            </div>

                            {{-- ✅ INI BAGIAN PENGGANTI TITIK-TITIK --}}
                            <div class="section-header mt-5">
                                <span><i class="bi bi-card-list me-2"></i>Data Penelitian (Nota Dinas)</span>
                                <hr>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label"><i class="bi bi-link-45deg"></i>Nomor Surat
                                        Rujukan</label>
                                    <input type="text" name="rujukan_nomor" class="form-control"
                                        value="{{ old('rujukan_nomor') }}"
                                        placeholder="Contoh: 058/D-WD.I-FIK/PP-01/UNJA/II/2026">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label"><i class="bi bi-tag"></i>Perihal Rujukan</label>
                                    <input type="text" name="rujukan_perihal" class="form-control"
                                        value="{{ old('rujukan_perihal') }}"
                                        placeholder="Contoh: Permohonan Izin Observasi">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label"><i class="bi bi-person"></i>Nama</label>
                                    <input type="text" name="nama_peneliti" class="form-control"
                                        value="{{ old('nama_peneliti') }}" placeholder="Contoh: Fidia Azizah">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label"><i class="bi bi-123"></i>NPM</label>
                                    <input type="text" name="npm" class="form-control"
                                        value="{{ old('npm') }}" placeholder="Contoh: 722621778">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label"><i class="bi bi-journal-text"></i>Tentang</label>
                                    <input type="text" name="tentang" class="form-control"
                                        value="{{ old('tentang') }}"
                                        placeholder="Contoh: Pengelolaan Poliuri pada Lansia Penderita Diabetes Mellitus di Puskesmas Pragaan">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label"><i class="bi bi-building"></i>Nama Lembaga</label>
                                    <input type="text" name="nama_lembaga" class="form-control"
                                        value="{{ old('nama_lembaga') }}" placeholder="Contoh: Universitas Wiraraja">
                                </div>
                            </div>
                        </div>

                        {{-- ======================== --}}
                        {{-- FIELD KHUSUS SK --}}
                        {{-- ======================== --}}
                        <div id="section-sk" class="mt-5" style="display:none;">
                            <div class="section-header">
                                <span><i class="bi bi-file-earmark-ruled me-2"></i>Konten Surat Keputusan (SK)</span>
                                <hr>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-12">
                                    <label class="form-label"><i class="bi bi-body-text"></i>Isi SK</label>
                                    <textarea name="isi" class="form-control" rows="10"
                                        placeholder="Tulis isi SK disini... (Menimbang/Mengingat/Memutuskan)">{{ old('isi') }}</textarea>
                                    <div class="hint mt-1">Akan tampil di PDF SK.</div>
                                </div>
                            </div>
                        </div>

                        {{-- ======================== --}}
                        {{-- TTD (opsional) --}}
                        {{-- ======================== --}}
                        <div class="section-header mt-5">
                            <span><i class="bi bi-pen me-2"></i>Pejabat Penandatangan (Opsional)</span>
                            <hr>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-award"></i>Jabatan</label>
                                <input type="text" name="jabatan_ttd" class="form-control"
                                    value="{{ old('jabatan_ttd', 'KEPALA') }}" placeholder="Contoh: KEPALA DINAS">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-person"></i>Nama</label>
                                <input type="text" name="nama_ttd" class="form-control"
                                    value="{{ old('nama_ttd') }}" placeholder="Nama pejabat">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-card-heading"></i>Pangkat/Gol</label>
                                <input type="text" name="pangkat_ttd" class="form-control"
                                    value="{{ old('pangkat_ttd') }}" placeholder="Contoh: Pembina Tingkat I / IV.b">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-credit-card-2-front"></i>NIP</label>
                                <input type="text" name="nip_ttd" class="form-control"
                                    value="{{ old('nip_ttd') }}" placeholder="NIP pejabat">
                            </div>
                        </div>

                        {{-- ======================== --}}
                        {{-- METADATA INSTANSI (punyamu) --}}
                        {{-- ======================== --}}
                        <div class="mt-5">
                            @include('partials.metadata_instansi', [
                                'context' => 'keluar',
                                'atasan' => $atasan,
                            ])
                        </div>

                        {{-- ======================== --}}
                        {{-- SUBMIT --}}
                        {{-- ======================== --}}
                        <div class="mt-5 pt-3 d-flex justify-content-end gap-3 border-top">
                            <button type="reset" class="btn btn-light px-4 text-secondary fw-semibold rounded-pill">
                                Reset
                            </button>
                            <button type="submit" class="btn btn-success btn-save text-white rounded-pill px-5">
                                <i class="bi bi-check-circle-fill me-2"></i> Simpan Surat Keluar
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- JS: tampilkan field berdasarkan jenis surat --}}
    <script>
        (function() {
            const jenisSelect = document.getElementById('jenis_surat');
            const sectionNota = document.getElementById('section-nota-dinas');
            const sectionSK = document.getElementById('section-sk');

            function toggleSections() {
                const v = (jenisSelect.value || '').trim();
                sectionNota.style.display = (v === 'nota_dinas') ? 'block' : 'none';
                sectionSK.style.display = (v === 'surat_keputusan') ? 'block' : 'none';
            }

            jenisSelect.addEventListener('change', toggleSections);
            toggleSections();
        })();
    </script>
</x-app-layout>
