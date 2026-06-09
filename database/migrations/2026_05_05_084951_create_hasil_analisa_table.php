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

            // DATA SIAKAD
            $table->integer('attendance')->nullable();
            $table->integer('previous_scores')->nullable();
            $table->integer('hours_studied')->nullable();

            // DATA KUIS
            $table->string('sleep_hours')->nullable();
            $table->string('access_to_resources')->nullable();
            $table->string('motivation_level')->nullable();
            $table->string('tutoring_sessions')->nullable();
            $table->string('kesulitan_belajar')->nullable();

            // HASIL FORWARD CHAINING
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