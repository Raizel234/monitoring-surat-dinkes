<?php

namespace App\Http\Controllers;

use App\Models\Berita;

class BeritaPublicController extends Controller
{
    public function index()
    {
        $beritas = Berita::where('is_publish', 1)->latest()->paginate(9);
        return view('berita.index', compact('beritas'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->where('is_publish', 1)->firstOrFail();

        $terkait = Berita::where('is_publish', 1)
            ->where('id', '!=', $berita->id)
            ->latest()
            ->take(4)
            ->get();

        return view('berita.show', compact('berita', 'terkait'));
    }
}
