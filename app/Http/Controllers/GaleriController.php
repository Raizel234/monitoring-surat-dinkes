<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $data = Galeri::latest()->paginate(10);
        return view('admin.galeri.index', compact('data'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:100',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:10000',
            'is_publish' => 'nullable|boolean',
        ]);

        $path = $request->file('gambar')->store('galeri', 'public');
        $isPublish = $request->boolean('is_publish');

        Galeri::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'gambar' => $path,
            'is_publish' => $isPublish,
            'published_at' => $isPublish ? now() : null,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10000',
            'is_publish' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $galeri->gambar = $request->file('gambar')->store('galeri', 'public');
        }

        $isPublish = $request->boolean('is_publish');

        $galeri->judul = $request->judul;
        $galeri->deskripsi = $request->deskripsi;
        $galeri->kategori = $request->kategori;
        $galeri->is_publish = $isPublish;
        $galeri->published_at = $isPublish ? ($galeri->published_at ?? now()) : null;
        $galeri->save();

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }
        $galeri->delete();
        return back()->with('success', 'Galeri berhasil dihapus.');
    }
}
