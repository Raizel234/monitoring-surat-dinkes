<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;

class VerifikasiController extends Controller
{
    public function suratMasuk($id)
    {
        $data = SuratMasuk::with(['disposisis'])->findOrFail($id);
        return view('verifikasi.surat_masuk', compact('data'));
    }

    public function suratKeluar($id)
    {
        $data = SuratKeluar::findOrFail($id);
        return view('verifikasi.surat_keluar', compact('data'));
    }
}
