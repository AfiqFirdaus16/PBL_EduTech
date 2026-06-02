<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_analisa', function (Blueprint $table) {
        $table->id();

        $table->foreignId('sesi_id')
            ->constrained('sesi_kuis')
            ->cascadeOnDelete();

        $table->enum('risk_level', [
            'Low',
            'Medium',
            'High'
        ]);

        $table->text('rekomendasi');

        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('analisis_resiko');
    }
};