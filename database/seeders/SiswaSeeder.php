<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('siswa')->insert([
            [
                'user_id' => 2, // pastikan ini ada di users
                'umur' => 17,
                'tgl_lahir' => '2007-01-01',
                'jenjang' => 'SMA',
                'tingkat' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}