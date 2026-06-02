<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pertanyaan extends Model
{
    protected $table = 'pertanyaan';

    protected $fillable = ['pertanyaan', 'kategori'];

    public function pilihanJawaban(): HasMany
    {
        return $this->hasMany(PilihanJawaban::class, 'pertanyaan_id');
    }
}