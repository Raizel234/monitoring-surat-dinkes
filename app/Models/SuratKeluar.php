<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluars';

    protected $fillable = ['nomor_agenda', 'nomor_surat', 'tanggal_surat', 'tujuan', 'perihal', 'file_surat', 'status'];
}
