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
       Schema::create('jawaban_kuis', function (Blueprint $table) {
        $table->id();

        $table->foreignId('sesi_id')
            ->constrained('sesi_kuis')
            ->cascadeOnDelete();

        $table->foreignId('pertanyaan_id')
            ->constrained('pertanyaan')
            ->cascadeOnDelete();

        $table->foreignId('pilihan_id')
            ->constrained('pilihan_jawaban')
            ->cascadeOnDelete();

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_kuis');
    }
};
