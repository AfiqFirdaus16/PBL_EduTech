<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analisis_resiko', function (Blueprint $table) {
            $table->id('analisis_id');

            $table->foreignId('data_siswa_id')
                  ->constrained('data_siswa')
                  ->onDelete('cascade');

            $table->enum('tingkat_resiko', ['rendah', 'sedang', 'tinggi']);
            $table->text('hasil_analisis');
            $table->text('solusi_resiko');

            $table->timestamps(); // <-- penting
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analisis_resiko');
    }
};