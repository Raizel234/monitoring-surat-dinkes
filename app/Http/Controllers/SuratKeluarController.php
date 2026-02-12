<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

use BaconQrCode\Writer;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;

class SuratKeluarController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;
        $status = $request->status;
        $from = $request->from;
        $to = $request->to;

        $query = SuratKeluar::query()->with('tujuanUser');

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('nomor_surat', 'like', "%$q%")
                    ->orWhere('tujuan', 'like', "%$q%")
                    ->orWhere('perihal', 'like', "%$q%")
                    ->orWhere('nomor_agenda', 'like', "%$q%");
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

        $data = $query->latest()->paginate(10);

        return view('surat_keluar.index', compact('data'));
    }

    public function create()
    {
        $pegawai = User::where('role', 'pegawai')
            ->orderBy('jabatan')
            ->orderBy('name')
            ->get(['id', 'name', 'instansi', 'jabatan']);

        // dipakai partial metadata untuk menentukan mode
        $modeMetadata = 'keluar';

        return view('surat_keluar.create', compact('pegawai', 'modeMetadata'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'tujuan' => 'required|string|max:255', // ✅ tujuan instansi
            'perihal' => 'required|string|max:255',
            'status' => 'nullable|string|max:50',

            'jenis_surat' => 'required|in:lembar_kendali,nota_dinas,surat_keputusan',

            // ✅ metadata
            'sifat_surat' => 'nullable|string|max:100',
            'kategori_surat' => 'nullable|string|max:255',
            'klasifikasi' => 'nullable|string|max:100',
            'unit_pengolah' => 'nullable|string|max:100',

            // ✅ tujuan pegawai metadata (dropdown)
            'tujuan_user_id' => 'nullable|exists:users,id',

            // nota dinas / dll
            'yth' => 'nullable|string|max:255',
            'dari' => 'nullable|string|max:255',
            'tembusan' => 'nullable|string',
            'lampiran' => 'nullable|string|max:255',
            'isi' => 'nullable|string',

            'rujukan_nomor' => 'nullable|string|max:255',
            'rujukan_perihal' => 'nullable|string|max:255',
            'nama_peneliti' => 'nullable|string|max:255',
            'npm' => 'nullable|string|max:255',
            'tentang' => 'nullable|string|max:255',
            'nama_lembaga' => 'nullable|string|max:255',

            'jabatan_ttd' => 'nullable|string|max:255',
            'nama_ttd' => 'nullable|string|max:255',
            'nip_ttd' => 'nullable|string|max:255',
            'pangkat_ttd' => 'nullable|string|max:255',

            'file_surat' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('file_surat')) {
            $validated['file_surat'] = $request->file('file_surat')->store('surat_keluar', 'public');
        }

        $validated['nomor_agenda'] = 'AGK-' . now()->format('YmdHis');

        $surat = SuratKeluar::create($validated);

        return redirect()->route('surat-keluar.show', $surat->id)
            ->with('success', 'Surat keluar berhasil disimpan.');
    }

    public function show(SuratKeluar $suratKeluar)
    {
        $data = $suratKeluar->load('tujuanUser');
        return view('surat_keluar.show', compact('data'));
    }

    public function edit(SuratKeluar $suratKeluar)
    {
        $data = $suratKeluar;

        $pegawai = User::where('role', 'pegawai')
            ->orderBy('jabatan')
            ->orderBy('name')
            ->get(['id', 'name', 'instansi', 'jabatan']);

        $modeMetadata = 'keluar';

        return view('surat_keluar.edit', compact('data', 'pegawai', 'modeMetadata'));
    }

    public function update(Request $request, SuratKeluar $suratKeluar)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'tujuan' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'status' => 'nullable|string|max:50',

            'jenis_surat' => 'required|in:lembar_kendali,nota_dinas,surat_keputusan',

            'sifat_surat' => 'nullable|string|max:100',
            'kategori_surat' => 'nullable|string|max:255',
            'klasifikasi' => 'nullable|string|max:100',
            'unit_pengolah' => 'nullable|string|max:100',

            'tujuan_user_id' => 'nullable|exists:users,id',

            'yth' => 'nullable|string|max:255',
            'dari' => 'nullable|string|max:255',
            'tembusan' => 'nullable|string',
            'lampiran' => 'nullable|string|max:255',
            'isi' => 'nullable|string',

            'rujukan_nomor' => 'nullable|string|max:255',
            'rujukan_perihal' => 'nullable|string|max:255',
            'nama_peneliti' => 'nullable|string|max:255',
            'npm' => 'nullable|string|max:255',
            'tentang' => 'nullable|string|max:255',
            'nama_lembaga' => 'nullable|string|max:255',

            'jabatan_ttd' => 'nullable|string|max:255',
            'nama_ttd' => 'nullable|string|max:255',
            'nip_ttd' => 'nullable|string|max:255',
            'pangkat_ttd' => 'nullable|string|max:255',

            'file_surat' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('file_surat')) {
            if ($suratKeluar->file_surat) {
                Storage::disk('public')->delete($suratKeluar->file_surat);
            }
            $validated['file_surat'] = $request->file('file_surat')->store('surat_keluar', 'public');
        }

        $suratKeluar->update($validated);

        return redirect()->route('surat-keluar.show', $suratKeluar->id)
            ->with('success', 'Surat keluar berhasil diupdate.');
    }

    public function destroy(SuratKeluar $suratKeluar)
    {
        if ($suratKeluar->file_surat) {
            Storage::disk('public')->delete($suratKeluar->file_surat);
        }

        $suratKeluar->delete();

        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar dihapus.');
    }

    public function cetak(SuratKeluar $suratKeluar, string $template)
    {
        $allowed = ['lembar_kendali', 'nota_dinas', 'surat_keputusan'];
        abort_unless(in_array($template, $allowed), 404);

        $instansi = [
            'pemda' => 'PEMERINTAH KABUPATEN SUMENEP',
            'nama' => 'DINAS KESEHATAN, PENGENDALIAN PENDUDUK DAN KELUARGA BERENCANA',
            'alamat' => 'Jl. Jokotole No. 05 Telp. (0328) 662122',
            'telp' => '(0328) 662122',
            'email' => 'dkppkbksumenep@gmail.com',
            'kota' => 'Sumenep',
            'logo' => public_path('images/avatar/Lambang_Kabupaten_Sumenep.png'),
        ];

        $viewMap = [
            'lembar_kendali' => 'pdf.surat_keluar.lembar_kendali',
            'nota_dinas' => 'pdf.surat_keluar.nota_dinas',
            'surat_keputusan' => 'pdf.surat_keluar.surat_keputusan',
        ];

        $qrUrl = route('verifikasi.surat_keluar', $suratKeluar->id);

        $renderer = new ImageRenderer(new RendererStyle(160), new SvgImageBackEnd());
        $writer = new Writer($renderer);

        $qrSvgString = $writer->writeString($qrUrl);
        $qrSvg = 'data:image/svg+xml;base64,' . base64_encode($qrSvgString);

        $pdf = Pdf::loadView($viewMap[$template], [
            'instansi' => $instansi,
            'surat' => $suratKeluar,
            'tanggalCetak' => now()->translatedFormat('d F Y'),
            'qrUrl' => $qrUrl,
            'qrSvg' => $qrSvg,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream($template . '_' . $suratKeluar->id . '.pdf');
    }
}
