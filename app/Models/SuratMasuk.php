<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuks';

    protected $fillable = ['nomor_agenda', 'nomor_surat', 'tanggal_surat', 'pengirim', 'perihal', 'file_surat', 'status'];

    public function disposisis()
    {
        return $this->hasMany(\App\Models\Disposisi::class);
    }
}
