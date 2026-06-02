<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('siswa')->insert([
            [
                'user_id' => 2,
                'nama' => 'Kartika Tri Juliana',
                'tgl_lahir' => '2007-05-10',
                'jenjang' => 'SMA',
                'tingkat' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 3,
                'nama' => 'Muhammad Rizki',
                'tgl_lahir' => '2006-11-20',
                'jenjang' => 'SMA',
                'tingkat' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}