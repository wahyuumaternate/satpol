<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    protected $table = 'kelurahans';

    protected $fillable = [
        'kecamatan_id',
        'nama',
        'kode'
    ];

    /**
     * Get the kecamatan that owns the kelurahan
     */
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    /**
     * Get the pengaduans for the kelurahan
     */
    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class);
    }
}