<?php

namespace App\Http\Controllers;

use App\Models\Halaman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class HalamanController extends Controller
{
    public function index()
    {
        $data = Halaman::latest()->paginate(10);
        return view('admin.halaman.index', compact('data'));
    }

    public function create()
    {
        return view('admin.halaman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|in:profil,layanan',
            'sub_kategori' => 'nullable|in:visi_misi,struktur,sosmed',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10000',
            'is_publish' => 'nullable|boolean',
        ]);

        $slug = Str::slug($request->judul);
        $slugOriginal = $slug;
        $i = 1;
        while (Halaman::where('slug', $slug)->exists()) {
            $slug = $slugOriginal . '-' . $i++;
        }

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('halaman', 'public');
        }

        Halaman::create([
            'judul' => $request->judul,
            'slug' => $slug,
            'konten' => $request->konten,
            'kategori' => $request->kategori,
            'sub_kategori' => $request->sub_kategori,
            'gambar' => $path,
            'is_publish' => $request->boolean('is_publish'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.halaman.index')->with('success', 'Halaman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $halaman = Halaman::findOrFail($id);
        return view('admin.halaman.edit', compact('halaman'));
    }

    public function update(Request $request, Halaman $halaman)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|in:profil,layanan',
            'sub_kategori' => 'nullable|in:visi_misi,struktur,sosmed',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10000',
            'is_publish' => 'nullable|boolean',
        ]);

        if ($halaman->judul !== $request->judul) {
            $slug = Str::slug($request->judul);
            $slugOriginal = $slug;
            $i = 1;
            while (Halaman::where('slug', $slug)->where('id', '!=', $halaman->id)->exists()) {
                $slug = $slugOriginal . '-' . $i++;
            }
            $halaman->slug = $slug;
        }

        if ($request->hasFile('gambar')) {
            if ($halaman->gambar && Storage::disk('public')->exists($halaman->gambar)) {
                Storage::disk('public')->delete($halaman->gambar);
            }
            $halaman->gambar = $request->file('gambar')->store('halaman', 'public');
        }

        $halaman->judul = $request->judul;
        $halaman->konten = $request->konten;
        $halaman->kategori = $request->kategori;
        $halaman->sub_kategori = $request->sub_kategori;
        $halaman->is_publish = $request->boolean('is_publish');
        $halaman->save();

        return redirect()->route('admin.halaman.index')->with('success', 'Halaman berhasil diperbarui.');
    }

    public function destroy(Halaman $halaman)
    {
        if ($halaman->gambar && Storage::disk('public')->exists($halaman->gambar)) {
            Storage::disk('public')->delete($halaman->gambar);
        }
        $halaman->delete();
        return back()->with('success', 'Halaman berhasil dihapus.');
    }
}
