<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_siswa', function (Blueprint $table) {
            $table->id('data_siswa_id');
            
            $table->foreignId('siswa_id')
                  ->constrained('siswa')
                  ->onDelete('cascade');

            $table->integer('jam_belajar');
            $table->integer('jam_tidur');
            $table->enum('motivasi', ['rendah', 'sedang', 'tinggi']);
            $table->decimal('nilai_ujian', 5, 2);
            $table->enum('gangguan_belajar', ['ya', 'tidak']);
            $table->enum('keterlibatan_ortu', ['rendah', 'sedang', 'tinggi']);
            $table->enum('akses_pembelajaran', ['baik', 'cukup', 'kurang']);
            $table->integer('kelas_tambahan');

            $table->timestamps(); // <-- wajib
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_siswa');
    }
};