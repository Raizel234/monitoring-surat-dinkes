<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Halaman extends Model
{
    protected $table = 'halamans';
    protected $fillable = [
        'judul', 'slug', 'konten', 'gambar',
        'kategori', 'sub_kategori', 'is_publish', 'user_id',
    ];

    protected $casts = [
        'is_publish' => 'boolean',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
