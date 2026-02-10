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
        .form-select,
        textarea.form-control {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            transition: all 0.3s;
            background: #fff;
        }

        .form-control:focus,
        .form-select:focus,
        textarea.form-control:focus {
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

    @php
        $templateLabels = [
            'lembar_kendali' => 'Lembar Kendali',
            'nota_dinas' => 'Nota Dinas',
            'surat_keputusan' => 'Surat Keputusan (SK)',
        ];
        $currentJenis = old('jenis_surat', $data->jenis_surat ?? 'lembar_kendali');
    @endphp

    <div class="container-fluid py-4 px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="page-title mb-0">Edit Surat Keluar</h4>
                <p class="text-muted small">
                    ID Surat:
                    <span class="badge bg-light text-dark border">
                        #SK-{{ str_pad($data->id, 4, '0', STR_PAD_LEFT) }}
                    </span>
                </p>
            </div>
            <a href="{{ route('surat-keluar.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                <i class="bi bi-arrow-left me-1"></i> Batal & Kembali
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

                <form action="{{ route('surat-keluar.update', $data->id) }}" method="POST" enctype="multipart/form-data">
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
                            <label class="form-label"><i class="bi bi-calendar-check"></i>Tanggal Surat</label>
                            <input type="date" name="tanggal_surat" class="form-control"
                                   value="{{ old('tanggal_surat', optional($data->tanggal_surat)->format('Y-m-d')) }}" required>
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
                        <span>Template Surat (Cetak)</span>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-layers"></i>Jenis Surat (Template)</label>
                            <select id="jenis_surat" name="jenis_surat" class="form-select" required>
                                <option value="lembar_kendali" {{ $currentJenis=='lembar_kendali' ? 'selected' : '' }}>
                                    Lembar Kendali
                                </option>
                                <option value="nota_dinas" {{ $currentJenis=='nota_dinas' ? 'selected' : '' }}>
                                    Nota Dinas
                                </option>
                                <option value="surat_keputusan" {{ $currentJenis=='surat_keputusan' ? 'selected' : '' }}>
                                    Surat Keputusan (SK)
                                </option>
                            </select>
                            <div class="hint mt-1">Template PDF akan mengikuti pilihan ini.</div>
                        </div>

                        <div class="col-md-6">
                            <div class="soft-box">
                                <div class="fw-bold mb-1">
                                    <i class="bi bi-printer me-2"></i>Info
                                </div>
                                <div class="small text-muted">
                                    Setelah update, kamu bisa cetak PDF di halaman detail:
                                    <b>{{ $templateLabels[$currentJenis] ?? 'Template' }}</b>.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section-divider">
                        <span>Berkas & Status Pengiriman</span>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-7">
                            <label class="form-label"><i class="bi bi-file-earmark-arrow-up"></i>Perbarui Berkas (PDF)</label>
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
                                <option value="Draft" {{ old('status', $data->status) == 'Draft' ? 'selected' : '' }}>
                                    Draft (Arsip Internal)
                                </option>
                                <option value="Dikirim" {{ old('status', $data->status) == 'Dikirim' ? 'selected' : '' }}>
                                    Dikirim (Menunggu Respon)
                                </option>
                                <option value="Selesai" {{ old('status', $data->status) == 'Selesai' ? 'selected' : '' }}>
                                    Selesai (Terkonfirmasi)
                                </option>
                            </select>
                        </div>
                    </div>

                    {{-- ======================== --}}
                    {{-- NOTA DINAS FIELDS --}}
                    {{-- ======================== --}}
                    <div id="section-nota-dinas" style="display:none;">
                        <div class="section-divider">
                            <span>Konten Nota Dinas</span>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-person-badge"></i>Yth</label>
                                <input type="text" name="yth" class="form-control"
                                       value="{{ old('yth', $data->yth) }}"
                                       placeholder="Contoh: Sdr. Kepala Puskesmas Pragaan">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-building"></i>Dari</label>
                                <input type="text" name="dari" class="form-control"
                                       value="{{ old('dari', $data->dari) }}"
                                       placeholder="Contoh: Kepala Dinas Kesehatan Kab. Sumenep">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label"><i class="bi bi-people"></i>Tembusan</label>
                                <textarea name="tembusan" class="form-control" rows="2"
                                          placeholder="Pisahkan dengan enter jika lebih dari 1">{{ old('tembusan', $data->tembusan) }}</textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-paperclip"></i>Lampiran</label>
                                <input type="text" name="lampiran" class="form-control"
                                       value="{{ old('lampiran', $data->lampiran) }}"
                                       placeholder="Contoh: 1 (satu) berkas / -">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label"><i class="bi bi-body-text"></i>Isi Nota Dinas (Opsional)</label>
                                <textarea name="isi" class="form-control" rows="4"
                                          placeholder="(Opsional) tambahan isi nota dinas...">{{ old('isi', $data->isi) }}</textarea>
                                <div class="hint mt-1">Bagian isi tambahan (boleh dikosongkan).</div>
                            </div>
                        </div>

                        <div class="section-divider">
                            <span>Data Penelitian (Pengganti titik-titik)</span>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-link-45deg"></i>Nomor Surat Rujukan</label>
                                <input type="text" name="rujukan_nomor" class="form-control"
                                       value="{{ old('rujukan_nomor', $data->rujukan_nomor ?? '') }}"
                                       placeholder="Contoh: 058/D-WD.I-FIK/PP-01/UNJA/II/2026">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-tag"></i>Perihal Rujukan</label>
                                <input type="text" name="rujukan_perihal" class="form-control"
                                       value="{{ old('rujukan_perihal', $data->rujukan_perihal ?? '') }}"
                                       placeholder="Contoh: Permohonan Izin Observasi">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-person"></i>Nama</label>
                                <input type="text" name="nama_peneliti" class="form-control"
                                       value="{{ old('nama_peneliti', $data->nama_peneliti ?? '') }}"
                                       placeholder="Contoh: Fidia Azizah">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-123"></i>NPM</label>
                                <input type="text" name="npm" class="form-control"
                                       value="{{ old('npm', $data->npm ?? '') }}"
                                       placeholder="Contoh: 722621778">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label"><i class="bi bi-journal-text"></i>Tentang</label>
                                <input type="text" name="tentang" class="form-control"
                                       value="{{ old('tentang', $data->tentang ?? '') }}"
                                       placeholder="Contoh: Pengelolaan Poliuri pada Lansia ...">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label"><i class="bi bi-building"></i>Nama Lembaga</label>
                                <input type="text" name="nama_lembaga" class="form-control"
                                       value="{{ old('nama_lembaga', $data->nama_lembaga ?? '') }}"
                                       placeholder="Contoh: Universitas Wiraraja">
                            </div>
                        </div>
                    </div>

                    {{-- ======================== --}}
                    {{-- SK FIELDS --}}
                    {{-- ======================== --}}
                    <div id="section-sk" style="display:none;">
                        <div class="section-divider">
                            <span>Konten Surat Keputusan (SK)</span>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-12">
                                <label class="form-label"><i class="bi bi-body-text"></i>Isi SK</label>
                                <textarea name="isi" class="form-control" rows="8"
                                          placeholder="Tulis isi SK disini... (Menimbang/Mengingat/Memutuskan)">{{ old('isi', $data->isi) }}</textarea>
                                <div class="hint mt-1">Untuk SK, tulis format Menimbang/Mengingat/Memutuskan di kolom ini.</div>
                            </div>
                        </div>
                    </div>

                    {{-- ======================== --}}
                    {{-- TTD (opsional) --}}
                    {{-- ======================== --}}
                    <div class="section-divider">
                        <span>Pejabat Penandatangan (Opsional)</span>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-award"></i>Jabatan</label>
                            <input type="text" name="jabatan_ttd" class="form-control"
                                   value="{{ old('jabatan_ttd', $data->jabatan_ttd) }}"
                                   placeholder="Contoh: KEPALA DINAS">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-person"></i>Nama</label>
                            <input type="text" name="nama_ttd" class="form-control"
                                   value="{{ old('nama_ttd', $data->nama_ttd) }}"
                                   placeholder="Nama pejabat">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-card-heading"></i>Pangkat/Gol</label>
                            <input type="text" name="pangkat_ttd" class="form-control"
                                   value="{{ old('pangkat_ttd', $data->pangkat_ttd) }}"
                                   placeholder="Contoh: Pembina Tingkat I / IV.b">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-credit-card-2-front"></i>NIP</label>
                            <input type="text" name="nip_ttd" class="form-control"
                                   value="{{ old('nip_ttd', $data->nip_ttd) }}"
                                   placeholder="NIP pejabat">
                        </div>
                    </div>

                    {{-- ======================== --}}
                    {{-- METADATA INSTANSI --}}
                    {{-- ======================== --}}
                    @include('partials.metadata_instansi')

                    <div class="mt-5 d-flex justify-content-end gap-3 border-top pt-4">
                        <button type="submit" class="btn btn-success btn-update text-white">
                            <i class="bi bi-save2 me-2"></i> Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- JS: toggle field berdasarkan jenis surat --}}
    <script>
        (function () {
            const jenisSelect = document.getElementById('jenis_surat');
            const sectionNota = document.getElementById('section-nota-dinas');
            const sectionSK   = document.getElementById('section-sk');

            function toggleSections() {
                const v = (jenisSelect.value || '').trim();
                sectionNota.style.display = (v === 'nota_dinas') ? 'block' : 'none';
                sectionSK.style.display   = (v === 'surat_keputusan') ? 'block' : 'none';
            }

            jenisSelect.addEventListener('change', toggleSections);
            toggleSections();
        })();
    </script>
</x-app-layout>
