<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasukRecipient extends Model
{
    protected $table = 'surat_masuk_recipients'; // ✅ pastikan nama tabel benar

    protected $fillable = [
        'surat_masuk_id',
        'user_id',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    // ✅ RELASI KE USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ RELASI KE SURAT MASUK (INI YANG KAMU KURANG)
    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_masuk_id');
    }
}
