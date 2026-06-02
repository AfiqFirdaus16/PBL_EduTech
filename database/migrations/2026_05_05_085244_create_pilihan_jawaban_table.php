<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pilihan_jawaban', function (Blueprint $table) {
        $table->id();

        $table->foreignId('pertanyaan_id')
            ->constrained('pertanyaan')
            ->cascadeOnDelete();

        $table->string('jawaban');

        $table->enum('risk_level', [
            'Low',
            'Medium',
            'High'
        ]);

        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('dashboard');
    }
};