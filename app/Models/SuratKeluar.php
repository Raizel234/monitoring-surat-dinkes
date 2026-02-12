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
        'tanggal_surat',
        'tujuan',          // tujuan instansi (utama)
        'perihal',
        'status',
        'jenis_surat',

        // metadata instansi
        'sifat_surat',
        'kategori_surat',
        'klasifikasi',
        'unit_pengolah',

        // tujuan pegawai metadata
        'tujuan_user_id',

        // nota dinas / dll
        'yth',
        'dari',
        'tembusan',
        'lampiran',
        'isi',

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
        'file_surat',
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

    public function tujuanUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'tujuan_user_id');
    }
}
