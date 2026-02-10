<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Keputusan</title>
  <style>
    * { font-family: DejaVu Sans, sans-serif; }
    body { font-size: 11px; color:#111; }
    .kop { border-bottom:3px solid #000; padding-bottom:10px; margin-bottom:10px; }
    table { width:100%; border-collapse:collapse; }
    .logo img { width:65px; }
    .instansi { text-align:center; line-height:1.25; }
    .instansi .pemda { font-weight:bold; font-size:12px; text-transform:uppercase; }
    .instansi .nama { font-weight:bold; font-size:12px; text-transform:uppercase; }
    .judul { text-align:center; font-weight:bold; text-transform:uppercase; margin:16px 0 6px; }
    .nomor { text-align:center; margin-bottom:14px; }
    .isi { line-height:1.6; text-align:justify; }
    .ttd { margin-top:30px; width:100%; }
    .right { text-align:center; }
    .small { font-size:10px; color:#333; }
  </style>
</head>
<body>

  <div class="kop">
    <table>
      <tr>
        <td class="logo" style="width:70px;">
          @if (!empty($instansi['logo']) && file_exists($instansi['logo']))
            <img src="{{ $instansi['logo'] }}" alt="Logo">
          @endif
        </td>
        <td class="instansi">
          <div class="pemda">{{ $instansi['pemda'] ?? '-' }}</div>
          <div class="nama">{{ $instansi['nama'] ?? '-' }}</div>
          <div class="small">{{ $instansi['alamat'] ?? '' }}</div>
        </td>
        <td style="width:70px;"></td>
      </tr>
    </table>
  </div>

  <div class="judul">SURAT KEPUTUSAN</div>
  <div class="nomor"><b>NOMOR: {{ $surat->nomor_surat ?? '-' }}</b></div>

  <div class="isi">
    <p style="text-align:center; font-weight:bold; margin-bottom:10px;">
      TENTANG
    </p>
    <p style="text-align:center; margin-top:-6px;">
      {{ $surat->perihal ?? '-' }}
    </p>

    <p>
      {!! nl2br(e($surat->isi ?? 'Isi SK belum diisi. (Tambahkan konsideran Menimbang/Mengingat/Memutuskan jika dibutuhkan)')) !!}
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
