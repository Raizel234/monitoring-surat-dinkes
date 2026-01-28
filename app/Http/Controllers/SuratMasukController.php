<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use App\Models\Disposisi;
use Carbon\Carbon;
use App\Models\ActivityLog;

class SuratMasukController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q; // keyword
        $status = $request->status; // status surat masuk
        $from = $request->from; // tanggal awal
        $to = $request->to; // tanggal akhir

        $query = SuratMasuk::query()->withCount('disposisis');

        // ✅ Search: nomor surat / pengirim / perihal
        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('nomor_surat', 'like', "%$q%")
                    ->orWhere('pengirim', 'like', "%$q%")
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

        return view('surat_masuk.index', compact('data'));
    }

    public function create()
    {
        return view('surat_masuk.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'nomor_surat' => 'required',
        'tanggal_surat' => 'required',
        'pengirim' => 'required',
        'perihal' => 'required',
        'file_surat' => 'nullable|mimes:pdf|max:2048',
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

    $last = SuratMasuk::whereYear('tanggal_surat', $tahun)
        ->orderBy('id', 'desc')
        ->first();

    $urutan = $last
        ? ((int) substr($last->nomor_agenda, 4, 4)) + 1
        : 1;

    $bulanRomawi = [
        1=>'I',2=>'II',3=>'III',4=>'IV',5=>'V',6=>'VI',
        7=>'VII',8=>'VIII',9=>'IX',10=>'X',11=>'XI',12=>'XII'
    ];

    $bulan = $bulanRomawi[Carbon::parse($request->tanggal_surat)->month];
    $nomorAgenda = 'AGM-' . str_pad($urutan, 4, '0', STR_PAD_LEFT) . '/' . $bulan . '/' . $tahun;

    // ===============================
    // 💾 SIMPAN DATA
    // ===============================
    $surat = SuratMasuk::create([
        'nomor_agenda' => $nomorAgenda,
        'nomor_surat' => $request->nomor_surat,
        'tanggal_surat' => $request->tanggal_surat,
        'pengirim' => $request->pengirim,
        'perihal' => $request->perihal,
        'file_surat' => $file,
        'status' => 'Diterima',
    ]);

    // ===============================
    // 📝 LOG AKTIVITAS
    // ===============================
    logAktivitas(
        'Tambah Surat Masuk',
        'Surat Masuk',
        'SuratMasuk',
        $surat->id,
        'Menambahkan surat masuk | Agenda: '.$nomorAgenda.' | Nomor Surat: '.$surat->nomor_surat
    );

    return redirect()->route('surat-masuk.index')
        ->with('success', 'Surat berhasil ditambahkan');
}


    public function edit($id)
    {
        $data = SuratMasuk::findOrFail($id);
        return view('surat_masuk.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = SuratMasuk::findOrFail($id);

        // ✅ (opsional) validasi update agar lebih aman
        $request->validate([
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required',
            'pengirim' => 'required',
            'perihal' => 'required',
            'status' => 'nullable|in:Diterima,Diproses,Selesai',
            'file_surat' => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat')->store('surat', 'public');
            $data->file_surat = $file;
        }

        $data->update([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'pengirim' => $request->pengirim,
            'perihal' => $request->perihal,
            'status' => $request->status ?? $data->status,
        ]);
        logAktivitas('Edit Surat Masuk', 'Surat Masuk', 'SuratMasuk', $data->id, 'Mengubah surat masuk nomor: ' . $data->nomor_surat);

        return redirect()->route('surat-masuk.index')->with('success', 'Data surat berhasil diperbarui');
    }

    public function destroy(SuratMasuk $surat_masuk)
    {
        logAktivitas('Hapus Surat Masuk', 'Surat Masuk', 'SuratMasuk', $surat_masuk->id, 'Menghapus surat masuk nomor: ' . $surat_masuk->nomor_surat);

        $surat_masuk->delete();
        return redirect()->route('surat-masuk.index');
    }

    public function disposisiForm($id)
    {
        // ✅ WAJIB: supaya Riwayat Disposisi tampil di disposisi.blade.php
        $data = SuratMasuk::with('disposisis')->findOrFail($id);
        return view('surat_masuk.disposisi', compact('data'));
    }

    public function disposisiStore(Request $request, $id)
    {
        $data = SuratMasuk::findOrFail($id);

        $request->validate([
            'tujuan' => 'required',
            'instruksi' => 'nullable',
            'prioritas' => 'required|in:Rendah,Sedang,Tinggi',
            'batas_waktu' => 'nullable|date',
        ]);

        $disp = Disposisi::create([
            'surat_masuk_id' => $data->id,
            'tujuan' => $request->tujuan,
            'instruksi' => $request->instruksi,
            'prioritas' => $request->prioritas,
            'batas_waktu' => $request->batas_waktu,
            'status' => 'Menunggu',
        ]);

        logAktivitas('Buat Disposisi', 'Disposisi', 'Disposisi', $disp->id, 'Disposisi untuk surat: ' . $data->nomor_surat . ' tujuan: ' . $disp->tujuan);

        // update status surat masuk jadi Diproses saat didisposisikan
        $data->update(['status' => 'Diproses']);

        return redirect()->route('surat-masuk.index')->with('success', 'Disposisi berhasil dibuat');
    }
    public function show($id)
{
    $data = SuratMasuk::with('disposisis')->findOrFail($id);

    // ambil log khusus surat ini
    $logs = ActivityLog::where('target_type', 'SuratMasuk')
        ->where('target_id', $data->id)
        ->orderBy('created_at')
        ->get();

    return view('surat_masuk.show', compact('data', 'logs'));
}
}
