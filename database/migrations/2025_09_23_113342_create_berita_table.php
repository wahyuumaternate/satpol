<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('konten');
            $table->string('gambar')->nullable();
            $table->string('penulis');
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('tanggal_publish')->nullable();
            $table->foreignId('kategori_id')->nullable()->constrained('kategori')->onDelete('cascade');
            $table->text('excerpt')->nullable();
            $table->json('tags')->nullable();
            $table->integer('views')->default(0);
            $table->timestamps();

            $table->index(['status', 'tanggal_publish']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('berita');
    }
};
