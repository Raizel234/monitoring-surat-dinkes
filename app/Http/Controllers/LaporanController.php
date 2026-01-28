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

        // ✅ supaya halaman view laporan juga bisa menampilkan filter (kalau kamu pakai di blade)
        $filters = [
            'q' => $request->q,
            'status' => $request->status,
            'from' => $request->from,
            'to' => $request->to,
            'tanggal_cetak' => now()->format('d M Y'),
        ];

        return view('laporan.surat_masuk', compact('data', 'filters'));
    }

    // =========================
    // B) LAPORAN SURAT KELUAR (VIEW)
    // =========================
    public function suratKeluar(Request $request)
    {
        $data = $this->suratKeluarQuery($request)->get();

        $filters = [
            'q' => $request->q,
            'status' => $request->status,
            'from' => $request->from,
            'to' => $request->to,
            'tanggal_cetak' => now()->format('d M Y'),
        ];

        return view('laporan.surat_keluar', compact('data', 'filters'));
    }

    // =========================
    // C) EXPORT PDF SURAT MASUK
    // =========================
    public function suratMasukPdf(Request $request)
    {
        $data = $this->suratMasukQuery($request)->get();

        // ✅ ini yang dipakai di pdf_surat_masuk.blade.php (nama harus sama: $filters)
        $filters = [
            'q' => $request->q,
            'status' => $request->status,
            'from' => $request->from,
            'to' => $request->to,
            'tanggal_cetak' => now()->format('d M Y'),
        ];

        $pdf = Pdf::loadView('laporan.pdf_surat_masuk', compact('data', 'filters'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('laporan-surat-masuk.pdf');
    }

    // =========================
    // D) EXPORT PDF SURAT KELUAR
    // =========================
    public function suratKeluarPdf(Request $request)
    {
        $data = $this->suratKeluarQuery($request)->get();

        $filters = [
            'q' => $request->q,
            'status' => $request->status,
            'from' => $request->from,
            'to' => $request->to,
            'tanggal_cetak' => now()->format('d M Y'),
        ];

        $pdf = Pdf::loadView('laporan.pdf_surat_keluar', compact('data', 'filters'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('laporan-surat-keluar.pdf');
    }

    // =========================
    // Helper Query (biar konsisten view & pdf)
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

        if ($status) $query->where('status', $status);

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

        if ($status) $query->where('status', $status);

        if ($from && $to) {
            $query->whereBetween('tanggal_surat', [$from, $to]);
        } elseif ($from) {
            $query->whereDate('tanggal_surat', '>=', $from);
        } elseif ($to) {
            $query->whereDate('tanggal_surat', '<=', $to);
        }

        return $query->latest();
    }
}
