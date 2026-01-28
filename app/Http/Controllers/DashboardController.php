<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\Disposisi;

class DashboardController extends Controller
{
    public function index()
    {
        // kartu yang sudah ada
        $masuk  = SuratMasuk::count();
        $keluar = SuratKeluar::count();

        // ✅ monitoring surat masuk
        $masukDiproses = SuratMasuk::where('status', 'Diproses')->count();
        $masukSelesai  = SuratMasuk::where('status', 'Selesai')->count();

        // ✅ monitoring disposisi
        $disposisiMenunggu = Disposisi::where('status', 'Menunggu')->count();
        $disposisiDiproses = Disposisi::where('status', 'Diproses')->count();

        // ✅ deadline terdekat (yang belum selesai)
        $deadlineDisposisi = Disposisi::with('suratMasuk')
            ->whereNotNull('batas_waktu')
            ->where('status', '!=', 'Selesai')
            ->orderBy('batas_waktu', 'asc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'masuk', 'keluar',
            'masukDiproses', 'masukSelesai',
            'disposisiMenunggu', 'disposisiDiproses',
            'deadlineDisposisi'
        ));
    }
}
