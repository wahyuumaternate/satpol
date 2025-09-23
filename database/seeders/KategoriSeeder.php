<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->insert([
            [
                'nama' => 'Teknologi',
                'slug' => Str::slug('Teknologi'),
                'deskripsi' => 'Kategori untuk artikel atau produk seputar teknologi.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Desain',
                'slug' => Str::slug('Desain'),
                'deskripsi' => 'Kategori berisi konten tentang desain grafis, UI/UX, dan kreativitas.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Bisnis',
                'slug' => Str::slug('Bisnis'),
                'deskripsi' => 'Kategori seputar bisnis, manajemen, dan pengembangan usaha.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
