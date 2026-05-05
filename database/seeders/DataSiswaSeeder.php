<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataSiswaSeeder extends Seeder
{
    public function run(): void
    {
        $siswas = DB::table('siswa')->get();

        foreach ($siswas as $siswa) {
            DB::table('data_siswa')->insert([
                'siswa_id' => $siswa->siswa_id,
                'jam_belajar' => rand(1, 5),
                'jam_tidur' => rand(5, 9),
                'motivasi' => collect(['rendah', 'sedang', 'tinggi'])->random(),
                'nilai_ujian' => rand(60, 100),
                'gangguan_belajar' => collect(['ya', 'tidak'])->random(),
                'keterlibatan_ortu' => collect(['rendah', 'sedang', 'tinggi'])->random(),
                'akses_pembelajaran' => collect(['baik', 'cukup', 'kurang'])->random(),
                'kelas_tambahan' => rand(0, 3),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}