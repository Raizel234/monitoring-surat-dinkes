<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\BeritaPublicController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome'); // atau landing.blade.php kalau mau
})->name('home');

/*
|--------------------------------------------------------------------------
| PUBLIK (TANPA LOGIN)
|--------------------------------------------------------------------------
*/
Route::prefix('profil')->group(function () {

    Route::get('/visi-misi', function () {
        return view('profil.visimisi');
    })->name('profil.visimisi');

    Route::get('/struktur', function () {
        return view('profil.struktur');
    })->name('profil.struktur');

    Route::get('/galeri', function () {
        return view('profil.galeri');
    })->name('profil.galeri');

    Route::get('/sosmed', function () {
        return view('profil.sosmed');
    })->name('profil.sosmed');
});
Route::prefix('layanan')->group(function () {

    Route::get('/layanan', function () {
        return view('layanan.layanan');
    })->name('layanan.layanan');
});

/*
|--------------------------------------------------------------------------
| BERITA PUBLIK
|--------------------------------------------------------------------------
*/
Route::get('/berita', [BeritaPublicController::class, 'index'])->name('berita.public.index');
Route::get('/berita/{slug}', [BeritaPublicController::class, 'show'])->name('berita.public.show');

/*
|--------------------------------------------------------------------------
| DASHBOARD (LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    // Surat
    Route::resource('surat-masuk', SuratMasukController::class);
    Route::resource('surat-keluar', SuratKeluarController::class);

    Route::post('/surat-masuk/{surat}/recipients/{recipient}/toggle-read',
        [SuratMasukController::class, 'toggleReadRecipient'])
        ->name('surat-masuk.recipient.toggle-read');

    Route::get('surat-keluar/{suratKeluar}/cetak/{template}',
        [SuratKeluarController::class, 'cetak'])
        ->name('surat-keluar.cetak');

    // Laporan
    Route::get('/laporan/surat-masuk', [LaporanController::class, 'suratMasuk'])->name('laporan.surat_masuk');
    Route::get('/laporan/surat-masuk/pdf', [LaporanController::class, 'suratMasukPdf'])->name('laporan.surat_masuk.pdf');

    Route::get('/laporan/surat-keluar', [LaporanController::class, 'suratKeluar'])->name('laporan.surat_keluar');
    Route::get('/laporan/surat-keluar/pdf', [LaporanController::class, 'suratKeluarPdf'])->name('laporan.surat_keluar.pdf');

    // Log
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');

    // Profile user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Disposisi
    Route::get('/surat-masuk/{id}/disposisi', [SuratMasukController::class, 'disposisiForm'])->name('surat-masuk.disposisi.form');
    Route::post('/surat-masuk/{id}/disposisi', [SuratMasukController::class, 'disposisiStore'])->name('surat-masuk.disposisi.store');
    Route::get('/surat-masuk/{id}/disposisi/pdf', [SuratMasukController::class, 'disposisiPdf'])->name('surat-masuk.disposisi.pdf');

    Route::get('/surat-masuk/{id}/kendali/pdf', [SuratMasukController::class, 'lembarKendaliPdf'])->name('surat-masuk.kendali.pdf');

    // Verifikasi
    Route::get('/verifikasi/surat-masuk/{id}', [VerifikasiController::class, 'suratMasuk'])->name('verifikasi.surat_masuk');
    Route::get('/verifikasi/surat-keluar/{id}', [VerifikasiController::class, 'suratKeluar'])->name('verifikasi.surat_keluar');

    // Update status
    Route::patch('/disposisi/{id}/status', [DisposisiController::class, 'updateStatus'])->name('disposisi.updateStatus');

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */
    Route::middleware('admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::resource('berita', BeritaController::class)->except(['show']);
            Route::resource('users', AdminUserController::class)->except(['show']);
        });
});

require __DIR__ . '/auth.php';
