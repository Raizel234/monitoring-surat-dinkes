<hr class="my-4">

<h6 class="fw-bold mb-3 text-success">
    <i class="bi bi-building-gear me-2"></i> Metadata Instansi
</h6>

@php
    // ✅ aman kalau $pegawai tidak dikirim dari controller
    $pegawai = $pegawai ?? collect();
@endphp

<div class="row g-3">
    <div class="col-md-3">
        <label class="form-label fw-semibold">Sifat Surat</label>
        <select name="sifat_surat" class="form-select rounded-3">
            <option value="">- Pilih -</option>
            <option value="Biasa" {{ old('sifat_surat', $data->sifat_surat ?? '')=='Biasa' ? 'selected':'' }}>
                Biasa
            </option>
            <option value="Penting" {{ old('sifat_surat', $data->sifat_surat ?? '')=='Penting' ? 'selected':'' }}>
                Penting
            </option>
            <option value="Rahasia" {{ old('sifat_surat', $data->sifat_surat ?? '')=='Rahasia' ? 'selected':'' }}>
                Rahasia
            </option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Jenis Surat (Kategori)</label>
        <input
            type="text"
            name="kategori_surat"
            value="{{ old('kategori_surat', $data->kategori_surat ?? '') }}"
            class="form-control rounded-3"
            placeholder="Contoh: Undangan / Permohonan"
        >
        <div class="text-muted small mt-1">Ini kategori manual, beda dengan template cetak.</div>
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Tujuan (Klasifikasi)</label>

        {{-- ✅ Input tetap "klasifikasi" biar masuk ke DB surat --}}
        <input
            type="text"
            name="klasifikasi"
            list="list-pegawai-klasifikasi"
            value="{{ old('klasifikasi', $data->klasifikasi ?? '') }}"
            class="form-control rounded-3"
            placeholder="Ketik manual atau pilih dari daftar pegawai..."
            autocomplete="off"
        >

        {{-- ✅ Dropdown otomatis dari pegawai --}}
        <datalist id="list-pegawai-klasifikasi">
            @foreach ($pegawai as $p)
                @php
                    // Format yang tampil di dropdown (bebas kamu ubah)
                    // Misal: "Kepala Dinas - drg. Ellya - Dinkes Sumenep"
                    $jabatan = trim($p->jabatan ?? '');
                    $nama = trim($p->name ?? '');
                    $instansi = trim($p->instansi ?? '');

                    $label = $jabatan ?: $nama;
                    if ($nama && $jabatan) $label = $jabatan . ' - ' . $nama;
                    if ($instansi) $label .= ' - ' . $instansi;
                @endphp

                <option value="{{ $label }}"></option>
            @endforeach
        </datalist>

        <div class="text-muted small mt-1">
            Pilih dari daftar pegawai (dibuat admin) atau isi manual.
        </div>
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Unit Pengolah</label>
        <input
            type="text"
            name="unit_pengolah"
            value="{{ old('unit_pengolah', $data->unit_pengolah ?? '') }}"
            class="form-control rounded-3"
            placeholder="Contoh: Sekretariat / P2P"
        >
    </div>
</div>

<p class="text-muted small mt-2 mb-0">
    Nomor Agenda dibuat otomatis saat surat disimpan.
</p>
