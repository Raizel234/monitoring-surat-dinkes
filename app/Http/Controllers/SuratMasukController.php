<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\SuratMasukRecipient;
use App\Models\Disposisi;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

use BaconQrCode\Writer;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;

class SuratMasukController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user(); // ✅ fix
        $q = $request->q;
        $status = $request->status;
        $from = $request->from;
        $to = $request->to;

        $query = SuratMasuk::query()->withCount('disposisis');

        // ✅ admin lihat semua, pegawai hanya surat miliknya
        if ($user && ($user->role ?? '') === 'pegawai') {
            $query->whereHas('recipients', function ($r) use ($user) {
                $r->where('user_id', $user->id);
            });

            // load recipient milik user login saja (buat badge read/unread)
            $query->with([
                'recipients' => function ($r) use ($user) {
                    $r->where('user_id', $user->id);
                },
                'recipients.user',
            ]);
        } else {
            // admin load semua recipients
            $query->with(['recipients.user']);
        }

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
        // ✅ INI YANG DIPAKAI PARTIAL: $pegawai (bukan $pegawaiList)
        $pegawai = User::where('role', 'pegawai')
            ->orderBy('jabatan')
            ->orderBy('name')
            ->get(['id', 'name', 'instansi', 'jabatan']);

        return view('surat_masuk.create', compact('pegawai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'file_surat' => 'nullable|mimes:pdf|max:5060',

            'sifat_surat' => 'nullable|in:Biasa,Penting,Rahasia',
            'kategori_surat' => 'nullable|string|max:100',
            'unit_pengolah' => 'nullable|string|max:150',

            // ✅ tujuan pegawai = tabel recipients
            'tujuan_user_id' => 'required|exists:users,id',
        ]);

        // upload file
        $file = null;
        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat')->store('surat', 'public');
        }

        // generate nomor agenda otomatis
        $tahun = Carbon::parse($request->tanggal_surat)->year;
        $last = SuratMasuk::whereYear('tanggal_surat', $tahun)->orderBy('id', 'desc')->first();

        $urutan = $last ? ((int) substr((string)$last->nomor_agenda, 4, 4)) + 1 : 1;

        $bulanRomawi = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII',
        ];
        $bulan = $bulanRomawi[Carbon::parse($request->tanggal_surat)->month];
        $nomorAgenda = 'AGM-' . str_pad($urutan, 4, '0', STR_PAD_LEFT) . '/' . $bulan . '/' . $tahun;

        // simpan surat
        $surat = SuratMasuk::create([
            'nomor_agenda'   => $nomorAgenda,
            'nomor_surat'    => $request->nomor_surat,
            'tanggal_surat'  => $request->tanggal_surat,
            'pengirim'       => $request->pengirim,
            'perihal'        => $request->perihal,
            'file_surat'     => $file,
            'status'         => $request->status ?? 'Diterima',

            'sifat_surat'    => $request->sifat_surat,
            'kategori_surat' => $request->kategori_surat,
            'unit_pengolah'  => $request->unit_pengolah,

            // NOTE: "klasifikasi" kalau masih kamu pakai untuk teks tujuan klasifikasi
            'klasifikasi'    => $request->klasifikasi,
        ]);

        // simpan penerima
        SuratMasukRecipient::create([
            'surat_masuk_id' => $surat->id,
            'user_id'        => $request->tujuan_user_id,
            'read_at'        => null,
        ]);

        // log (pakai helper kamu)
        logAktivitas(
            'Tambah Surat Masuk',
            'Surat Masuk',
            'SuratMasuk',
            $surat->id,
            'Menambahkan surat masuk | Agenda: ' . $nomorAgenda . ' | Nomor Surat: ' . $surat->nomor_surat
        );

        return redirect()
            ->route('surat-masuk.index')
            ->with('success', 'Surat berhasil ditambahkan & dikirim ke pegawai tujuan.');
    }

    public function edit($id)
    {
        $data = SuratMasuk::with('recipients')->findOrFail($id);

        $pegawai = User::where('role', 'pegawai')
            ->orderBy('jabatan')
            ->orderBy('name')
            ->get(['id', 'name', 'instansi', 'jabatan']);

        $tujuanUserId = $data->recipients()->value('user_id');

        return view('surat_masuk.edit', compact('data', 'pegawai', 'tujuanUserId'));
    }

    public function update(Request $request, $id)
    {
        $data = SuratMasuk::with('recipients')->findOrFail($id);

        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'status' => 'nullable|in:Diterima,Diproses,Selesai',
            'file_surat' => 'nullable|mimes:pdf|max:5060',

            'sifat_surat' => 'nullable|in:Biasa,Penting,Rahasia',
            'kategori_surat' => 'nullable|string|max:100',
            'unit_pengolah' => 'nullable|string|max:150',

            'tujuan_user_id' => 'required|exists:users,id',
        ]);

        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat')->store('surat', 'public');
            $data->file_surat = $file;
        }

        $data->update([
            'nomor_surat'    => $request->nomor_surat,
            'tanggal_surat'  => $request->tanggal_surat,
            'pengirim'       => $request->pengirim,
            'perihal'        => $request->perihal,
            'status'         => $request->status ?? $data->status,

            'sifat_surat'    => $request->sifat_surat,
            'kategori_surat' => $request->kategori_surat,
            'unit_pengolah'  => $request->unit_pengolah,

            'klasifikasi'    => $request->klasifikasi,
        ]);

        // update penerima
        SuratMasukRecipient::updateOrCreate(
            ['surat_masuk_id' => $data->id],
            ['user_id' => $request->tujuan_user_id]
        );

        logAktivitas(
            'Edit Surat Masuk',
            'Surat Masuk',
            'SuratMasuk',
            $data->id,
            'Mengubah surat masuk nomor: ' . $data->nomor_surat
        );

        return redirect()->route('surat-masuk.index')->with('success', 'Data surat berhasil diperbarui.');
    }

    public function show($id)
    {
        $user = Auth::user();
        $data = SuratMasuk::with(['disposisis', 'recipients.user'])->findOrFail($id);

        // auto tandai dibaca jika pegawai buka detail suratnya
        if ($user && ($user->role ?? '') === 'pegawai') {
            SuratMasukRecipient::where('surat_masuk_id', $data->id)
                ->where('user_id', $user->id)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);
        }

        $logs = ActivityLog::where('target_type', 'SuratMasuk')
            ->where('target_id', $data->id)
            ->orderBy('created_at')
            ->get();

        return view('surat_masuk.show', compact('data', 'logs'));
    }

    public function destroy(SuratMasuk $surat_masuk)
    {
        logAktivitas(
            'Hapus Surat Masuk',
            'Surat Masuk',
            'SuratMasuk',
            $surat_masuk->id,
            'Menghapus surat masuk nomor: ' . $surat_masuk->nomor_surat
        );

        $surat_masuk->delete();
        return redirect()->route('surat-masuk.index');
    }

    // =====================
    // DISPOSISI
    // =====================

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

        logAktivitas(
            'Buat Disposisi',
            'Disposisi',
            'Disposisi',
            $disp->id,
            'Disposisi untuk surat: ' . $data->nomor_surat . ' tujuan: ' . $disp->tujuan
        );

        $data->update(['status' => 'Diproses']);

        return redirect()->route('surat-masuk.index')->with('success', 'Disposisi berhasil dibuat');
    }

    // =====================
    // PDF (punya kamu)
    // =====================

    public function disposisiPdf($id)
    {
        $surat = SuratMasuk::with(['disposisis' => fn($q) => $q->latest()])->findOrFail($id);

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
        $safeAgenda = preg_replace('/\s+/', '-', trim($safeAgenda));

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

        $safeAgenda = preg_replace('/[\/\\\\]+/', '-', (string)($surat->nomor_agenda ?? 'AGENDA'));
        $safeNoSurat = preg_replace('/[\/\\\\]+/', '-', (string)$surat->nomor_surat);

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

    // =====================
    // TOGGLE READ (RECIPIENT)
    // =====================

    public function toggleReadRecipient($suratId, $recipientId)
    {
        $recipient = SuratMasukRecipient::where('surat_masuk_id', $suratId)
            ->where('id', $recipientId)
            ->firstOrFail();

        // hanya penerima sendiri
        if (Auth::id() !== (int)$recipient->user_id) {
            abort(403, 'Tidak punya akses.');
        }

        $recipient->read_at = $recipient->read_at ? null : now();
        $recipient->save();

        return back()->with('success', 'Status dibaca berhasil diubah.');
    }
}
