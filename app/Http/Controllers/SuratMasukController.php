<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use App\Models\Disposisi;
use Carbon\Carbon;
use App\Models\ActivityLog;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

use App\Models\User; // ✅ TAMBAH INI

use BaconQrCode\Writer;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;

class SuratMasukController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;
        $status = $request->status;
        $from = $request->from;
        $to = $request->to;

        $query = SuratMasuk::query()->withCount('disposisis');

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('nomor_surat', 'like', "%$q%")
                    ->orWhere('pengirim', 'like', "%$q%")
                    ->orWhere('perihal', 'like', "%$q%");
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

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
        // ✅ ambil list pegawai untuk dropdown tujuan (klasifikasi)
        $pegawai = User::where('role', 'pegawai')
            ->orderBy('jabatan')
            ->orderBy('name')
            ->get(['id', 'name', 'instansi', 'jabatan']);

        return view('surat_masuk.create', compact('pegawai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required',
            'pengirim' => 'required',
            'perihal' => 'required',
            'file_surat' => 'nullable|mimes:pdf|max:5060',

            'sifat_surat' => 'nullable|in:Biasa,Penting,Rahasia',
            'jenis_surat' => 'nullable|string|max:100',
            'klasifikasi' => 'nullable|string|max:100',
            'unit_pengolah' => 'nullable|string|max:100',
        ]);

        $file = null;
        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat')->store('surat', 'public');
        }

        $tahun = Carbon::parse($request->tanggal_surat)->year;
        $last = SuratMasuk::whereYear('tanggal_surat', $tahun)->orderBy('id', 'desc')->first();
        $urutan = $last ? ((int) substr($last->nomor_agenda, 4, 4)) + 1 : 1;

        $bulanRomawi = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII',
        ];

        $bulan = $bulanRomawi[Carbon::parse($request->tanggal_surat)->month];
        $nomorAgenda = 'AGM-' . str_pad($urutan, 4, '0', STR_PAD_LEFT) . '/' . $bulan . '/' . $tahun;

        $surat = SuratMasuk::create([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'pengirim' => $request->pengirim,
            'perihal' => $request->perihal,
            'file_surat' => $file,
            'status' => 'Diterima',

            'sifat_surat' => $request->sifat_surat,
            'jenis_surat' => $request->jenis_surat,
            'klasifikasi' => $request->klasifikasi,
            'unit_pengolah' => $request->unit_pengolah,
        ]);

        logAktivitas(
            'Tambah Surat Masuk',
            'Surat Masuk',
            'SuratMasuk',
            $surat->id,
            'Menambahkan surat masuk | Agenda: ' . $nomorAgenda . ' | Nomor Surat: ' . $surat->nomor_surat
        );

        return redirect()->route('surat-masuk.index')->with('success', 'Surat berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = SuratMasuk::findOrFail($id);

        // ✅ dropdown pegawai tetap ada di halaman edit
        $pegawai = User::where('role', 'pegawai')
            ->orderBy('jabatan')
            ->orderBy('name')
            ->get(['id', 'name', 'instansi', 'jabatan']);

        return view('surat_masuk.edit', compact('data', 'pegawai'));
    }

    public function update(Request $request, $id)
    {
        $data = SuratMasuk::findOrFail($id);

        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'status' => 'nullable|in:Diterima,Diproses,Selesai',
            'file_surat' => 'nullable|mimes:pdf|max:5060',

            'sifat_surat' => 'nullable|in:Biasa,Penting,Rahasia',
            'jenis_surat' => 'nullable|string|max:100',
            'klasifikasi' => 'nullable|string|max:100',
            'unit_pengolah' => 'nullable|string|max:150',
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

            'sifat_surat' => $request->sifat_surat,
            'jenis_surat' => $request->jenis_surat,
            'klasifikasi' => $request->klasifikasi,
            'unit_pengolah' => $request->unit_pengolah,
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

        $data->update(['status' => 'Diproses']);

        return redirect()->route('surat-masuk.index')->with('success', 'Disposisi berhasil dibuat');
    }

    public function show($id)
    {
        $data = SuratMasuk::with('disposisis')->findOrFail($id);
        $logs = ActivityLog::where('target_type', 'SuratMasuk')->where('target_id', $data->id)->orderBy('created_at')->get();
        return view('surat_masuk.show', compact('data', 'logs'));
    }

    public function disposisiPdf($id)
    {
        $surat = SuratMasuk::with(['disposisis' => function ($q) {
            $q->latest();
        }])->findOrFail($id);

        $instansi = [
            'nama' => 'DINAS KESEHATAN KABUPATEN SUMENEP',
            'alamat' => 'Jl. Jokotole No. 05 Sumenep Jawa Timur',
            'telp' => '(0328) 662122',
            'email' => 'dinkessumenep@gmail.com',
            'logo' => public_path('images/avatar/Lambang_Kabupaten_Sumenep.png'),
        ];

        $ttd = [
            'jabatan1' => 'Kepala Dinas Kesehatan',
            'nama1' => 'drg. Ellya Fardasah. M.Kes',
            'nip1' => 'NIP. ____________________',

            'jabatan2' => 'Sekretaris',
            'nama2' => 'Slamet Boedihardjo, S.Sos., M.Si',
            'nip2' => 'NIP. ____________________',
        ];

        $pdf = Pdf::loadView('surat_masuk.pdf_disposisi', [
            'surat' => $surat,
            'instansi' => $instansi,
            'ttd' => $ttd,
            'tanggalCetak' => now()->translatedFormat('d F Y'),
        ])->setPaper('A4', 'portrait');

        $agenda = $surat->nomor_agenda ?? 'SURAT-' . $surat->id;
        $safeAgenda = preg_replace('/[\/\\\\\:\*\?\"\<\>\|]/', '-', $agenda);
        $safeAgenda = trim($safeAgenda);
        $safeAgenda = preg_replace('/\s+/', '-', $safeAgenda);

        $filename = "lembar-disposisi-{$safeAgenda}-{$surat->id}.pdf";
        return $pdf->download($filename);
    }

    public function lembarKendaliPdf($id)
    {
        $surat = SuratMasuk::with('disposisis')->findOrFail($id);

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

        $safeAgenda = preg_replace('/[\/\\\\]+/', '-', (string) ($surat->nomor_agenda ?? 'AGENDA'));
        $safeNoSurat = preg_replace('/[\/\\\\]+/', '-', (string) $surat->nomor_surat);

        $qrUrl = route('verifikasi.surat_masuk', $surat->id);

        $renderer = new ImageRenderer(new RendererStyle(160), new SvgImageBackEnd());
        $writer = new Writer($renderer);
        $qrSvgString = $writer->writeString($qrUrl);
        $qrSvg = 'data:image/svg+xml;base64,' . base64_encode($qrSvgString);

        $pdf = Pdf::loadView('surat_masuk.pdf_lembar_kendali', [
            'surat' => $surat,
            'instansi' => $instansi,
            'ttd' => $ttd,
            'tanggalCetak' => now()->translatedFormat('d F Y'),
            'qrUrl' => $qrUrl,
            'qrSvg' => $qrSvg,
        ])->setPaper('A4', 'portrait');

        return $pdf->download("lembar-kendali-{$safeAgenda}-{$safeNoSurat}.pdf");
    }
}
