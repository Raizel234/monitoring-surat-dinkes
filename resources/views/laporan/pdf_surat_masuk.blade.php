<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Surat Masuk</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #111; }
        .header { text-align: center; margin-bottom: 10px; }
        .t1 { font-size: 16px; font-weight: bold; }
        .t2 { font-size: 12px; margin-top: 3px; }
        .meta { margin: 12px 0 14px; padding: 8px 10px; border: 1px solid #ddd; border-radius: 6px; }
        .meta b { display: inline-block; width: 90px; }

        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 7px 8px; vertical-align: top; }
        th { background: #f2f2f2; text-transform: uppercase; font-size: 11px; letter-spacing: .4px; }
        .text-center { text-align: center; }
        .muted { color: #666; }
    </style>
</head>
<body>

    @php
        // ✅ anti error walau suatu saat filters tidak ikut
        $filters = $filters ?? [];
    @endphp

    <div class="header">
        <div class="t1">LAPORAN SURAT MASUK</div>
        <div class="t2">Dinas Kesehatan Kabupaten Sumenep</div>
    </div>

    <div class="meta">
        <div><b>Tanggal Cetak</b>: {{ $filters['tanggal_cetak'] ?? '-' }}</div>
        <div><b>Filter</b>:
            q={{ $filters['q'] ?? '-' }},
            status={{ $filters['status'] ?? '-' }},
            from={{ $filters['from'] ?? '-' }},
            to={{ $filters['to'] ?? '-' }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 35px;">No</th>
                <th style="width: 130px;">Nomor Surat</th>
                <th style="width: 95px;">Tanggal</th>
                <th style="width: 170px;">Pengirim</th>
                <th>Perihal</th>
                <th class="text-center" style="width: 85px;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i => $d)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $d->nomor_surat }}</td>
                    <td>{{ \Carbon\Carbon::parse($d->tanggal_surat)->format('d/m/Y') }}</td>
                    <td>{{ $d->pengirim }}</td>
                    <td>{{ $d->perihal }}</td>
                    <td class="text-center">{{ $d->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center muted">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
