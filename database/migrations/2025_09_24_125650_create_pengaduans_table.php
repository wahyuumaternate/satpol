<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Reference to the user who created the complaint
            $table->string('judul');
            $table->string('kode_pengaduan')->unique();
            $table->text('deskripsi');
            $table->enum('kategori_ketertiban', [
                'keamanan',
                'kebersihan',
                'kebisingan',
                'parkir_liar',
                'pedagang_kaki_lima',
                'vandalisme',
                'lainnya'
            ])->default('lainnya');
            $table->string('lokasi_kejadian');
            $table->timestamp('waktu_kejadian')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('alamat_kejadian'); // Changed from alamat_pelapor to be more clear
            $table->string('foto_bukti')->nullable();
            $table->enum('status', ['menunggu', 'proses', 'selesai', 'ditolak'])->default('menunggu');
            $table->timestamps();

            // Foreign key constraint for user
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
