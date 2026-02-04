<hr class="my-4">

<h6 class="fw-bold mb-3 text-success">
    <i class="bi bi-building-gear me-2"></i> Metadata Instansi
</h6>

<div class="row g-3">
    <div class="col-md-3">
        <label class="form-label fw-semibold">Sifat Surat</label>
        <select name="sifat_surat" class="form-select rounded-3">
            <option value="">- Pilih -</option>
            <option value="Biasa"
                {{ old('sifat_surat', $data->sifat_surat ?? '')=='Biasa' ? 'selected':'' }}>
                Biasa
            </option>
            <option value="Penting"
                {{ old('sifat_surat', $data->sifat_surat ?? '')=='Penting' ? 'selected':'' }}>
                Penting
            </option>
            <option value="Rahasia"
                {{ old('sifat_surat', $data->sifat_surat ?? '')=='Rahasia' ? 'selected':'' }}>
                Rahasia
            </option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Jenis Surat</label>
        <input type="text" name="jenis_surat"
               value="{{ old('jenis_surat', $data->jenis_surat ?? '') }}"
               class="form-control rounded-3"
               placeholder="Contoh: Undangan / Permohonan">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Tujuan</label>
        <input type="text" name="klasifikasi"
               value="{{ old('klasifikasi', $data->klasifikasi ?? '') }}"
               class="form-control rounded-3"
               placeholder="Contoh: TU / Kepala Dinas">
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">Unit Pengolah</label>
        <input type="text" name="unit_pengolah"
               value="{{ old('unit_pengolah', $data->unit_pengolah ?? '') }}"
               class="form-control rounded-3"
               placeholder="Contoh: Sekretariat / P2P">
    </div>
</div>

<p class="text-muted small mt-2 mb-0">
    Nomor Agenda dibuat otomatis saat surat disimpan.
</p>
