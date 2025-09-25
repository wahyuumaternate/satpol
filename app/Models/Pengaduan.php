<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',              // Added user_id for authentication
        'kelurahan_id',
        'judul',
        'deskripsi',
        'kategori_ketertiban',
        'lokasi_kejadian',
        'waktu_kejadian',
        'nama_pelapor',        // Will be filled from user data
        'email_pelapor',       // Will be filled from user data
        'nomor_telepon',
        'alamat_pelapor',
        'foto_bukti',
        'status',
        'tanggapan',           // This will be moved to a separate table later
        'tanggal_tanggapan',   // This will be moved to a separate table later
        'kode_pengaduan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'waktu_kejadian' => 'datetime',
        'tanggal_tanggapan' => 'datetime',
    ];

    /**
     * Boot function to automatically generate unique code
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pengaduan) {
            // Auto-generate kode_pengaduan if not provided
            if (empty($pengaduan->kode_pengaduan)) {
                $pengaduan->kode_pengaduan = 'CKT-' . date('Ymd') . '-' . strtoupper(Str::random(5));
            }

            // If user is authenticated, fill in user details automatically
            if (auth()->check() && empty($pengaduan->nama_pelapor)) {
                $user = auth()->user();
                $pengaduan->user_id = $user->id;
                $pengaduan->nama_pelapor = $user->name;
                $pengaduan->email_pelapor = $user->email;

                // If user has a profile with address, use that
                if (isset($user->alamat)) {
                    $pengaduan->alamat_pelapor = $user->alamat;
                }

                // If user has phone number in profile, use that
                if (isset($user->nomor_telepon) && empty($pengaduan->nomor_telepon)) {
                    $pengaduan->nomor_telepon = $user->nomor_telepon;
                }
            }
        });
    }

    /**
     * Get the user who submitted this complaint
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

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

    /**
     * Get responses to this complaint (for future implementation)
     */
    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class);
    }

    /**
     * Get the status color for display
     */
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'menunggu' => 'warning',
            'proses' => 'info',
            'selesai' => 'success',
            'ditolak' => 'danger',
            default => 'secondary',
        };
    }

    /**
     * Get formatted timestamp
     */
    public function getFormattedTimeAttribute()
    {
        if (!$this->waktu_kejadian) {
            return 'Tidak diketahui';
        }
        return $this->waktu_kejadian->format('d M Y, H:i');
    }

    /**
     * Get time elapsed since complaint was submitted
     */
    public function getElapsedTimeAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
