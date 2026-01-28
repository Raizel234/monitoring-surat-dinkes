<section>
    <style>
        .password-header-title {
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

        .btn-update-custom {
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

        .btn-update-custom:hover {
            background-color: #146c43 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .security-note {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            color: #856404;
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 0.85rem;
        }
    </style>

    <header class="mb-4">
        <h2 class="text-xl password-header-title">
            {{ __('Perbarui Kata Sandi') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk menjaga keamanan.') }}
        </p>
        <div class="mt-2" style="width: 50px; height: 3px; background: #ffc107; border-radius: 2px;"></div>
    </header>

    <div class="security-note mb-4">
        <i class="bi bi-shield-lock-fill me-2"></i>
        {{ __('Gunakan minimal 8 karakter dengan kombinasi huruf, angka, dan simbol.') }}
    </div>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="mb-4">
            <x-input-label for="update_password_current_password" :value="__('Kata Sandi Saat Ini')" class="font-semibold mb-2" />
            <div class="input-group-custom">
                <i class="bi bi-key input-icon"></i>
                <x-text-input id="update_password_current_password" name="current_password" type="password"
                    class="mt-1 block w-full form-input-styled"
                    autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="update_password_password" :value="__('Kata Sandi Baru')" class="font-semibold mb-2" />
            <div class="input-group-custom">
                <i class="bi bi-lock-fill input-icon"></i>
                <x-text-input id="update_password_password" name="password" type="password"
                    class="mt-1 block w-full form-input-styled"
                    autocomplete="new-password" placeholder="Minimal 8 karakter" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="font-semibold mb-2" />
            <div class="input-group-custom">
                <i class="bi bi-shield-check input-icon"></i>
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                    class="mt-1 block w-full form-input-styled"
                    autocomplete="new-password" placeholder="Ulangi kata sandi baru" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button class="btn-update-custom">
                <i class="bi bi-check2-circle me-2"></i> {{ __('Simpan Kata Sandi') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-green-600 fw-semibold"
                >
                    <i class="bi bi-shield-fill-check me-1"></i> {{ __('Kata sandi berhasil diperbarui.') }}
                </p>
            @endif
        </div>
    </form>
</section>
