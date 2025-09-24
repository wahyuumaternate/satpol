<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduans';

    protected $fillable = [
        'kelurahan_id',
        'judul',
        'deskripsi',
        'kategori_ketertiban',
        'lokasi_kejadian',
        'waktu_kejadian',
        'nama_pelapor',
        'email_pelapor',
        'nomor_telepon',
        'alamat_pelapor',
        'foto_bukti',
        'status',
        'tanggapan',
        'tanggal_tanggapan',
        'kode_pengaduan',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pengaduan) {
            if (empty($pengaduan->kode_pengaduan)) {
                $pengaduan->kode_pengaduan = 'CKT-' . date('Ymd') . '-' . strtoupper(Str::random(5));
            }
        });
    }
    protected $casts = [
        'waktu_kejadian' => 'datetime',
        'tanggal_tanggapan' => 'datetime',
    ];

    /**
     * Get the kelurahan that owns the pengaduan
     */
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    /**
     * Get the kecamatan through kelurahan
     */
    public function kecamatan()
    {
        return $this->hasOneThrough(
            Kecamatan::class,
            Kelurahan::class,
            'id', // Foreign key on kelurahan table
            'id', // Foreign key on kecamatan table
            'kelurahan_id', // Local key on pengaduan table
            'kecamatan_id' // Local key on kelurahan table
        );
    }
}
