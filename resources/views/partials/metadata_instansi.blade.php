@php
    // context: 'surat_masuk' atau 'surat_keluar'
    $context = $context ?? 'surat_masuk';

    // daftar pegawai (wajib dikirim dari controller)
    $pegawai = $pegawai ?? collect();

    // mode edit: optional ada $data
    $data = $data ?? null;

    // untuk edit surat masuk: kadang kamu kirim $tujuanUserId dari controller
    $tujuanUserId = $tujuanUserId ?? null;

    // ambil tujuan dari relasi recipients kalau ada dan kalau $data tidak null
    $recipientUserId = null;
    if ($data && isset($data->recipients) && $data->recipients && $data->recipients->count() > 0) {
        $recipientUserId = $data->recipients->first()->user_id;
    }

    // nilai tujuan pegawai terpilih (old() menang)
    $selectedTujuanUserId = old(
        'tujuan_user_id',
        $tujuanUserId ?? $recipientUserId ?? ($data->tujuan_user_id ?? null)
    );

    // field metadata lain
    $sifat   = old('sifat_surat', $data->sifat_surat ?? '');
    $kategori = old('kategori_surat', $data->kategori_surat ?? '');
    $unit    = old('unit_pengolah', $data->unit_pengolah ?? '');

    // tujuan klasifikasi teks (opsional, beda dengan tujuan pegawai)
    $klasifikasiText = old('klasifikasi', $data->klasifikasi ?? '');
@endphp

<style>
    .meta-title { font-weight:700; color:#198754; margin-bottom:12px; display:flex; align-items:center; gap:8px; }
    .meta-help { font-size:0.78rem; color:#6c757d; margin-top:6px; }
</style>

<div class="mt-5">
    <div class="meta-title">
        <i class="bi bi-journal-text"></i> Metadata Instansi
    </div>

    <div class="row g-3">
        {{-- SIFAT --}}
        <div class="col-md-3">
            <label class="form-label small text-muted mb-1">Sifat Surat</label>
            <select name="sifat_surat" class="form-select rounded-3">
                <option value="">- Pilih -</option>
                <option value="Biasa"   {{ $sifat === 'Biasa' ? 'selected' : '' }}>Biasa</option>
                <option value="Penting" {{ $sifat === 'Penting' ? 'selected' : '' }}>Penting</option>
                <option value="Rahasia" {{ $sifat === 'Rahasia' ? 'selected' : '' }}>Rahasia</option>
            </select>
        </div>

        {{-- KATEGORI --}}
        <div class="col-md-3">
            <label class="form-label small text-muted mb-1">Jenis Surat (Kategori)</label>
            <input type="text" name="kategori_surat" class="form-control rounded-3"
                   value="{{ $kategori }}" placeholder="Contoh: Undangan / Permohonan">
            <div class="meta-help">Ini kategori manual, beda dengan template cetak.</div>
        </div>

        {{-- TUJUAN PEGAWAI --}}
        <div class="col-md-3">
            <label class="form-label small text-muted mb-1">
                {{ $context === 'surat_masuk' ? 'Tujuan Pegawai (Wajib)' : 'Tujuan Pegawai (Metadata)' }}
            </label>

            <select name="tujuan_user_id" class="form-select rounded-3" {{ $context === 'surat_masuk' ? 'required' : '' }}>
                <option value="">- Pilih Pegawai -</option>

                @foreach($pegawai as $p)
                    @php
                        $label = trim(($p->jabatan ?? '').' - '.($p->name ?? ''));
                        $extra = trim(($p->instansi ?? ''));
                        $full = $extra ? $label.' - '.$extra : $label;
                    @endphp
                    <option value="{{ $p->id }}" {{ (string)$selectedTujuanUserId === (string)$p->id ? 'selected' : '' }}>
                        {{ $full }}
                    </option>
                @endforeach
            </select>

            <div class="meta-help">
                {{ $context === 'surat_masuk'
                    ? 'Wajib dipilih (dipakai untuk inbox pegawai + status dibaca).'
                    : 'Opsional (hanya metadata internal).'
                }}
            </div>

            {{-- kalau list kosong, kasih warning --}}
            @if($pegawai->count() === 0)
                <div class="meta-help text-danger">
                    *Data pegawai kosong / tidak terkirim ke view. Pastikan controller create/edit mengirim $pegawai.
                </div>
            @endif
