<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Nota Dinas</title>
  <style>
    * { font-family: DejaVu Sans, sans-serif; }
    body { font-size: 11px; color:#111; margin:0; padding:0; }

    table { width:100%; border-collapse:collapse; }

    .kop { border-bottom:3px solid #000; padding-bottom:10px; margin-bottom:10px; }
    .logo { width:70px; vertical-align:top; }
    .logo img { width:65px; height:auto; }
    .instansi { text-align:center; line-height:1.25; }
    .instansi .pemda { font-weight:bold; font-size:12px; text-transform:uppercase; }
    .instansi .nama { font-weight:bold; font-size:12px; text-transform:uppercase; }
    .instansi .alamat { font-size:10px; color:#333; }

    .judul { text-align:center; font-weight:bold; text-transform:uppercase; margin:10px 0 6px; }
    .garis { border-top:1px solid #000; margin: 6px 0 10px; }

    .meta td { padding:2px 0; vertical-align:top; }
    .meta .label { width:85px; }
    .meta .colon { width:12px; text-align:center; }

    .isi { margin-top:10px; line-height:1.55; text-align:justify; }
    .isi p { margin:0 0 8px; }

    .tbl-isi { margin-top:6px; }
    .tbl-isi td { padding:2px 0; vertical-align:top; }
    .tbl-isi .label { width:120px; }
    .tbl-isi .colon { width:12px; text-align:center; }

    .ttd { margin-top:25px; }
    .ttd-right { text-align:center; width:45%; }
    .small { font-size:10px; color:#333; }
  </style>
</head>
<body>

  @php
    /**
     * Cara paling aman untuk DomPDF: embed logo pakai base64.
     * Pastikan $instansi['logo'] adalah path file di server, contoh:
     * public_path('assets/logo.png')
     */
    $logoPath = $instansi['logo'] ?? null;
    $logoBase64 = null;

    if (!empty($logoPath) && file_exists($logoPath)) {
        $ext = pathinfo($logoPath, PATHINFO_EXTENSION);
        $data = file_get_contents($logoPath);
        $logoBase64 = 'data:image/' . $ext . ';base64,' . base64_encode($data);
    }
  @endphp

  <div class="kop">
    <table>
      <tr>
        <td class="logo">
          @if($logoBase64)
            <img src="{{ $logoBase64 }}" alt="Logo">
          @endif
        </td>
        <td class="instansi">
          <div class="pemda">{{ $instansi['pemda'] ?? '-' }}</div>
          <div class="nama">{{ $instansi['nama'] ?? '-' }}</div>
          <div class="alamat">
            {{ $instansi['alamat'] ?? '' }}<br>
            Telp. {{ $instansi['telp'] ?? '' }}<br>
            Email : {{ $instansi['email'] ?? '' }}
          </div>
        </td>
        <td class="logo"></td>
      </tr>
    </table>
  </div>

  <div class="judul">NOTA DINAS</div>
  <div class="garis"></div>

  <table class="meta">
    <tr><td class="label">Yth</td><td class="colon">:</td><td>{{ $surat->yth ?? '-' }}</td></tr>
    <tr><td class="label">Dari</td><td class="colon">:</td><td>{{ $surat->dari ?? '-' }}</td></tr>
    <tr><td class="label">Tembusan</td><td class="colon">:</td><td>{{ $surat->tembusan ?? '-' }}</td></tr>
    <tr>
      <td class="label">Tanggal</td><td class="colon">:</td>
      <td>
        @if(!empty($surat->tanggal_surat))
          {{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}
        @else
          {{ $tanggalCetak ?? '-' }}
        @endif
      </td>
    </tr>
    <tr><td class="label">Nomor</td><td class="colon">:</td><td>{{ $surat->nomor_surat ?? '-' }}</td></tr>
    <tr><td class="label">Sifat</td><td class="colon">:</td><td>{{ $surat->sifat_surat ?? '-' }}</td></tr>
    <tr><td class="label">Lampiran</td><td class="colon">:</td><td>{{ $surat->lampiran ?? '-' }}</td></tr>
    <tr><td class="label">Hal</td><td class="colon">:</td><td>{{ $surat->perihal ?? '-' }}</td></tr>
  </table>

  <div class="garis"></div>

  <div class="isi">
    <p>
      Menindaklanjuti surat
      <b>{{ $surat->rujukan_nomor ?? '...' }}</b>
      perihal
      <b>{{ $surat->rujukan_perihal ?? '...' }}</b>,
      bersama ini memberikan rekomendasi pengambilan data penelitian kepada:
    </p>

    <table class="tbl-isi">
      <tr><td class="label">Nama</td><td class="colon">:</td><td>{{ $surat->nama_peneliti ?? '-' }}</td></tr>
      <tr><td class="label">NPM</td><td class="colon">:</td><td>{{ $surat->npm ?? '-' }}</td></tr>
      <tr><td class="label">Tentang</td><td class="colon">:</td><td>{{ $surat->tentang ?? '-' }}</td></tr>
      <tr><td class="label">Nama Lembaga</td><td class="colon">:</td><td>{{ $surat->nama_lembaga ?? '-' }}</td></tr>
    </table>

    @if(!empty($surat->isi))
      <p style="margin-top:10px;">
        {!! nl2br(e($surat->isi)) !!}
      </p>
    @endif

    <p style="margin-top:8px;">
      Demikian untuk difasilitasi dan atas kerjasamanya disampaikan terimakasih.
    </p>
  </div>

  <table class="ttd">
    <tr>
      <td></td>
      <td class="ttd-right">
        <div>{{ $instansi['kota'] ?? '-' }}, {{ $tanggalCetak ?? '-' }}</div>
        <div style="margin-top:6px; font-weight:bold;">{{ $surat->jabatan_ttd ?? 'KEPALA' }}</div>

        <div class="qr" style="margin:12px 0;">
          @if(!empty($qrSvg))
            <img src="{{ $qrSvg }}" alt="QR">
          @endif
        </div>

        <div class="small">Scan untuk verifikasi</div>

        <div style="font-weight:bold; margin-top:10px;">{{ $surat->nama_ttd ?? '____________________' }}</div>
        <div class="small">
          {{ $surat->pangkat_ttd ?? '' }}
          @if($surat->nip_ttd) <br>NIP. {{ $surat->nip_ttd }} @endif
        </div>
      </td>
    </tr>
  </table>

</body>
</html>
