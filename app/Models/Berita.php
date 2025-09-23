<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'penulis',
        'status',
        'tanggal_publish',
        'kategori_id',
        'excerpt',
        'tags',
        'views'
    ];

    protected $casts = [
        'tags' => 'array',
        'tanggal_publish' => 'datetime',
        'views' => 'integer'
    ];

    protected $dates = [
        'tanggal_publish'
    ];

    // Boot method untuk auto generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->judul);
            }
        });

        static::updating(function ($berita) {
            if ($berita->isDirty('judul') && empty($berita->slug)) {
                $berita->slug = Str::slug($berita->judul);
            }
        });
    }

    // Relationships
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->whereNotNull('tanggal_publish')
                    ->where('tanggal_publish', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeBySlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    // Accessors
    public function getFormattedTanggalPublishAttribute()
    {
        return $this->tanggal_publish ? $this->tanggal_publish->format('d M Y H:i') : null;
    }

    public function getShortContentAttribute()
    {
        return Str::limit(strip_tags($this->konten), 150);
    }

    public function getReadTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->konten));
        $readTime = ceil($wordCount / 200); // Asumsi 200 kata per menit
        return $readTime . ' menit';
    }

    // Mutators
    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = $value;
        if (empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }

    // Methods
    public function incrementViews()
    {
        $this->increment('views');
    }

    public function isPublished()
    {
        return $this->status === 'published' && 
               $this->tanggal_publish && 
               $this->tanggal_publish <= now();
    }

    public function isDraft()
    {
        return $this->status === 'draft';
    }

    public function publish()
    {
        $this->update([
            'status' => 'published',
            'tanggal_publish' => now()
        ]);
    }

    public function unpublish()
    {
        $this->update([
            'status' => 'draft',
            'tanggal_publish' => null
        ]);
    }
}