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

            $table->unsignedBigInteger('user_id');
            $table->unique('user_id'); // karena 1 user = 1 siswa

            $table->foreign('user_id')
                  ->references('user_id') // <-- ini yang penting
                  ->on('users')
                  ->onDelete('cascade');

            $table->integer('umur');
            $table->date('tgl_lahir');
            $table->enum('jenjang', ['SD', 'SMP', 'SMA']);
            $table->enum('tingkat', ['rendah', 'sedang', 'tinggi']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};