<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Pengaduan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            OrganizationProfileSeeder::class,
            KategoriSeeder::class,
        ]);

        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')
        ]);

        // Seed Kecamatan di Kota Ternate
        $kecamatanData = [
            [
                'nama' => 'Kecamatan Pulau Ternate',
                'kode' => 'TER001'
            ],
            [
                'nama' => 'Kecamatan Ternate Utara',
                'kode' => 'TER002'
            ],
            [
                'nama' => 'Kecamatan Ternate Tengah',
                'kode' => 'TER003'
            ],
            [
                'nama' => 'Kecamatan Ternate Selatan',
                'kode' => 'TER004'
            ],
            [
                'nama' => 'Kecamatan Moti',
                'kode' => 'TER005'
            ],
            [
                'nama' => 'Kecamatan Pulau Batang Dua',
                'kode' => 'TER006'
            ],
            [
                'nama' => 'Kecamatan Pulau Hiri',
                'kode' => 'TER007'
            ],
        ];

        foreach ($kecamatanData as $data) {
            Kecamatan::create($data);
        }

        // Seed Kelurahan di Kota Ternate
        $kelurahanData = [
            // Kelurahan di Kecamatan Pulau Ternate
            [
                'kecamatan_id' => 1,
                'nama' => 'Kelurahan Bastiong',
                'kode' => 'BST001'
            ],
            [
                'kecamatan_id' => 1,
                'nama' => 'Kelurahan Kalumata',
                'kode' => 'KLM001'
            ],

            // Kelurahan di Kecamatan Ternate Utara
            [
                'kecamatan_id' => 2,
                'nama' => 'Kelurahan Dufa-dufa',
                'kode' => 'DFD001'
            ],
            [
                'kecamatan_id' => 2,
                'nama' => 'Kelurahan Sangaji',
                'kode' => 'SGJ001'
            ],
            [
                'kecamatan_id' => 2,
                'nama' => 'Kelurahan Toboleu',
                'kode' => 'TBL001'
            ],

            // Kelurahan di Kecamatan Ternate Tengah
            [
                'kecamatan_id' => 3,
                'nama' => 'Kelurahan Gamalama',
                'kode' => 'GML001'
            ],
            [
                'kecamatan_id' => 3,
                'nama' => 'Kelurahan Makassar',
                'kode' => 'MKS001'
            ],
            [
                'kecamatan_id' => 3,
                'nama' => 'Kelurahan Marikurubu',
                'kode' => 'MRK001'
            ],

            // Kelurahan di Kecamatan Ternate Selatan
            [
                'kecamatan_id' => 4,
                'nama' => 'Kelurahan Fitu',
                'kode' => 'FIT001'
            ],
            [
                'kecamatan_id' => 4,
                'nama' => 'Kelurahan Gambesi',
                'kode' => 'GBS001'
            ],
            [
                'kecamatan_id' => 4,
                'nama' => 'Kelurahan Kayu Merah',
                'kode' => 'KYM001'
            ],

            // Kelurahan di Kecamatan Moti
            [
                'kecamatan_id' => 5,
                'nama' => 'Kelurahan Moti',
                'kode' => 'MOT001'
            ],
            [
                'kecamatan_id' => 5,
                'nama' => 'Kelurahan Takofi',
                'kode' => 'TKF001'
            ],

            // Kelurahan di Kecamatan Pulau Batang Dua
            [
                'kecamatan_id' => 6,
                'nama' => 'Kelurahan Mayau',
                'kode' => 'MAY001'
            ],
            [
                'kecamatan_id' => 6,
                'nama' => 'Kelurahan Tifure',
                'kode' => 'TFR001'
            ],

            // Kelurahan di Kecamatan Pulau Hiri
            [
                'kecamatan_id' => 7,
                'nama' => 'Kelurahan Togolobe',
                'kode' => 'TGL001'
            ],
            [
                'kecamatan_id' => 7,
                'nama' => 'Kelurahan Dorpedu',
                'kode' => 'DRP001'
            ],
        ];

        foreach ($kelurahanData as $data) {
            Kelurahan::create($data);
        }

        // Seed contoh pengaduan
        $pengaduanData = [
            [
                'kelurahan_id' => 2, // Kelurahan Kalumata
                'kode_pengaduan' => 'PK-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5)),
                'judul' => 'Kebisingan Warung Kopi 24 Jam',
                'deskripsi' => 'Terdapat warung kopi yang beroperasi 24 jam dan sangat berisik terutama di malam hari. Mengganggu kenyamanan warga sekitar yang ingin beristirahat.',
                'kategori_ketertiban' => 'kebisingan',
                'lokasi_kejadian' => 'Jl. Sultan Babullah No. 45, RT 05/RW 03',
                'waktu_kejadian' => Carbon::now()->subDays(5),
                'nama_pelapor' => 'Ahmad Bahar',
                'email_pelapor' => 'ahmad.bahar@gmail.com',
                'nomor_telepon' => '085242123456',
                'alamat_pelapor' => 'Jl. Sultan Babullah No. 50, RT 05/RW 03',
                'foto_bukti' => null,
                'status' => 'proses',
                'tanggapan' => 'Kami telah melakukan peninjauan dan akan segera berkoordinasi dengan pemilik warung',
                'tanggal_tanggapan' => Carbon::now()->subDays(2),
            ],
            [
                'kelurahan_id' => 4, // Kelurahan Sangaji
                'kode_pengaduan' => 'PK-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5)),
                'judul' => 'Pedagang Kaki Lima Menghalangi Trotoar',
                'deskripsi' => 'Banyak pedagang kaki lima yang berjualan di trotoar sehingga pejalan kaki harus berjalan di jalanan. Ini sangat berbahaya terutama di jam-jam ramai.',
                'kategori_ketertiban' => 'pedagang_kaki_lima',
                'lokasi_kejadian' => 'Jl. Ahmad Yani depan pasar',
                'waktu_kejadian' => Carbon::now()->subDays(10),
                'nama_pelapor' => 'Ratna Sari',
                'email_pelapor' => 'ratna.sari@yahoo.com',
                'nomor_telepon' => '081234567890',
                'alamat_pelapor' => 'Jl. Ahmad Yani No. 23, RT 02/RW 04',
                'foto_bukti' => null,
                'status' => 'selesai',
                'tanggapan' => 'Petugas Satpol PP telah melakukan penertiban dan merelokasi pedagang ke tempat yang sudah disediakan',
                'tanggal_tanggapan' => Carbon::now()->subDays(5),
            ],
            [
                'kelurahan_id' => 7, // Kelurahan Gamalama
                'kode_pengaduan' => 'PK-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5)),
                'judul' => 'Tumpukan Sampah Tidak Diangkut',
                'deskripsi' => 'Tumpukan sampah di sudut gang sudah menumpuk selama seminggu dan tidak diangkut petugas. Menimbulkan bau tidak sedap dan berpotensi menjadi sarang penyakit.',
                'kategori_ketertiban' => 'kebersihan',
                'lokasi_kejadian' => 'Gang Mawar, RT 03/RW 02',
                'waktu_kejadian' => Carbon::now()->subDays(7),
                'nama_pelapor' => 'Dodi Santoso',
                'email_pelapor' => null,
                'nomor_telepon' => '082156789012',
                'alamat_pelapor' => 'Gang Mawar No. 15, RT 03/RW 02',
                'foto_bukti' => null,
                'status' => 'menunggu',
                'tanggapan' => null,
                'tanggal_tanggapan' => null,
            ],
            [
                'kelurahan_id' => 10, // Kelurahan Gambesi
                'kode_pengaduan' => 'PK-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5)),
                'judul' => 'Parkir Liar di Depan Pertokoan',
                'deskripsi' => 'Banyak kendaraan yang parkir sembarangan di depan area pertokoan sehingga mengganggu arus lalu lintas dan akses ke toko-toko.',
                'kategori_ketertiban' => 'parkir_liar',
                'lokasi_kejadian' => 'Jl. Raya Gambesi depan kompleks pertokoan',
                'waktu_kejadian' => Carbon::now()->subDays(3),
                'nama_pelapor' => 'Hendra Wijaya',
                'email_pelapor' => 'hendra.w@gmail.com',
                'nomor_telepon' => '087812345678',
                'alamat_pelapor' => 'Perumahan Gambesi Indah Blok C2 No. 8',
                'foto_bukti' => null,
                'status' => 'proses',
                'tanggapan' => 'Tim kami sedang melakukan koordinasi dengan Dishub untuk penertiban',
                'tanggal_tanggapan' => Carbon::now()->subDay(),
            ],
            [
                'kelurahan_id' => 13, // Kelurahan Moti
                'judul' => 'Vandalisme Fasilitas Umum',
                'kode_pengaduan' => 'PK-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5)),
                'deskripsi' => 'Beberapa pemuda melakukan vandalisme pada dinding taman kota dan halte bus dengan coretan-coretan yang tidak pantas.',
                'kategori_ketertiban' => 'vandalisme',
                'lokasi_kejadian' => 'Taman Kota dan Halte Bus dekat pasar',
                'waktu_kejadian' => Carbon::now()->subDays(2),
                'nama_pelapor' => 'Suryani',
                'email_pelapor' => 'suryani.moti@gmail.com',
                'nomor_telepon' => '081345678901',
                'alamat_pelapor' => 'Jl. Moti Indah No. 7',
                'foto_bukti' => null,
                'status' => 'menunggu',
                'tanggapan' => null,
                'tanggal_tanggapan' => null,
            ],
        ];

        foreach ($pengaduanData as $data) {
            Pengaduan::create($data);
        }
    }
}
