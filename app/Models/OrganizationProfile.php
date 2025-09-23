<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationProfile extends Model
{
    use HasFactory;

    protected $table = 'organization_profiles';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'description',
        'meta_title',
        'meta_description',
        'image',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scope untuk halaman aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk urutan
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    // Accessor untuk URL
    public function getUrlAttribute()
    {
        return url('/profile/' . $this->slug);
    }
}