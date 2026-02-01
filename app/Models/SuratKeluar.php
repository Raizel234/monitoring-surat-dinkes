<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluars';

    protected $fillable = [
        'nomor_agenda',
        'nomor_surat',
        'tanggal_surat',
        'tujuan',
        'perihal',
        'file_surat',
        'status',

        // metadata instansi
        'sifat_surat',
        'jenis_surat',
        'klasifikasi',
        'unit_pengolah',
    ];

    protected static function booted()
    {
        static::creating(function ($surat) {
            if (!empty($surat->nomor_agenda)) {
                return;
            }

            $year = date('Y', strtotime($surat->tanggal_surat ?? now()));
            $month = date('n', strtotime($surat->tanggal_surat ?? now()));

            $romanMonth = self::toRoman($month);
            $prefix = 'AGK'; // Agenda Keluar

            $last = DB::table('surat_keluars')->whereYear('tanggal_surat', $year)->whereNotNull('nomor_agenda')->orderByDesc('id')->value('nomor_agenda');

            $nextNumber = 1;

            if ($last) {
                if (preg_match('/^' . $prefix . '\-(\d{4})\//', $last, $m)) {
                    $nextNumber = ((int) $m[1]) + 1;
                }
            }

            $surat->nomor_agenda = sprintf('%s-%04d/%s/%s', $prefix, $nextNumber, $romanMonth, $year);
        });
    }

    private static function toRoman($month)
    {
        $map = [
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
        return $map[(int) $month] ?? 'I';
    }
}
