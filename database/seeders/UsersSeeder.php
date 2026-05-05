<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'admin1',
                'nama' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('123456'),
                'role' => 'admin'
            ],
            [
                'username' => 'siswa1',
                'nama' => 'Budi',
                'email' => 'budi@mail.com',
                'password' => Hash::make('123456'),
                'role' => 'siswa'
            ]
        ]);
    }
}