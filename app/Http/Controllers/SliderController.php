<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $data = Slider::orderBy('urutan')->paginate(10);
        return view('admin.slider.index', compact('data'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'link' => 'nullable|url|max:500',
            'urutan' => 'nullable|integer|min:0',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:10000',
            'is_active' => 'nullable|boolean',
        ]);

        $path = $request->file('gambar')->store('slider', 'public');

        Slider::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
            'urutan' => $request->urutan ?? 0,
            'gambar' => $path,
            'is_active' => $request->boolean('is_active'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.slider.index')->with('success', 'Slider berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'link' => 'nullable|url|max:500',
            'urutan' => 'nullable|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10000',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            if ($slider->gambar && Storage::disk('public')->exists($slider->gambar)) {
                Storage::disk('public')->delete($slider->gambar);
            }
            $slider->gambar = $request->file('gambar')->store('slider', 'public');
        }

        $slider->judul = $request->judul;
        $slider->deskripsi = $request->deskripsi;
        $slider->link = $request->link;
        $slider->urutan = $request->urutan ?? 0;
        $slider->is_active = $request->boolean('is_active');
        $slider->save();

        return redirect()->route('admin.slider.index')->with('success', 'Slider berhasil diperbarui.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->gambar && Storage::disk('public')->exists($slider->gambar)) {
            Storage::disk('public')->delete($slider->gambar);
        }
        $slider->delete();
        return back()->with('success', 'Slider berhasil dihapus.');
    }
}
