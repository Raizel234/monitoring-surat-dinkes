<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $data = Berita::latest()->paginate(10);
        return view('admin.berita.index', compact('data'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'ringkasan' => 'nullable|string',
            'konten' => 'required|string',
            'is_publish' => 'nullable|boolean',
        ]);

        // slug unik
        $slug = Str::slug($request->judul);
        $slugOriginal = $slug;
        $i = 1;
        while (Berita::where('slug', $slug)->exists()) {
            $slug = $slugOriginal . '-' . $i++;
        }

        $path = null;
        if ($request->hasFile('gambar')) {
            // simpan ke storage/app/public/berita
            $path = $request->file('gambar')->store('berita', 'public');
        }

        $isPublish = $request->boolean('is_publish');

        Berita::create([
            'judul' => $request->judul,
            'slug' => $slug,
            'kategori' => $request->kategori,
            'gambar' => $path, // contoh: berita/xxxx.webp
            'ringkasan' => $request->ringkasan,
            'konten' => $request->konten,
            'is_publish' => $isPublish,
            'published_at' => $isPublish ? now() : null,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'ringkasan' => 'nullable|string',
            'konten' => 'required|string',
            'is_publish' => 'nullable|boolean',
        ]);

        // update slug jika judul berubah
        if ($berita->judul !== $request->judul) {
            $slug = Str::slug($request->judul);
            $slugOriginal = $slug;
            $i = 1;
            while (Berita::where('slug', $slug)->where('id', '!=', $berita->id)->exists()) {
                $slug = $slugOriginal . '-' . $i++;
            }
            $berita->slug = $slug;
        }

        // upload gambar baru -> hapus gambar lama
        if ($request->hasFile('gambar')) {
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $berita->gambar = $request->file('gambar')->store('berita', 'public');
        }

        $isPublish = $request->boolean('is_publish');

        $berita->judul = $request->judul;
        $berita->kategori = $request->kategori;
        $berita->ringkasan = $request->ringkasan;
        $berita->konten = $request->konten;
        $berita->is_publish = $isPublish;

        if ($isPublish) {
            $berita->published_at = $berita->published_at ?? now();
        } else {
            $berita->published_at = null;
        }

        $berita->save();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();
        return back()->with('success', 'Berita berhasil dihapus.');
    }
}
