<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilAnalisa extends Model
{
    protected $table = 'hasil_analisa';

    protected $fillable = [
        'sesi_id',
        'attendance',
        'previous_scores',
        'hours_studied',
        'sleep_hours',
        'access_to_resources',
        'motivation_level',
        'tutoring_sessions',
        'kesulitan_belajar',
        'risk_level',
        'rekomendasi',
    ];

    public function sesi()
    {
        return $this->belongsTo(SesiKuis::class, 'sesi_id');
    }
}