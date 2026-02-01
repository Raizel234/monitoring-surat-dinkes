<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Lembar Kendali Surat Keluar</title>
    <style>
        * {
            font-family: DejaVu Sans, sans-serif;
        }

        body {
            font-size: 11px;
            color: #111;
        }

        .header {
            width: 100%;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 12px;
        }

        .header-table {
            width: 100%;
        }

        .header-table td {
            vertical-align: middle;
        }

        .logo {
            width: 65px;
        }

        .instansi {
            text-align: center;
            line-height: 1.2;
        }

        .instansi .nama {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .instansi .alamat {
            font-size: 10px;
            color: #333;
        }

        .title {
            text-align: center;
            margin: 10px 0 6px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.4px;
        }

        .meta {
            margin: 8px 0 10px;
            font-size: 10px;
        }

        .meta b {
            display: inline-block;
            width: 115px;
        }

        .box {
            border: 1px solid #000;
            padding: 10px;
            border-radius: 4px;
            margin-top: 10px;
        }

        table.info {
            width: 100%;
            border-collapse: collapse;
        }

        table.info td {
            padding: 4px 6px;
            vertical-align: top;
        }

        .label {
            width: 140px;
        }

        .colon {
            width: 8px;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.data th,
        table.data td {
            border: 1px solid #000;
            padding: 6px 6px;
        }

        table.data th {
            background: #f2f2f2;
            text-align: center;
            font-weight: bold;
            font-size: 10px;
        }

        .footer {
            margin-top: 18px;
            width: 100%;
        }

        .ttd {
            width: 100%;
        }

        .ttd td {
            width: 50%;
            vertical-align: top;
        }

        .ttd .right {
            text-align: center;
        }

        .space {
            height: 65px;
        }

        .small {
            font-size: 10px;
            color: #333;
        }
    </style>
</head>

<body>

    {{-- HEADER INSTANSI --}}
    <div class="header">
        <table class="header-table">
            <tr>
                <td style="width: 80px;">
                    @if (!empty($instansi['logo']) && file_exists($instansi['logo']))
                        <img src="{{ $instansi['logo'] }}" class="logo">
                    @endif
                </td>
                <td class="instansi">
                    <div class="nama">{{ $instansi['nama'] ?? '-' }}</div>
                    <div class="alamat">
                        {{ $instansi['alamat'] ?? '' }} <br>
                        Telp: {{ $instansi['telp'] ?? '' }} | Email: {{ $instansi['email'] ?? '' }}
                    </div>
                </td>
                <td style="width: 80px;"></td>
            </tr>
        </table>
    </div>

    <div class="title">Lembar Kendali Surat Keluar</div>

    <div class="meta">
        <div><b>Tanggal Cetak</b>: {{ $tanggalCetak ?? '-' }}</div>
    </div>

    {{-- INFORMASI SURAT --}}
    <div class="box">
        <table class="info">
            <tr>
                <td class="label"><b>No. Agenda</b></td>
                <td class="colon">:</td>
                <td>{{ $surat->nomor_agenda ?? '-' }}</td>

                <td class="label"><b>Status</b></td>
                <td class="colon">:</td>
                <td>{{ $surat->status ?? '-' }}</td>
            </tr>

            <tr>
                <td class="label"><b>No. Surat</b></td>
                <td class="colon">:</td>
                <td>{{ $surat->nomor_surat ?? '-' }}</td>

                <td class="label"><b>Tanggal Surat</b></td>
                <td class="colon">:</td>
                <td>
                    @if ($surat->tanggal_surat)
                        {{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d/m/Y') }}
                    @else
                        -
                    @endif
                </td>
            </tr>

            <tr>
                <td class="label"><b>Tujuan</b></td>
                <td class="colon">:</td>
                <td colspan="4">{{ $surat->tujuan ?? '-' }}</td>
            </tr>

            <tr>
                <td class="label"><b>Perihal</b></td>
                <td class="colon">:</td>
                <td colspan="4">{{ $surat->perihal ?? '-' }}</td>
            </tr>

            <tr>
                <td class="label"><b>Lampiran</b></td>
                <td class="colon">:</td>
                <td colspan="4">________________________</td>
            </tr>

            <tr>
                <td class="label"><b>Sifat Surat</b></td>
                <td class="colon">:</td>
                <td>{{ $surat->sifat_surat ?? '-' }}</td>

                <td class="label"><b>Klasifikasi</b></td>
                <td class="colon">:</td>
                <td>{{ $surat->klasifikasi ?? '-' }}</td>
            </tr>

            <tr>
                <td class="label"><b>Jenis Surat</b></td>
                <td class="colon">:</td>
                <td>{{ $surat->jenis_surat ?? '-' }}</td>

                <td class="label"><b>Unit Pengolah</b></td>
                <td class="colon">:</td>
                <td>{{ $surat->unit_pengolah ?? '-' }}</td>
            </tr>


            <tr>
                <td class="label"><b>Tgl Keluar</b></td>
                <td class="colon">:</td>
                <td>________________</td>

                <td class="label"><b>Jam</b></td>
                <td class="colon">:</td>
                <td>____________</td>
            </tr>
        </table>
    </div>

    {{-- RIWAYAT PENGIRIMAN / CATATAN --}}
    <div class="box">
        <b>Riwayat Pengiriman (Manual)</b>
        <table class="data">
            <thead>
                <tr>
                    <th style="width:30px;">No</th>
                    <th style="width:120px;">Media</th>
                    <th>Tanggal</th>
                    <th>Petugas</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                {{-- karena belum ada tabel riwayat pengiriman, dibuat template manual --}}
                <tr>
                    <td style="text-align:center;">1</td>
                    <td style="text-align:center;">□ Kurir □ Email □ Ekspedisi</td>
                    <td style="text-align:center;">__/__/____</td>
                    <td style="text-align:center;">____________</td>
                    <td>____________________________</td>
                </tr>
                <tr>
                    <td style="text-align:center;">2</td>
                    <td style="text-align:center;">□ Kurir □ Email □ Ekspedisi</td>
                    <td style="text-align:center;">__/__/____</td>
                    <td style="text-align:center;">____________</td>
                    <td>____________________________</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- TTD --}}
    <div class="footer">
        <table class="ttd">
            <tr>
                <td></td>
                <td class="right">
                    <div>Sumenep, {{ $tanggalCetak ?? '-' }}</div>
                    <div style="margin-top: 6px;"><b>{{ $ttd['jabatan'] ?? 'Pejabat' }}</b></div>
                    <div class="space"></div>
                    <div><b>{{ $ttd['nama'] ?? '____________________' }}</b></div>
                    <div class="small">{{ $ttd['nip'] ?? '' }}</div>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
