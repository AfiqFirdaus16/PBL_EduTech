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
                'id' => 1,
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 2,
                'username' => 'siswa1',
                'email' => 'siswa1@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 3,
                'username' => 'siswa2',
                'email' => 'siswa2@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}