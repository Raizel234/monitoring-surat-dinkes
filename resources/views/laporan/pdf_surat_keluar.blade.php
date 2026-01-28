<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
        .header { text-align:center; margin-bottom:10px; }
        .header .t1 { font-size: 14px; font-weight: bold; }
        .header .t2 { font-size: 11px; }
        .meta { margin: 10px 0; font-size: 10px; }
        table { width:100%; border-collapse:collapse; }
        th, td { border:1px solid #333; padding:6px; }
        th { background:#f2f2f2; }
    </style>
</head>
<body>
    <div class="header">
        <div class="t1">LAPORAN SURAT KELUAR</div>
        <div class="t2">Dinas Kesehatan Kabupaten Sumenep</div>
    </div>

    <div class="meta">
        <div><b>Tanggal Cetak:</b> {{ $filters['tanggal_cetak'] }}</div>
        <div><b>Filter:</b>
            q={{ $filters['q'] ?? '-' }},
            status={{ $filters['status'] ?? '-' }},
            from={{ $filters['from'] ?? '-' }},
            to={{ $filters['to'] ?? '-' }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th>Nomor Surat</th>
                <th>Tujuan</th>
                <th>Perihal</th>
                <th width="12%">Tanggal</th>
                <th width="12%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $d->nomor_surat }}</td>
                <td>{{ $d->tujuan }}</td>
                <td>{{ $d->perihal }}</td>
                <td>{{ \Carbon\Carbon::parse($d->tanggal_surat)->format('d/m/Y') }}</td>
                <td align="center">{{ $d->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
