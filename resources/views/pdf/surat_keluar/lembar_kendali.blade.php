<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Lembar Kendali Surat Keluar</title>
  <style>
    * { font-family: DejaVu Sans, sans-serif; }
    body { font-size: 11px; color: #111; }
    .header { width:100%; border-bottom:3px solid #000; padding-bottom:10px; margin-bottom:12px; }
    table { width:100%; border-collapse:collapse; }
    .logo { width:65px; }
    .instansi { text-align:center; line-height:1.2; }
    .instansi .nama { font-size:14px; font-weight:bold; text-transform:uppercase; }
    .instansi .alamat { font-size:10px; color:#333; }
    .title { text-align:center; margin:10px 0 6px; font-weight:bold; text-transform:uppercase; font-size:12px; letter-spacing:.4px; }
    .meta { margin:8px 0 10px; font-size:10px; }
    .box { border:1px solid #000; padding:10px; border-radius:4px; margin-top:10px; }
    table.info td { padding:4px 6px; vertical-align:top; }
    .label { width:140px; }
    .colon { width:8px; }
    .footer { margin-top:18px; width:100%; }
    .ttd td { width:50%; vertical-align:top; }
    .right { text-align:center; }
    .space { height:65px; }
    .small { font-size:10px; color:#333; }
  </style>
</head>
<body>

  <div class="header">
    <table>
      <tr>
        <td style="width:80px;">
          @if (!empty($instansi['logo']) && file_exists($instansi['logo']))
            <img src="{{ $instansi['logo'] }}" class="logo">
          @endif
        </td>
        <td class="instansi">
          <div class="nama">{{ $instansi['nama'] ?? '-' }}</div>
          <div class="alamat">
            {{ $instansi['alamat'] ?? '' }}<br>
            Telp: {{ $instansi['telp'] ?? '' }} | Email: {{ $instansi['email'] ?? '' }}
          </div>
        </td>
        <td style="width:80px;"></td>
      </tr>
    </table>
  </div>

  <div class="title">Lembar Kendali Surat Keluar</div>

  <div class="meta">
    <div><b>Tanggal Cetak</b>: {{ $tanggalCetak ?? '-' }}</div>
  </div>

  <div class="box">
    <table class="info">
      <tr>
        <td class="label"><b>No. Agenda</b></td><td class="colon">:</td>
        <td>{{ $surat->nomor_agenda ?? '-' }}</td>
        <td class="label"><b>Status</b></td><td class="colon">:</td>
        <td>{{ $surat->status ?? '-' }}</td>
      </tr>
      <tr>
        <td class="label"><b>No. Surat</b></td><td class="colon">:</td>
        <td>{{ $surat->nomor_surat ?? '-' }}</td>
        <td class="label"><b>Tanggal Surat</b></td><td class="colon">:</td>
        <td>{{ optional($surat->tanggal_surat)->format('d/m/Y') ?? '-' }}</td>
      </tr>
      <tr>
        <td class="label"><b>Tujuan</b></td><td class="colon">:</td>
        <td colspan="4">{{ $surat->tujuan ?? '-' }}</td>
      </tr>
      <tr>
        <td class="label"><b>Perihal</b></td><td class="colon">:</td>
        <td colspan="4">{{ $surat->perihal ?? '-' }}</td>
      </tr>
      <tr>
        <td class="label"><b>Lampiran</b></td><td class="colon">:</td>
        <td colspan="4">{{ $surat->lampiran ?? '________________________' }}</td>
      </tr>
      <tr>
        <td class="label"><b>Sifat Surat</b></td><td class="colon">:</td>
        <td>{{ $surat->sifat_surat ?? '-' }}</td>
        <td class="label"><b>Dari</b></td><td class="colon">:</td>
        <td>{{ $surat->klasifikasi ?? '-' }}</td>
      </tr>
      <tr>
        <td class="label"><b>Jenis Surat</b></td><td class="colon">:</td>
        <td>{{ $surat->jenis_surat ?? '-' }}</td>
        <td class="label"><b>Unit Pengolah</b></td><td class="colon">:</td>
        <td>{{ $surat->unit_pengolah ?? '-' }}</td>
      </tr>
      <tr>
        <td class="label"><b>Tgl Keluar</b></td><td class="colon">:</td>
        <td>{{ optional($surat->tanggal_keluar)->format('d/m/Y') ?? '________________' }}</td>
        <td class="label"><b>Jam</b></td><td class="colon">:</td>
        <td>____________</td>
      </tr>
    </table>
  </div>

  <div class="footer">
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
  </div>

</body>
</html>
