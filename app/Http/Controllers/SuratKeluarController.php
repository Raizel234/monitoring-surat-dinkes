<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class SuratKeluarController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q; // keyword
        $status = $request->status; // status
        $from = $request->from; // tanggal awal
        $to = $request->to; // tanggal akhir

        $query = SuratKeluar::query();

        // ✅ Search: nomor surat / tujuan / perihal
        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('nomor_surat', 'like', "%$q%")
                    ->orWhere('tujuan', 'like', "%$q%")
                    ->orWhere('perihal', 'like', "%$q%");
            });
        }

        // ✅ Filter status
        if ($status) {
            $query->where('status', $status);
        }

        // ✅ Filter tanggal (range)
        if ($from && $to) {
            $query->whereBetween('tanggal_surat', [$from, $to]);
        } elseif ($from) {
            $query->whereDate('tanggal_surat', '>=', $from);
        } elseif ($to) {
            $query->whereDate('tanggal_surat', '<=', $to);
        }

        $data = $query->latest()->get();

        return view('surat_keluar.index', compact('data'));
    }

    public function create()
    {
        return view('surat_keluar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required',
            'tujuan' => 'required',
            'perihal' => 'required',
        ]);

        $file = null;
        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat')->store('surat', 'public');
        }

        $surat = SuratKeluar::create([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tujuan' => $request->tujuan,
            'perihal' => $request->perihal,
            'file_surat' => $file,
            'status' => $request->status,
        ]);
        logAktivitas('Tambah Surat Keluar', 'Surat Keluar', 'SuratKeluar', $surat->id, 'Menambahkan surat keluar nomor: ' . $surat->nomor_surat);

        return redirect()->route('surat-keluar.index')->with('success', 'Data surat keluar berhasil disimpan');
    }

    public function edit($id)
    {
        $data = SuratKeluar::findOrFail($id);

        return view('surat_keluar.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = SuratKeluar::findOrFail($id);

        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat')->store('surat', 'public');
            $data->file_surat = $file;
        }

        $data->update([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tujuan' => $request->tujuan,
            'perihal' => $request->perihal,
            'status' => $request->status,
        ]);
        logAktivitas('Edit Surat Keluar', 'Surat Keluar', 'SuratKeluar', $data->id, 'Mengubah surat keluar nomor: ' . $data->nomor_surat);

        return redirect()->route('surat-keluar.index')->with('success', 'Data surat keluar berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = SuratKeluar::findOrFail($id);

        logAktivitas('Hapus Surat Keluar', 'Surat Keluar', SuratKeluar::class, $data->id, 'Menghapus surat keluar nomor: ' . $data->nomor_surat);

        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
