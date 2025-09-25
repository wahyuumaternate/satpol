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
        Schema::create('tanggapans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengaduan_id');
            $table->unsignedBigInteger('petugas_id'); // ID of the admin/staff who responded
            $table->text('isi_tanggapan');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('pengaduan_id')->references('id')->on('pengaduans')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('petugas_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggapans');
    }
};
