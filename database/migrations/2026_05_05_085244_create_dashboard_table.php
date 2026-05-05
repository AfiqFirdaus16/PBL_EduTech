<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dashboard', function (Blueprint $table) {
            $table->id('dashboard_id');

            $table->foreignId('rekomendasi_id')
                  ->constrained('rekomendasi')
                  ->onDelete('cascade');

            $table->foreignId('siswa_id')
                  ->constrained('siswa')
                  ->onDelete('cascade');

            $table->text('ringkasan_performa');
            $table->json('grafik_data'); // lebih fleksibel

            $table->timestamps(); // wajib
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dashboard');
    }
};