<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $fillable = [
        'judul', 'deskripsi', 'gambar', 'kategori',
        'is_publish', 'published_at', 'user_id',
    ];

    protected $casts = [
        'is_publish' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
