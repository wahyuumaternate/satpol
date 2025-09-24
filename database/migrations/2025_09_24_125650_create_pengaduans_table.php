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
            $table->unsignedBigInteger('kelurahan_id');
            $table->string('judul');
            $table->string('kode_pengaduan')->unique();
            $table->text('deskripsi');
            $table->enum('kategori_ketertiban', ['keamanan', 'kebersihan', 'kebisingan', 'parkir_liar', 'pedagang_kaki_lima', 'vandalisme', 'lainnya'])->default('lainnya');
            $table->string('lokasi_kejadian');
            $table->timestamp('waktu_kejadian')->nullable();
            $table->string('nama_pelapor');
            $table->string('email_pelapor')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('alamat_pelapor');
            $table->string('foto_bukti')->nullable();
            $table->enum('status', ['menunggu', 'proses', 'selesai', 'ditolak'])->default('menunggu');
            $table->text('tanggapan')->nullable();
            $table->timestamp('tanggal_tanggapan')->nullable();
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('kelurahan_id')->references('id')->on('kelurahans')
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
