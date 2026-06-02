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
        Schema::create('siakad_snapshot', function (Blueprint $table) {
        $table->id();

        $table->foreignId('sesi_id')
            ->constrained('sesi_kuis')
            ->cascadeOnDelete();

        $table->decimal('previous_scores', 5, 2);

        $table->decimal('attendance', 5, 2);

        $table->integer('hours_studied');

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siakad_snapshot');
    }
};
