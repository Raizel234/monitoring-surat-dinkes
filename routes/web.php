<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ActivityLogController;
Route::get('/', function () {
    return view('welcome');
});

// ✅ Dashboard pakai controller (agar variabel monitoring lengkap)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('surat-masuk', SuratMasukController::class);
    Route::resource('surat-keluar', SuratKeluarController::class);

    // ======================
    // LAPORAN
    // ======================
    Route::get('/laporan/surat-masuk', [LaporanController::class, 'suratMasuk'])->name('laporan.surat_masuk');

    Route::get('/laporan/surat-masuk/pdf', [LaporanController::class, 'suratMasukPdf'])->name('laporan.surat_masuk.pdf');

    Route::get('/laporan/surat-keluar', [LaporanController::class, 'suratKeluar'])->name('laporan.surat_keluar');
    Route::get('/surat-masuk/{id}/detail', [\App\Http\Controllers\SuratMasukController::class, 'show'])->name('surat-masuk.show');
    Route::resource('surat-keluar', SuratKeluarController::class);

    Route::get('/laporan/surat-keluar/pdf', [LaporanController::class, 'suratKeluarPdf'])->name('laporan.surat_keluar.pdf');
    Route::get('/activity-logs', [\App\Http\Controllers\ActivityLogController::class, 'index'])->name('activity-logs.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ Disposisi surat masuk
    Route::get('/surat-masuk/{id}/disposisi', [SuratMasukController::class, 'disposisiForm'])->name('surat-masuk.disposisi.form');

    Route::post('/surat-masuk/{id}/disposisi', [SuratMasukController::class, 'disposisiStore'])->name('surat-masuk.disposisi.store');

    // ✅ Update status disposisi
    Route::patch('/disposisi/{id}/status', [DisposisiController::class, 'updateStatus'])->name('disposisi.updateStatus');
});

require __DIR__ . '/auth.php';
