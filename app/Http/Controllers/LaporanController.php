<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    // =========================
    // A) LAPORAN SURAT MASUK (VIEW)
    // =========================
    public function suratMasuk(Request $request)
    {
        $data = $this->suratMasukQuery($request)->get();
        return view('laporan.surat_masuk', compact('data'));
    }

    // =========================
    // B) LAPORAN SURAT KELUAR (VIEW)
    // =========================
    public function suratKeluar(Request $request)
    {
        $data = $this->suratKeluarQuery($request)->get();
        return view('laporan.surat_keluar', compact('data'));
    }

    // =========================
    // C) EXPORT PDF SURAT MASUK
    // =========================
    public function suratMasukPdf(Request $request)
    {
        $data = $this->suratMasukQuery($request)->get();

        $instansi = $this->getInstansi();
        $ttd      = $this->getTTD();

        $filters = [
            'q'      => $request->q,
            'status' => $request->status,
            'from'   => $request->from,
            'to'     => $request->to,
        ];

        $verifBaseUrl = url('/verifikasi/surat-masuk');

        $pdf = Pdf::loadView('laporan.pdf_surat_masuk', [
            'data'          => $data,
            'filters'       => $filters,
            'instansi'      => $instansi,
            'ttd'           => $ttd,
            'tanggalCetak'  => now()->translatedFormat('d F Y'),
            'verifBaseUrl'  => $verifBaseUrl,
        ])->setPaper('A4', 'portrait');

        return $pdf->download('laporan-surat-masuk.pdf');
    }

    // =========================
    // D) EXPORT PDF SURAT KELUAR
    // =========================
    public function suratKeluarPdf(Request $request)
    {
        $data = $this->suratKeluarQuery($request)->get();

        $instansi = $this->getInstansi();
        $ttd      = $this->getTTD();

        $filters = [
            'q'      => $request->q,
            'status' => $request->status,
            'from'   => $request->from,
            'to'     => $request->to,
        ];

        $verifBaseUrl = url('/verifikasi/surat-keluar');

        $pdf = Pdf::loadView('laporan.pdf_surat_keluar', [
            'data'          => $data,
            'filters'       => $filters,
            'instansi'      => $instansi,
            'ttd'           => $ttd,
            'tanggalCetak'  => now()->translatedFormat('d F Y'),
            'verifBaseUrl'  => $verifBaseUrl,
        ])->setPaper('A4', 'portrait');

        return $pdf->download('laporan-surat-keluar.pdf');
    }

    // =========================
    // Helper Query
    // =========================
    private function suratMasukQuery(Request $request)
    {
        $q      = $request->q;
        $status = $request->status;
        $from   = $request->from;
        $to     = $request->to;

        $query = SuratMasuk::query();

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

        return $query->latest();
    }

    private function suratKeluarQuery(Request $request)
    {
        $q      = $request->q;
        $status = $request->status;
        $from   = $request->from;
        $to     = $request->to;

        $query = SuratKeluar::query();

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('nomor_surat', 'like', "%$q%")
                    ->orWhere('tujuan', 'like', "%$q%")
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

        return $query->latest();
    }

    // =========================
    // Helper Instansi + TTD
    // =========================
    private function getInstansi(): array
    {
        return [
            'nama'   => 'DINAS KESEHATAN KABUPATEN SUMENEP',
            'alamat' => 'Jl. Jokotole No. 05 Sumenep Jawa Timur',
            'telp'   => '(0328) 662122',
            'email'  => 'dinkessumenep@gmail.com',
            'logo'   => public_path('images/avatar/Lambang_Kabupaten_Sumenep.png'),

            // ✅ STAMPEL DIGITAL (PNG)
            'stempel' => public_path('images/stempel/stempel_dinkes.png'),
        ];
    }

    private function getTTD(): array
    {
        return [
            'jabatan' => 'Kepala Dinas Kesehatan',
            'nama'    => 'drg. Ellya Fardasah. M.Kes',
            'nip'     => 'NIP. ____________________',

            // ✅ TTD DIGITAL (PNG)
            'ttd_img' => public_path('images/ttd/kepala_dinas.png'),
        ];
    }
}
