<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationProfileSeeder extends Seeder
{
    public function run(): void
    {
        $profiles = [
            [
                'title' => 'Profil Reformer',
                'slug' => 'profil-reformer',
                'content' => '<p>Konten profil reformer...</p>',
                'description' => 'Halaman profil reformer',
                'sort_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tentang',
                'slug' => 'tentang',
                'content' => '<p>Konten tentang organisasi...</p>',
                'description' => 'Halaman tentang organisasi',
                'sort_order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tugas dan Fungsi',
                'slug' => 'tugas-fungsi',
                'content' => '<p>Konten tugas dan fungsi...</p>',
                'description' => 'Halaman tugas dan fungsi organisasi',
                'sort_order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Struktur Organisasi',
                'slug' => 'struktur-organisasi',
                'content' => '<p>Konten struktur organisasi...</p>',
                'description' => 'Halaman struktur organisasi',
                'sort_order' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('organization_profiles')->insert($profiles);
    }
}
