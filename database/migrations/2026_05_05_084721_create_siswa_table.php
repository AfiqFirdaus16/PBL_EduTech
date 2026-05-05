<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id('siswa_id');
            $table->foreignId('user_id')
                  ->unique()
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->integer('umur');
            $table->date('tgl_lahir');
            $table->enum('jenjang', ['SD', 'SMP', 'SMA']);
            $table->enum('tingkat', ['rendah', 'sedang', 'tinggi']);
            
            $table->timestamps(); // <-- penting
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};