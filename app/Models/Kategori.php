<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['nama', 'slug', 'deskripsi', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    // Jika kategori memiliki banyak berita (relasi one-to-many)
    public function beritas()
    {
        return $this->hasMany(Berita::class);
    }
}
