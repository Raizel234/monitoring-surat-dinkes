<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

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
            'file_surat' => 'nullable|mimes:pdf|max:5060',

            'sifat_surat' => 'nullable|in:Biasa,Penting,Rahasia',
            'jenis_surat' => 'nullable|string|max:100',
            'klasifikasi' => 'nullable|string|max:100',
            'unit_pengolah' => 'nullable|string|max:100',
        ]);

        // upload file
        $file = null;
        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat')->store('surat', 'public');
        }

        // ===============================
        // 🔢 GENERATE NOMOR AGENDA OTOMATIS
        // ===============================
        $tahun = Carbon::parse($request->tanggal_surat)->year;

        $last = SuratKeluar::whereYear('tanggal_surat', $tahun)->orderBy('id', 'desc')->first();

        $urutan = $last ? ((int) substr($last->nomor_agenda, 4, 4)) + 1 : 1;

        $bulanRomawi = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];

        $bulan = $bulanRomawi[Carbon::parse($request->tanggal_surat)->month];
        $nomorAgenda = 'AGK-' . str_pad($urutan, 4, '0', STR_PAD_LEFT) . '/' . $bulan . '/' . $tahun;

        // ===============================
        // 💾 SIMPAN DATA
        // ===============================
        $surat = SuratKeluar::create([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tujuan' => $request->tujuan,
            'perihal' => $request->perihal,
            'file_surat' => $file,
            'status' => $request->status,

            'sifat_surat' => $request->sifat_surat,
            'jenis_surat' => $request->jenis_surat,
            'klasifikasi' => $request->klasifikasi,
            'unit_pengolah' => $request->unit_pengolah,
        ]);

        // ===============================
        // 📝 LOG AKTIVITAS
        // ===============================
        logAktivitas('Tambah Surat Keluar', 'Surat Keluar', 'SuratKeluar', $surat->id, 'Menambahkan surat keluar | Agenda: ' . $nomorAgenda . ' | Nomor Surat: ' . $surat->nomor_surat);

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

        $request->validate([
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required',
            'tujuan' => 'required',
            'perihal' => 'required',
            'file_surat' => 'nullable|mimes:pdf|max:5060',

            'sifat_surat' => 'nullable|in:Biasa,Penting,Rahasia',
            'jenis_surat' => 'nullable|string|max:100',
            'klasifikasi' => 'nullable|string|max:100',
            'unit_pengolah' => 'nullable|string|max:100',
        ]);

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

            'sifat_surat' => $request->sifat_surat,
            'jenis_surat' => $request->jenis_surat,
            'klasifikasi' => $request->klasifikasi,
            'unit_pengolah' => $request->unit_pengolah,
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
    public function show($id)
    {
        $data = SuratKeluar::findOrFail($id);

        // Ambil timeline log aktivitas khusus surat keluar ini
        $timeline = \App\Models\ActivityLog::where('target_type', 'SuratKeluar')->where('target_id', $data->id)->latest()->get();

        return view('surat_keluar.show', compact('data', 'timeline'));
    }
    public function lembarKendaliPdf($id)
    {
        $surat = SuratKeluar::findOrFail($id);

        $instansi = [
            'nama' => 'DINAS KESEHATAN KABUPATEN SUMENEP',
            'alamat' => 'Jl. Jokotole No. 05 Sumenep Jawa Timur',
            'telp' => '(0328) 662122',
            'email' => 'dinkessumenep@gmail.com',
            'logo' => public_path('images/avatar/Lambang_Kabupaten_Sumenep.png'),
        ];

        $ttd = [
            'jabatan' => 'Sekretaris',
            'nama' => 'Slamet Boedihardjo, S.Sos., M.Si',
            'nip' => 'NIP. ____________________',
        ];

        // nama file aman (hindari / dan \ supaya tidak error)
        $safeAgenda = preg_replace('/[\/\\\\]+/', '-', (string) ($surat->nomor_agenda ?? 'AGENDA'));
        $safeNoSurat = preg_replace('/[\/\\\\]+/', '-', (string) $surat->nomor_surat);

        $pdf = Pdf::loadView('surat_keluar.pdf_lembar_kendali', [
            'surat' => $surat,
            'instansi' => $instansi,
            'ttd' => $ttd,
            'tanggalCetak' => now()->translatedFormat('d F Y'),
        ])->setPaper('A4', 'portrait');

        return $pdf->download("lembar-kendali-keluar-{$safeAgenda}-{$safeNoSurat}.pdf");
    }
}
