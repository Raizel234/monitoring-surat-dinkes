<?php

namespace App\Http\Controllers;

use App\Models\Halaman;

class HalamanPublicController extends Controller
{
    public function profil($sub)
    {
        $halaman = Halaman::where('kategori', 'profil')
            ->where('sub_kategori', $sub)
            ->where('is_publish', true)
            ->first();

        if ($halaman) {
            return view('halaman.show', compact('halaman'));
        }

        $viewMap = [
            'visi_misi' => 'profil.visimisi',
            'struktur' => 'profil.struktur',
            'sosmed' => 'profil.sosmed',
        ];

        $view = $viewMap[$sub] ?? 'profil.visimisi';
        return view($view);
    }

    public function layanan()
    {
        $halaman = Halaman::where('kategori', 'layanan')
            ->where('is_publish', true)
            ->first();

        if ($halaman) {
            return view('halaman.show', compact('halaman'));
        }

        return view('layanan.layanan');
    }
}
