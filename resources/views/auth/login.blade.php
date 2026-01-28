<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login | Sistem Monitoring Surat</title>
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
            margin: 0;
            position: relative;
            overflow: hidden;
        }

        /* Dekorasi Background Bulat Animasi */
        body::before, body::after {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            z-index: 0;
        }
        body::before { top: -100px; left: -100px; }
        body::after { bottom: -100px; right: -100px; }

        .login-card {
            border: none;
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            z-index: 1;
            overflow: hidden;
        }

        .login-header {
            text-align: center;
            padding-bottom: 20px;
        }

        .login-header img {
            width: 80px;
            filter: drop-shadow(0 5px 10px rgba(0,0,0,0.1));
        }

        .login-header h5 {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            color: var(--primary-green);
            letter-spacing: 0.5px;
            line-height: 1.2;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #444;
        }

        .input-group-text {
            background-color: transparent;
            border-right: none;
            color: var(--primary-green);
        }

        .form-control {
            border-left: none;
            padding: 12px;
            border-radius: 0 10px 10px 0;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #dee2e6;
        }

        .input-group:focus-within {
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.15);
            border-radius: 10px;
        }

        .btn-login {
            background: var(--primary-green);
            border: none;
            padding: 12px;
            font-weight: 700;
            border-radius: 12px;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-login:hover {
            background: #146c43;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .forgot-link {
            text-decoration: none;
            font-size: 0.85rem;
            color: var(--primary-green);
            transition: 0.3s;
        }

        .forgot-link:hover {
            color: #111;
            text-decoration: underline;
        }

        .form-check-input:checked {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
        }
    </style>
</head>

<body>

    <div class="container d-flex align-items-center justify-content-center">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">

            <div class="card login-card p-2 p-md-4">
                <div class="card-body">

                    <div class="login-header mb-4">
                        <a href="/">
                            <img src="/images/avatar/Lambang_Kabupaten_Sumenep.png" alt="Logo Sumenep" class="mb-3">
                        </a>
                        <h5>DINAS KESEHATAN<br>KABUPATEN SUMENEP</h5>
                        <div class="mx-auto mt-2" style="width: 40px; height: 3px; background: var(--accent-yellow); border-radius: 2px;"></div>
                        <p class="text-muted mt-2 mb-0" style="font-size: 0.8rem;">Monitoring Administrasi Surat</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success border-0 small py-2 text-center">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="nama@email.com" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label class="form-label">Password</label>
                                @if (Route::has('password.request'))
                                    <a class="forgot-link" href="{{ route('password.request') }}">Lupa Password?</a>
                                @endif
                            </div>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="••••••••" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label text-muted small" for="remember">Ingat perangkat ini</label>
                        </div>

                        <button type="submit" class="btn btn-success btn-login w-100 mb-3">
                            Masuk Ke Sistem <i class="bi bi-box-arrow-in-right ms-2"></i>
                        </button>

                        <div class="text-center">
                            <a href="/" class="text-muted small text-decoration-none">
                                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                            </a>
                        </div>
                    </form>

                </div>
            </div>

            <p class="text-center text-white mt-4 small opacity-75">
                <strong>© {{ date('Y') }} Dinkes Sumenep</strong><br>
                Sistem Informasi Monitoring Surat v1.0
            </p>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
