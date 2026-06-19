<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'judul', 'deskripsi', 'gambar', 'link',
        'urutan', 'is_active', 'user_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('urutan');
    }
}
