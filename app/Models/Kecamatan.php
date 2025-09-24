<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatans';

    protected $fillable = [
        'nama',
        'kode'
    ];

    /**
     * Get the kelurahans for the kecamatan
     */
    public function kelurahans()
    {
        return $this->hasMany(Kelurahan::class);
    }

    /**
     * Get all pengaduans related to this kecamatan through kelurahans
     */
    public function pengaduans()
    {
        return $this->hasManyThrough(Pengaduan::class, Kelurahan::class);
    }
}