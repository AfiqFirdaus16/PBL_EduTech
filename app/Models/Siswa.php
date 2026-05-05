<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'siswa_id';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'umur',
        'tgl_lahir',
        'jenjang',
        'tingkat',
    ];

    // RELASI: Siswa milik User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // RELASI: Siswa punya banyak DataSiswa
    public function dataSiswa()
    {
        return $this->hasMany(DataSiswa::class, 'siswa_id', 'siswa_id');
    }
}