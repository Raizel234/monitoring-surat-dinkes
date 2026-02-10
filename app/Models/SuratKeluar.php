<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SuratKeluar extends Model
{
    protected $table = 'surat_keluar';

    protected $fillable = [
        'nomor_agenda',
        'nomor_surat',
        'tanggal_keluar',
        'tujuan',
        'perihal',
        'status',
        'file_surat',

        'jenis_surat',
        'kategori_surat',
        'sifat_surat',
        'klasifikasi',
        'unit_pengolah',

        'yth',
        'dari',
        'tembusan',
        'tanggal_surat',
        'lampiran',
        'isi',

        // ✅ tambahan nota dinas
        'rujukan_nomor',
        'rujukan_perihal',
        'nama_peneliti',
        'npm',
        'tentang',
        'nama_lembaga',

        'jabatan_ttd',
        'nama_ttd',
        'nip_ttd',
        'pangkat_ttd',
        'qr_token',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->qr_token)) {
                $model->qr_token = (string) Str::uuid();
            }
        });
    }
}
