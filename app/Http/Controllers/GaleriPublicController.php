<?php

namespace App\Http\Controllers;

use App\Models\Galeri;

class GaleriPublicController extends Controller
{
    public function index()
    {
        $data = Galeri::where('is_publish', 1)->latest()->paginate(12);
        return view('galeri.index', compact('data'));
    }

    public function show($id)
    {
        $item = Galeri::where('is_publish', 1)->findOrFail($id);
        $terkait = Galeri::where('is_publish', 1)
            ->where('id', '!=', $item->id)
            ->latest()
            ->take(4)
            ->get();
        return view('galeri.show', compact('item', 'terkait'));
    }
}
