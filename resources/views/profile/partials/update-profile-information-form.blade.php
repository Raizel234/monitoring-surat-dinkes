<section>
    <style>
        .profile-header-title {
            font-family: 'Playfair Display', serif;
            color: #198754;
            font-weight: 700;
        }

        .input-group-custom {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            color: #198754;
            z-index: 10;
        }

        .form-input-styled {
            padding-left: 45px !important;
            border-radius: 12px !important;
            border: 1px solid #dee2e6 !important;
            transition: all 0.3s ease !important;
            height: 50px;
        }

        .form-input-styled:focus {
            border-color: #198754 !important;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.15) !important;
        }

        .btn-save-custom {
            background-color: #198754 !important;
            color: white !important;
            padding: 10px 25px !important;
            border-radius: 10px !important;
            font-weight: 600 !important;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none !important;
            transition: all 0.3s ease !important;
        }

        .btn-save-custom:hover {
            background-color: #146c43 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .alert-info-custom {
            background-color: #e9f7ef;
            border-left: 4px solid #198754;
            color: #0f5132;
            padding: 15px;
            border-radius: 8px;
        }
    </style>

    <header class="mb-4">
        <h2 class="text-xl profile-header-title">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Perbarui informasi profil akun dan alamat email instansi Anda.") }}
        </p>
        <div class="mt-2" style="width: 50px; height: 3px; background: #ffc107; border-radius: 2px;"></div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="mb-4">
            <x-input-label for="name" :value="__('Nama Lengkap')" class="font-semibold mb-2" />
            <div class="input-group-custom">
                <i class="bi bi-person input-icon"></i>
                <x-text-input id="name" name="name" type="text"
                    class="mt-1 block w-full form-input-styled"
                    :value="old('name', $user->name)" required autofocus autocomplete="name" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="mb-4">
            <x-input-label for="email" :value="__('Alamat Email')" class="font-semibold mb-2" />
            <div class="input-group-custom">
                <i class="bi bi-envelope input-icon"></i>
                <x-text-input id="email" name="email" type="email"
                    class="mt-1 block w-full form-input-styled"
                    :value="old('email', $user->email)" required autocomplete="username" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert-info-custom mt-3">
                    <p class="text-sm">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ __('Alamat email Anda belum terverifikasi.') }}

                        <button form="send-verification" class="fw-bold underline text-sm text-green-700 hover:text-green-900 focus:outline-none">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            <i class="bi bi-check-all me-1"></i> {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button class="btn-save-custom">
                <i class="bi bi-save me-2"></i> {{ __('Simpan Perubahan') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-green-600 fw-semibold"
                >
                    <i class="bi bi-check-circle-fill me-1"></i> {{ __('Berhasil disimpan.') }}
                </p>
            @endif
        </div>
    </form>
</section>
