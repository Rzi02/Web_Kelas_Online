<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id('id_pendaftaran');

            $table->foreignId('id_kelas')
                ->constrained('kelas', 'id_kelas')
                ->cascadeOnDelete();

            $table->foreignId('id_pendaftar')
                ->constrained('pendaftar', 'id_pendaftar')
                ->cascadeOnDelete();

            $table->enum('status', [
                'pending',
                'accepted',
                'rejected'
            ])->default('pending');

            $table->dateTime('tanggal_daftar')->useCurrent();

            $table->timestamps();

            $table->unique(['id_kelas', 'id_pendaftar']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};