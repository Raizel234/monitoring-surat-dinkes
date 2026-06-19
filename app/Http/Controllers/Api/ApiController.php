<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\Disposisi;
use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Slider;
use App\Models\Halaman;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function suratMasuk(Request $request)
    {
        $query = SuratMasuk::with(['recipients.user', 'disposisis']);

        if ($request->q) {
            $query->where(function ($q) use ($request) {
                $q->where('nomor_surat', 'like', "%{$request->q}%")
                    ->orWhere('pengirim', 'like', "%{$request->q}%")
                    ->orWhere('perihal', 'like', "%{$request->q}%");
            });
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }

        return response()->json([
            'success' => true,
            'data' => $query->latest()->paginate($request->per_page ?? 15),
        ]);
    }

    public function suratMasukDetail($id)
    {
        $data = SuratMasuk::with(['recipients.user', 'disposisis'])->findOrFail($id);
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function suratKeluar(Request $request)
    {
        $query = SuratKeluar::with('tujuanUser');

        if ($request->q) {
            $query->where(function ($q) use ($request) {
                $q->where('nomor_surat', 'like', "%{$request->q}%")
                    ->orWhere('tujuan', 'like', "%{$request->q}%")
                    ->orWhere('perihal', 'like', "%{$request->q}%");
            });
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }

        return response()->json([
            'success' => true,
            'data' => $query->latest()->paginate($request->per_page ?? 15),
        ]);
    }

    public function suratKeluarDetail($id)
    {
        $data = SuratKeluar::with('tujuanUser')->findOrFail($id);
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function stats()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'surat_masuk' => SuratMasuk::count(),
                'surat_keluar' => SuratKeluar::count(),
                'surat_diproses' => SuratMasuk::where('status', 'Diproses')->count(),
                'surat_selesai' => SuratMasuk::where('status', 'Selesai')->count(),
                'disposisi_menunggu' => Disposisi::where('status', 'Menunggu')->count(),
                'disposisi_diproses' => Disposisi::where('status', 'Diproses')->count(),
                'disposisi_selesai' => Disposisi::where('status', 'Selesai')->count(),
            ],
        ]);
    }

    public function activityLogs()
    {
        return response()->json([
            'success' => true,
            'data' => ActivityLog::with('user')->latest()->paginate(20),
        ]);
    }

    public function users()
    {
        return response()->json([
            'success' => true,
            'data' => User::select('id', 'name', 'email', 'role', 'instansi', 'jabatan')->get(),
        ]);
    }

    public function verifikasiSuratMasuk($id)
    {
        $data = SuratMasuk::with('disposisis')->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => [
                'nomor_agenda' => $data->nomor_agenda,
                'nomor_surat' => $data->nomor_surat,
                'tanggal_surat' => $data->tanggal_surat,
                'pengirim' => $data->pengirim,
                'perihal' => $data->perihal,
                'status' => $data->status,
                'verified' => true,
            ],
        ]);
    }

    public function verifikasiSuratKeluar($token)
    {
        $data = SuratKeluar::where('qr_token', $token)->firstOrFail();
        return response()->json([
            'success' => true,
            'data' => [
                'nomor_agenda' => $data->nomor_agenda,
                'nomor_surat' => $data->nomor_surat,
                'tanggal_surat' => $data->tanggal_surat,
                'tujuan' => $data->tujuan,
                'perihal' => $data->perihal,
                'status' => $data->status,
                'verified' => true,
            ],
        ]);
    }

    public function berita()
    {
        return response()->json([
            'success' => true,
            'data' => Berita::where('is_publish', 1)->latest()->paginate(10),
        ]);
    }

    public function galeri()
    {
        return response()->json([
            'success' => true,
            'data' => Galeri::where('is_publish', 1)->latest()->paginate(12),
        ]);
    }

    public function sliders()
    {
        return response()->json([
            'success' => true,
            'data' => Slider::active()->get(),
        ]);
    }

    public function halaman($kategori = null)
    {
        $query = Halaman::where('is_publish', true);
        if ($kategori) {
            $query->where('kategori', $kategori);
        }
        return response()->json([
            'success' => true,
            'data' => $query->get(),
        ]);
    }
}
