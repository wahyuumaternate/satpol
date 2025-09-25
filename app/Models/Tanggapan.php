<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tanggapan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pengaduan_id',
        'petugas_id',
        'isi_tanggapan',
    ];

    /**
     * Get the complaint that this response belongs to.
     */
    public function pengaduan(): BelongsTo
    {
        return $this->belongsTo(Pengaduan::class);
    }

    /**
     * Get the staff/admin who provided this response.
     */
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
    
    /**
     * Get the formatted date of when the response was created
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->created_at->format('d M Y, H:i');
    }
    
    /**
     * Get time elapsed since response was submitted
     */
    public function getElapsedTimeAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }
}