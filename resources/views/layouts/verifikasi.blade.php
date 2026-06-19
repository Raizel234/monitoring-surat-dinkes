<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="/images/avatar/Lambang_Kabupaten_Sumenep.png">
    <title>Verifikasi Dokumen | Dinkes Sumenep</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --dinas-primary: #198754;
            --dinas-dark: #0f5132;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: #f0f2f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .verify-header {
            background: linear-gradient(135deg, #0f5132 0%, #198754 100%);
            color: #fff;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .verify-header img {
            height: 40px;
            width: 40px;
            object-fit: contain;
        }
        .verify-header .brand {
            font-weight: 900;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
        }
        .verify-header .sub {
            font-size: 0.7rem;
            text-transform: uppercase;
            opacity: 0.8;
            font-weight: 700;
        }
        .verify-container {
            flex: 1;
            max-width: 900px;
            margin: 30px auto;
            width: 100%;
            padding: 0 16px;
        }
        .verify-footer {
            text-align: center;
            padding: 14px;
            color: #6b7280;
            font-size: 0.8rem;
            border-top: 1px solid rgba(0,0,0,0.06);
            background: #fff;
        }
    </style>
</head>

<body>
    <div class="verify-header">
        <img src="/images/avatar/Lambang_Kabupaten_Sumenep.png" alt="Logo">
        <div>
            <div class="brand">DINAS KESEHATAN KABUPATEN SUMENEP</div>
            <div class="sub">Sistem Monitoring Administrasi Surat</div>
        </div>
    </div>

    <div class="verify-container">
        @yield('content')
    </div>

    <footer class="verify-footer">
        <strong>&copy; {{ date('Y') }} Dinkes Kabupaten Sumenep</strong>
        &mdash; Sistem Monitoring Administrasi Surat
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
