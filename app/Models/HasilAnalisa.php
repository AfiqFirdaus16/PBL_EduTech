<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'rekomendasi'
    ];

    // DEFINISIKAN RELASI INI AGAR ERROR SADA IMAGE 2 HILANG
    public function sesiKuis(): BelongsTo
    {
        return $this->belongsTo(SesiKuis::class, 'sesi_id', 'id');
    }
}
