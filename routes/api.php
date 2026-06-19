<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

/*
|--------------------------------------------------------------------------
| API Publik (Tidak Perlu Auth)
|--------------------------------------------------------------------------
*/
Route::get('/verifikasi/surat-masuk/{id}', [ApiController::class, 'verifikasiSuratMasuk']);
Route::get('/verifikasi/surat-keluar/{token}', [ApiController::class, 'verifikasiSuratKeluar']);

/*
|--------------------------------------------------------------------------
| API dengan Auth (Sanctum)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/surat-masuk', [ApiController::class, 'suratMasuk']);
    Route::get('/surat-masuk/{id}', [ApiController::class, 'suratMasukDetail']);

    Route::get('/surat-keluar', [ApiController::class, 'suratKeluar']);
    Route::get('/surat-keluar/{id}', [ApiController::class, 'suratKeluarDetail']);

    Route::get('/stats', [ApiController::class, 'stats']);
    Route::get('/activity-logs', [ApiController::class, 'activityLogs']);

    Route::get('/users', [ApiController::class, 'users'])->middleware('admin');
    Route::get('/berita', [ApiController::class, 'berita']);
    Route::get('/galeri', [ApiController::class, 'galeri']);
    Route::get('/sliders', [ApiController::class, 'sliders']);
    Route::get('/halaman/{kategori?}', [ApiController::class, 'halaman']);
});
