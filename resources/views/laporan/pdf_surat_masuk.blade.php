<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Surat Masuk</title>
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
            width: 105px;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
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
            margin-top: 22px;
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

        .ttd .space {
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

        .qr-box {
            text-align: center;
            padding: 4px 2px;
        }

        .qr-img {
            width: 70px;
            height: 70px;
        }

        .qr-text {
            font-size: 8px;
            color: #333;
            margin-top: 2px;
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

    <div class="title">Laporan Surat Masuk</div>

    {{-- META FILTER --}}
    <div class="meta">
        <div><b>Tanggal Cetak</b>: {{ $tanggalCetak ?? '-' }}</div>
        <div><b>Kata Kunci</b>: {{ $filters['q'] ?: '-' }}</div>
        <div><b>Status</b>: {{ $filters['status'] ?: '-' }}</div>
        <div><b>Periode</b>:
            {{ $filters['from'] ?: '-' }} s/d {{ $filters['to'] ?: '-' }}
        </div>
    </div>

    {{-- TABEL --}}
    <table class="data">
        <thead>
            <tr>
                <th style="width:30px;">No</th>
                <th style="width:120px;">Nomor Surat</th>
                <th style="width:80px;">Tanggal</th>
                <th>Pengirim</th>
                <th>Perihal</th>
                <th style="width:70px;">Status</th>
                <th style="width:75px;">Verifikasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i => $d)
                @php
                    $verifUrl = isset($verifBaseUrl) ? $verifBaseUrl . '/' . $d->id : null;

                    // ✅ QR pakai Google Chart API (PNG), aman tanpa imagick
                    $qrUrl = $verifUrl
                        ? 'https://chart.googleapis.com/chart?chs=140x140&cht=qr&chld=L|0&chl=' . urlencode($verifUrl)
                        : null;
                @endphp

                <tr>
                    <td style="text-align:center;">{{ $i + 1 }}</td>
                    <td>{{ $d->nomor_surat }}</td>
                    <td style="text-align:center;">
                        {{ \Carbon\Carbon::parse($d->tanggal_surat)->format('d/m/Y') }}
                    </td>
                    <td>{{ $d->pengirim }}</td>
                    <td>{{ $d->perihal }}</td>
                    <td style="text-align:center;">{{ $d->status }}</td>

                    <<td class="qr-box">
                        @if (!empty($qrMap[$d->id]))
                            <img class="qr-img" src="{{ $qrMap[$d->id] }}" alt="QR">
                            <div class="qr-text">Scan</div>
                        @else
                            <div class="qr-text">-</div>
                        @endif
                        </td>

                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:14px;">
                        Tidak ada data.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- TTD --}}
    <div class="footer">
        <table class="ttd">
            <tr>
                <td></td>
                <td class="right">
                    <div>Sumenep, {{ $tanggalCetak ?? '-' }}</div>
                    <div style="margin-top: 6px;"><b>{{ $ttd['jabatan'] ?? 'Pejabat' }}</b></div>
                    <div class="space"></div>
                    <div><b>{{ $ttd['nama'] ?? '____________' }}</b></div>
                    <div class="small">{{ $ttd['nip'] ?? '' }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="pagenum">
        Halaman
        <script type="text/php">
            if (isset($pdf)) {
                $pdf->page_text(520, 820, "Halaman {PAGE_NUM} / {PAGE_COUNT}", null, 9, [0,0,0]);
            }
        </script>
    </div>

</body>

</html>
