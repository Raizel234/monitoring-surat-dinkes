<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DokumenPublikController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\BeritaPublicController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| PUBLIK (TIDAK PERLU LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/berita', [BeritaPublicController::class, 'index'])->name('berita.public.index');
Route::get('/berita/{slug}', [BeritaPublicController::class, 'show'])->name('berita.public.show');

// Kalau dokumen publik ingin bisa dilihat publik:

/*
|--------------------------------------------------------------------------
| DASHBOARD (HARUS LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Surat Masuk + Keluar
    Route::resource('surat-masuk', SuratMasukController::class);
    Route::resource('surat-keluar', SuratKeluarController::class);

    // SHOW detail (kalau kamu mau rute custom, ini optional karena resource sudah punya show)
    Route::get('/surat-masuk/{id}', [SuratMasukController::class, 'show'])->name('surat-masuk.show');
    Route::get('/surat-keluar/{id}', [SuratKeluarController::class, 'show'])->name('surat-keluar.show');

    // Laporan
    Route::get('/laporan/surat-masuk', [LaporanController::class, 'suratMasuk'])->name('laporan.surat_masuk');
    Route::get('/laporan/surat-masuk/pdf', [LaporanController::class, 'suratMasukPdf'])->name('laporan.surat_masuk.pdf');

    Route::get('/laporan/surat-keluar', [LaporanController::class, 'suratKeluar'])->name('laporan.surat_keluar');
    Route::get('/laporan/surat-keluar/pdf', [LaporanController::class, 'suratKeluarPdf'])->name('laporan.surat_keluar.pdf');

    // Activity log
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Disposisi
    Route::get('/surat-masuk/{id}/disposisi', [SuratMasukController::class, 'disposisiForm'])->name('surat-masuk.disposisi.form');
    Route::post('/surat-masuk/{id}/disposisi', [SuratMasukController::class, 'disposisiStore'])->name('surat-masuk.disposisi.store');
    Route::get('/surat-masuk/{id}/disposisi/pdf', [SuratMasukController::class, 'disposisiPdf'])->name('surat-masuk.disposisi.pdf');
    

    // Lembar kendali
    Route::get('/surat-keluar/{id}/kendali/pdf', [SuratKeluarController::class, 'lembarKendaliPdf'])->name('surat-keluar.kendali.pdf');
    Route::get('/surat-masuk/{id}/kendali/pdf', [SuratMasukController::class, 'lembarKendaliPdf'])->name('surat-masuk.kendali.pdf');

    // Verifikasi publik (kalau mau publik, pindahin keluar auth)
    Route::get('/verifikasi/surat-masuk/{id}', [VerifikasiController::class, 'suratMasuk'])->name('verifikasi.surat_masuk');
    Route::get('/verifikasi/surat-keluar/{id}', [VerifikasiController::class, 'suratKeluar'])->name('verifikasi.surat_keluar');

    // Update status disposisi
    Route::patch('/disposisi/{id}/status', [DisposisiController::class, 'updateStatus'])->name('disposisi.updateStatus');

    /*
    |--------------------------------------------------------------------------
    | ADMIN: BERITA (HARUS LOGIN)
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::resource('berita', BeritaController::class)
                ->except(['show'])
                ->parameters(['berita' => 'berita']);
            // kalau dokumen publik upload dikelola admin:
        });
});

require __DIR__ . '/auth.php';
