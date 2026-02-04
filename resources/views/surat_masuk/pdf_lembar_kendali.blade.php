<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Lembar Kendali Surat Masuk</title>
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

        .pagenum {
            position: fixed;
            bottom: -5px;
            right: 0;
            font-size: 9px;
            color: #555;
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

    <div class="title">Lembar Kendali Surat Masuk</div>

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
                <td class="label"><b>Pengirim</b></td>
                <td class="colon">:</td>
                <td colspan="4">{{ $surat->pengirim ?? '-' }}</td>
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

                <td class="label"><b>Tujuan</b></td>
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
                <td class="label"><b>Diterima Tgl</b></td>
                <td class="colon">:</td>
                <td>________________</td>

                <td class="label"><b>Jam</b></td>
                <td class="colon">:</td>
                <td>____________</td>
            </tr>
        </table>
    </div>

    {{-- RIWAYAT DISPOSISI --}}
    <div class="box">
        <b>Riwayat Disposisi</b>
        <table class="data">
            <thead>
                <tr>
                    <th style="width:30px;">No</th>
                    <th>Tujuan</th>
                    <th>Instruksi</th>
                    <th style="width:70px;">Prioritas</th>
                    <th style="width:90px;">Batas Waktu</th>
                    <th style="width:80px;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($surat->disposisis as $i => $d)
                    <tr>
                        <td style="text-align:center;">{{ $i + 1 }}</td>
                        <td>{{ $d->tujuan }}</td>
                        <td>{{ $d->instruksi ?? '-' }}</td>
                        <td style="text-align:center;">{{ $d->prioritas }}</td>
                        <td style="text-align:center;">
                            @if ($d->batas_waktu)
                                {{ \Carbon\Carbon::parse($d->batas_waktu)->format('d/m/Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td style="text-align:center;">{{ $d->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:12px;">
                            Belum ada disposisi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- CATATAN / PARAF --}}
    <div class="box">
        <b>Catatan / Paraf</b><br><br>
        <div style="border:1px solid #000; height:70px;"></div>
        <div style="margin-top:8px;">
            <b>Tanggal Penyelesaian:</b> ____________________ &nbsp;&nbsp;&nbsp;
            <b>Paraf:</b> ________________
        </div>
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

    <div class="pagenum">
        <script type="text/php">
            if (isset($pdf)) {
                $pdf->page_text(520, 820, "Halaman {PAGE_NUM} / {PAGE_COUNT}", null, 9, [0,0,0]);
            }
        </script>
    </div>

</body>

</html>
