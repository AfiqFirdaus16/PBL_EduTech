<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{
    protected $table = 'data_siswa';
    protected $primaryKey = 'data_siswa_id';

    public $timestamps = true;

    protected $fillable = [
        'siswa_id',
        'jam_belajar',
        'jam_tidur',
        'motivasi',
        'nilai_ujian',
        'gangguan_belajar',
        'keterlibatan_ortu',
        'akses_pembelajaran',
        'kelas_tambahan',
    ];

    // RELASI: DataSiswa milik Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'siswa_id');
    }
}