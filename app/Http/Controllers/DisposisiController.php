<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class DisposisiController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Diproses,Selesai',
        ]);

        $disposisi = Disposisi::findOrFail($id);
        $disposisi->update([
            'status' => $request->status,
        ]);

        // ✅ Otomatis update status Surat Masuk
        $surat = SuratMasuk::with('disposisis')->findOrFail($disposisi->surat_masuk_id);

        // kalau ADA disposisi yang belum selesai -> surat Diproses
        $adaBelumSelesai = $surat->disposisis()->where('status', '!=', 'Selesai')->exists();

        if ($adaBelumSelesai) {
            $surat->update(['status' => 'Diproses']);
        } else {
            $surat->update(['status' => 'Selesai']);
        }
        logAktivitas('Ubah Status Disposisi', 'Disposisi', 'Disposisi', $disposisi->id, 'Status disposisi menjadi: ' . $request->status);

        return back()->with('success', 'Status disposisi berhasil diperbarui.');
    }
    public function suratMasuk()
    {
        return $this->belongsTo(\App\Models\SuratMasuk::class);
    }
}
