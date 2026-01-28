<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Akun | Sistem Monitoring Surat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-green: #198754;
            --accent-yellow: #ffc107;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f5132 0%, #198754 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 0;
            position: relative;
            overflow-x: hidden;
        }

        /* Dekorasi Background */
        body::before {
            content: "";
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            top: -150px;
            right: -150px;
            z-index: 0;
        }

        .register-card {
            border: none;
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.25);
            z-index: 1;
        }

        .header {
            text-align: center;
        }

        .header img {
            width: 75px;
            filter: drop-shadow(0 5px 10px rgba(0,0,0,0.1));
        }

        .header h5 {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            color: var(--primary-green);
            margin-top: 15px;
            line-height: 1.2;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #444;
            margin-bottom: 5px;
        }

        .input-group-text {
            background-color: transparent;
            border-right: none;
            color: var(--primary-green);
            border-radius: 12px 0 0 12px;
        }

        .form-control {
            border-left: none;
            padding: 10px 15px;
            border-radius: 0 12px 12px 0;
            font-size: 0.95rem;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #dee2e6;
        }

        .input-group:focus-within {
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.15);
            border-radius: 12px;
        }

        .btn-register {
            background: var(--primary-green);
            border: none;
            padding: 12px;
            font-weight: 700;
            border-radius: 12px;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: white;
        }

        .btn-register:hover {
            background: #146c43;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            color: white;
        }

        .login-link {
            text-decoration: none;
            font-size: 0.85rem;
            color: var(--primary-green);
            font-weight: 600;
        }

        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-5">

                <div class="card register-card shadow">
                    <div class="card-body p-4 p-md-5">

                        <div class="header mb-4">
                            <img src="/images/avatar/Lambang_Kabupaten_Sumenep.png" alt="Logo Dinas">
                            <h5>DAFTAR AKUN BARU</h5>
                            <div class="mx-auto mt-2" style="width: 40px; height: 3px; background: var(--accent-yellow); border-radius: 2px;"></div>
                            <p class="text-muted small mt-2">Lengkapi data untuk akses Sistem Monitoring Surat</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Masukkan nama sesuai SK" required autofocus>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="email@sumenep.go.id" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kata Sandi</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Minimal 8 karakter" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Ulangi Kata Sandi</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                                    <input type="password" name="password_confirmation"
                                        class="form-control" placeholder="Konfirmasi sandi" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-register w-100 mb-3 shadow-sm">
                                Daftar Sekarang <i class="bi bi-person-plus-fill ms-2"></i>
                            </button>

                            <div class="text-center">
                                <span class="text-muted small">Sudah memiliki akun?</span>
                                <a href="{{ route('login') }}" class="login-link ms-1">Masuk di sini</a>
                            </div>

                        </form>
                    </div>
                </div>

                <p class="text-center text-white mt-4 small opacity-75">
                    © {{ date('Y') }} <strong>Dinas Kesehatan Kabupaten Sumenep</strong>
                </p>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
