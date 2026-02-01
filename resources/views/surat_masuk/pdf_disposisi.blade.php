<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Lembar Disposisi</title>
    <style>
        @page { margin: 22px 28px; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #111; }

        .kop { width: 100%; border-bottom: 3px solid #0f5132; padding-bottom: 10px; margin-bottom: 12px; }
        .kop td { vertical-align: middle; }
        .logo { width: 70px; }
        .instansi { text-align: center; }
        .instansi .nama { font-size: 14px; font-weight: bold; text-transform: uppercase; }
        .instansi .alamat { font-size: 10px; color: #333; margin-top: 4px; }

        .judul { text-align: center; margin: 12px 0 10px; }
        .judul .t { font-size: 13px; font-weight: bold; text-transform: uppercase; }
        .judul .n { font-size: 10px; color: #444; margin-top: 4px; }

        .box { border: 1px solid #cfcfcf; border-radius: 8px; padding: 10px 12px; margin-bottom: 12px; }
        .box-title { font-weight: bold; margin-bottom: 8px; color: #0f5132; }

        .tbl-info { width: 100%; border-collapse: collapse; }
        .tbl-info td { padding: 4px 6px; vertical-align: top; }
        .lbl { width: 140px; color: #333; }
        .val { border-bottom: 1px dotted #bbb; }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: bold;
        }
        .b-green { background: #198754; color: #fff; }
        .b-yellow { background: #ffc107; color: #111; }
        .b-gray { background: #6c757d; color: #fff; }
        .b-blue { background: #0d6efd; color: #fff; }

        table.tbl { width: 100%; border-collapse: collapse; margin-top: 8px; }
        .tbl th, .tbl td { border: 1px solid #d8d8d8; padding: 7px 8px; }
        .tbl th { background: #f3f5f7; text-transform: uppercase; font-size: 10px; letter-spacing: 0.5px; }

        .muted { color: #666; font-size: 10px; }
        .right { text-align: right; }
        .center { text-align: center; }

        .ttd-wrap { width: 100%; margin-top: 18px; }
        .ttd-col { width: 50%; vertical-align: top; }
        .ttd-box { padding-top: 10px; }
        .line { margin-top: 48px; border-top: 1px solid #333; width: 80%; }

        .footer { margin-top: 10px; font-size: 9px; color: #666; text-align: center; }
    </style>
</head>
<body>

    {{-- KOP --}}
    <table class="kop">
        <tr>
            <td class="logo">
                @if(!empty($instansi['logo']) && file_exists($instansi['logo']))
                    <img src="{{ $instansi['logo'] }}" style="width:70px; height:auto;">
                @endif
            </td>
            <td class="instansi">
                <div class="nama">{{ $instansi['nama'] ?? 'DINAS KESEHATAN' }}</div>
                <div class="alamat">
                    {{ $instansi['alamat'] ?? '-' }} <br>
                    Telp: {{ $instansi['telp'] ?? '-' }} | Email: {{ $instansi['email'] ?? '-' }}
                </div>
            </td>
            <td class="right" style="width:160px;">
                <div class="muted">Tanggal Cetak</div>
                <div style="font-weight:bold;">{{ $tanggalCetak }}</div>
            </td>
        </tr>
    </table>

    {{-- JUDUL --}}
    <div class="judul">
        <div class="t">Lembar Disposisi Surat Masuk</div>
        <div class="n">Nomor Agenda: <b>{{ $surat->nomor_agenda ?? '-' }}</b></div>
    </div>

    {{-- INFORMASI SURAT --}}
    <div class="box">
        <div class="box-title">Informasi Surat</div>
        <table class="tbl-info">
            <tr>
                <td class="lbl">Nomor Surat</td>
                <td class="val"><b>{{ $surat->nomor_surat }}</b></td>
                <td class="lbl">Tanggal Surat</td>
                <td class="val">{{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td class="lbl">Pengirim</td>
                <td class="val">{{ $surat->pengirim }}</td>
                <td class="lbl">Status Surat</td>
                <td class="val">
                    @php
                        $s = $surat->status;
                        $cls = 'b-green';
                        if($s === 'Diproses') $cls = 'b-yellow';
                        if($s === 'Selesai') $cls = 'b-gray';
                    @endphp
                    <span class="badge {{ $cls }}">{{ $s }}</span>
                </td>
            </tr>
            <tr>
                <td class="lbl">Perihal</td>
                <td class="val" colspan="3">{{ $surat->perihal }}</td>
            </tr>
        </table>

        <div style="margin-top:10px;">
            <span class="muted">Catatan:</span>
            <div style="border:1px dashed #cfcfcf; border-radius:6px; padding:8px; margin-top:6px; min-height:45px;">
                ..............................................................................................................................
                <br>
                ..............................................................................................................................
            </div>
        </div>
    </div>

    {{-- RIWAYAT DISPOSISI --}}
    <div class="box">
        <div class="box-title">Riwayat Disposisi</div>

        <table class="tbl">
            <thead>
                <tr>
                    <th style="width:35px;" class="center">No</th>
                    <th>Tujuan</th>
                    <th>Instruksi</th>
                    <th style="width:80px;" class="center">Prioritas</th>
                    <th style="width:95px;" class="center">Batas Waktu</th>
                    <th style="width:90px;" class="center">Status</th>
                    <th style="width:120px;" class="center">Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($surat->disposisis as $i => $d)
                    <tr>
                        <td class="center">{{ $i+1 }}</td>
                        <td><b>{{ $d->tujuan }}</b></td>
                        <td>{{ $d->instruksi ?? '-' }}</td>
                        <td class="center">
                            @php
                                $p = $d->prioritas ?? '-';
                                $pc = 'b-blue';
                                if($p === 'Rendah') $pc = 'b-green';
                                if($p === 'Sedang') $pc = 'b-yellow';
                                if($p === 'Tinggi') $pc = 'b-gray';
                            @endphp
                            <span class="badge {{ $pc }}">{{ $p }}</span>
                        </td>
                        <td class="center">
                            {{ $d->batas_waktu ? \Carbon\Carbon::parse($d->batas_waktu)->translatedFormat('d M Y') : '-' }}
                        </td>
                        <td class="center">
                            @php
                                $st = $d->status ?? 'Menunggu';
                                $sc = 'b-yellow';
                                if($st === 'Diproses') $sc = 'b-blue';
                                if($st === 'Selesai') $sc = 'b-green';
                            @endphp
                            <span class="badge {{ $sc }}">{{ $st }}</span>
                        </td>
                        <td class="center">
                            {{ $d->created_at ? $d->created_at->translatedFormat('d M Y H:i') : '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="center muted">Belum ada disposisi untuk surat ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="muted" style="margin-top:8px;">
            * Dokumen ini dicetak dari Sistem Monitoring Administrasi Surat.
        </div>
    </div>

    {{-- TANDA TANGAN --}}
    <table class="ttd-wrap">
        <tr>
            <td class="ttd-col">
                <div class="ttd-box">
                    <div>{{ $ttd['jabatan2'] ?? 'Petugas / TU' }}</div>
                    <div class="line"></div>
                    <div style="font-weight:bold;">{{ $ttd['nama2'] ?? '________________________' }}</div>
                    <div class="muted">{{ $ttd['nip2'] ?? 'NIP. ____________________' }}</div>
                </div>
            </td>
            <td class="ttd-col">
                <div class="ttd-box">
                    <div class="right">{{ $ttd['jabatan1'] ?? 'Kepala Dinas' }}</div>
                    <div class="line" style="margin-left:auto;"></div>
                    <div class="right" style="font-weight:bold;">{{ $ttd['nama1'] ?? '________________________' }}</div>
                    <div class="right muted">{{ $ttd['nip1'] ?? 'NIP. ____________________' }}</div>
                </div>
            </td>
        </tr>
    </table>

    <div class="footer">
        © {{ date('Y') }} Dinkes Kabupaten Sumenep — Lembar Disposisi
    </div>

</body>
</html>
