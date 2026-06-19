<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisposisiController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Diproses,Selesai',
        ]);

        DB::transaction(function () use ($request, $id) {
            $disposisi = Disposisi::findOrFail($id);

            // Validasi transisi status (tidak boleh mundur dari Selesai)
            if ($disposisi->status === 'Selesai' && $request->status !== 'Selesai') {
                abort(400, 'Tidak dapat mengubah status yang sudah selesai.');
            }

            $disposisi->update(['status' => $request->status]);

            $surat = SuratMasuk::with('disposisis')->findOrFail($disposisi->surat_masuk_id);
            $adaBelumSelesai = $surat->disposisis()->where('status', '!=', 'Selesai')->exists();

            $surat->update(['status' => $adaBelumSelesai ? 'Diproses' : 'Selesai']);

            logAktivitas(
                'Ubah Status Disposisi',
                'Disposisi',
                'Disposisi',
                $disposisi->id,
                'Status disposisi menjadi: ' . $request->status
            );
        });

        return back()->with('success', 'Status disposisi berhasil diperbarui.');
    }
}
