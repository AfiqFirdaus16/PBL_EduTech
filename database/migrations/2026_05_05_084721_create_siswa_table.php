<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')
            ->constrained('users')
            ->cascadeOnDelete();

        $table->string('nisn')->unique();

        $table->string('nama');
        $table->date('tgl_lahir')->nullable();

        $table->enum('jenjang', ['SMP', 'SMA']);
        $table->enum('tingkat', ['1', '2', '3']);

        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};