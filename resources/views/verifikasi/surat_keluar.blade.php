<x-app-layout>
    <style>
        .verify-card { border: 1px solid rgba(0,0,0,0.08); border-radius: 18px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); overflow:hidden; }
        .verify-head { background: linear-gradient(135deg, #0f5132 0%, #198754 100%); color:#fff; padding:18px 22px; }
        .verify-body { padding: 22px; }
        .verify-badge { padding: 6px 12px; border-radius: 10px; font-weight: 700; font-size: 0.75rem; }
        .kv { display:flex; gap:12px; margin-bottom:10px; }
        .kv .k { width:180px; color:#666; font-size:0.9rem; }
        .kv .v { flex:1; font-weight:600; color:#222; }
    </style>

    <div class="mb-4">
        <h4 class="fw-bold text-success mb-1">Verifikasi Dokumen</h4>
        <p class="text-muted small mb-0">Halaman ini digunakan untuk memverifikasi keaslian dokumen melalui QR Code.</p>
    </div>

    <div class="card verify-card">
        <div class="verify-head d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <div class="fw-bold">SURAT KELUAR</div>
                <div class="small opacity-75">Nomor Agenda: {{ $data->nomor_agenda ?? '-' }}</div>
            </div>
            @php
                $badge = ($data->status === 'Terkirim') ? 'bg-success' : 'bg-warning text-dark';
            @endphp
            <span class="verify-badge {{ $badge }}">{{ $data->status }}</span>
        </div>

        <div class="verify-body">
            <div class="row g-4">
                <div class="col-lg-7">
                    <h6 class="fw-bold mb-3">Informasi Surat</h6>

                    <div class="kv"><div class="k">Nomor Surat</div><div class="v">{{ $data->nomor_surat }}</div></div>
                    <div class="kv"><div class="k">Tanggal Surat</div><div class="v">{{ \Carbon\Carbon::parse($data->tanggal_surat)->translatedFormat('d F Y') }}</div></div>
                    <div class="kv"><div class="k">Tujuan</div><div class="v">{{ $data->tujuan }}</div></div>
                    <div class="kv"><div class="k">Perihal</div><div class="v">{{ $data->perihal }}</div></div>

                    <hr class="my-3">

                    <h6 class="fw-bold mb-3">Metadata Instansi</h6>
                    <div class="kv"><div class="k">Sifat</div><div class="v">{{ $data->sifat_surat ?? '-' }}</div></div>
                    <div class="kv"><div class="k">Jenis</div><div class="v">{{ $data->jenis_surat ?? '-' }}</div></div>
                    <div class="kv"><div class="k">Klasifikasi</div><div class="v">{{ $data->klasifikasi ?? '-' }}</div></div>
                    <div class="kv"><div class="k">Unit Pengolah</div><div class="v">{{ $data->unit_pengolah ?? '-' }}</div></div>
                </div>

                <div class="col-lg-5">
                    <div class="p-3 border rounded-4 bg-light">
                        <h6 class="fw-bold mb-2">Status Verifikasi</h6>
                        <div class="text-success fw-semibold">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Dokumen ditemukan di sistem
                        </div>
                        <div class="small text-muted mt-2">
                            Jika data sesuai dengan dokumen fisik/PDF, maka dokumen valid.
                        </div>
                    </div>

                    <div class="mt-3">
                        @if($data->file_surat)
                            <a href="{{ asset('storage/'.$data->file_surat) }}" target="_blank" class="btn btn-danger w-100 rounded-4">
                                <i class="bi bi-file-earmark-pdf me-1"></i> Lihat File Surat
                            </a>
                        @else
                            <div class="text-muted small">Tidak ada file terunggah.</div>
                        @endif
                    </div>

                    <div class="mt-3 small text-muted">
                        ID Sistem: #SK-{{ str_pad($data->id, 4, '0', STR_PAD_LEFT) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
