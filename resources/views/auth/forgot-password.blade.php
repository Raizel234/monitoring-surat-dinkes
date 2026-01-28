<x-guest-layout>
    <style>
        /* MENGHAPUS LOGO LARAVEL BAWAAN */
        /* Kita sembunyikan link logo yang ada di atas slot guest layout */
        .min-h-screen > div:first-child > a {
            display: none !important;
        }

        /* PERBAIKAN BACKGROUND GUEST LAYOUT */
        /* Karena Breeze sering membungkus halaman, kita paksa background-nya */
        .min-h-screen {
            background: linear-gradient(135deg, #0f5132 0%, #198754 100%) !important;
        }

        .forgot-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            border: none;
            padding: 2.5rem;
            max-width: 450px;
            width: 100%;
            margin: auto;
        }

        .btn-primary-custom {
            background-color: #198754 !important;
            border: none !important;
            padding: 12px 24px !important;
            border-radius: 12px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            transition: all 0.3s !important;
            width: 100%;
            display: flex;
            justify-content: center;
            color: white !important;
        }

        .btn-primary-custom:hover {
            background-color: #146c43 !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .input-custom {
            border-radius: 10px !important;
            border: 1px solid #dee2e6 !important;
            padding: 12px !important;
            margin-top: 5px !important;
        }

        .logo-dinkes {
            width: 85px;
            margin: 0 auto 1rem;
            display: block;
            filter: drop-shadow(0 5px 10px rgba(0,0,0,0.1));
        }
    </style>

    <div class="forgot-card">
        <div class="text-center mb-4">
            <img src="/images/avatar/Lambang_Kabupaten_Sumenep.png" class="logo-dinkes" alt="Logo Sumenep">
            <h5 class="fw-bold" style="font-family: 'Playfair Display', serif; color: #198754; font-size: 1.25rem;">Reset Kata Sandi</h5>
            <div class="mx-auto mt-2" style="width: 40px; height: 3px; background: #ffc107; border-radius: 2px;"></div>
        </div>

        <div class="mb-4 text-sm text-gray-600 text-center" style="line-height: 1.6;">
            {{ __('Lupa kata sandi? Masukkan alamat email Anda dan kami akan mengirimkan tautan reset melalui email.') }}
        </div>

        <x-auth-session-status class="mb-4 text-center font-medium text-sm text-green-600" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4 text-left">
                <x-input-label for="email" :value="__('Email Instansi / Pegawai')" class="font-semibold text-gray-700 mb-1" style="display: block; text-align: left;" />
                <x-text-input id="email" class="block w-full input-custom" type="email" name="email" :value="old('email')" required autofocus placeholder="contoh@sumenep.go.id" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex flex-col items-center gap-3">
                <x-primary-button class="btn-primary-custom">
                    {{ __('Kirim Tautan Reset') }}
                </x-primary-button>

                <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-green-700 transition-colors mt-2" style="text-decoration: none;">
                    <i class="bi bi-arrow-left"></i> Kembali ke Login
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
