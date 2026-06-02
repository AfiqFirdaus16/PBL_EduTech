<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sesi_kuis', function (Blueprint $table) {
        $table->id();

        $table->foreignId('siswa_id')
            ->constrained('siswa')
            ->cascadeOnDelete();

        $table->timestamp('tanggal_kuis')
            ->useCurrent();

        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_siswa');
    }
};