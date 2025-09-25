<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use  HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'nomor_telepon',
        'password',
        'role',
        'kelurahan_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if the user is a super admin
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super-admin';
    }

    /**
     * Check if the user is a masyarakat (citizen)
     */
    public function isMasyarakat(): bool
    {
        return $this->role === 'masyarakat';
    }

    /**
     * Check if the user is a babinsa
     */
    public function isBabinsa(): bool
    {
        return $this->role === 'babinsa';
    }

    /**
     * Get the kelurahan associated with the user
     */
    public function kelurahan(): BelongsTo
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
            'kelurahan_id', // Local key on users table
            'kecamatan_id' // Local key on kelurahan table
        );
    }

    /**
     * Get all pengaduans created by this user (for masyarakat)
     */
    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class);
    }
}
