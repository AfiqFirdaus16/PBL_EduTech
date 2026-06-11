<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesiKuis extends Model
{
    protected $table = 'sesi_kuis';

    public function siswa()
    {
        return $this->belongsTo(
            Siswa::class,
            'siswa_id'
        );
    }

    public function hasilAnalisa()
    {
        return $this->hasOne(
            HasilAnalisa::class,
            'sesi_id'
        );
    }
}