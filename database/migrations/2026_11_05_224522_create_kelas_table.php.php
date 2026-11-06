<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id('id_kelas');

            $table->foreignId('id_kategori')
                ->constrained('kategori', 'id_kategori')
                ->cascadeOnDelete();

            $table->string('judul');
            $table->text('deskripsi');
            $table->string('instruktur');
            $table->decimal('harga', 12, 2)->default(0);
            $table->string('gambar')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};