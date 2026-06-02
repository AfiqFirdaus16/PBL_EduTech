<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PertanyaanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pertanyaan')->insert([
            // ── Kategori 1: Sleep_Hours ──────────────────────────────
            [
                'pertanyaan' => 'Bagaimana pola tidur kamu selama beberapa minggu terakhir?',
                'kategori'   => 'Sleep_Hours',
            ],
            [
                'pertanyaan' => 'Berapa rata-rata jam tidur kamu setiap malam?',
                'kategori'   => 'Sleep_Hours',
            ],
            [
                'pertanyaan' => 'Apakah kamu sering terbangun di tengah malam atau sulit tidur kembali?',
                'kategori'   => 'Sleep_Hours',
            ],
            [
                'pertanyaan' => 'Bagaimana kondisi kamu saat bangun tidur di pagi hari?',
                'kategori'   => 'Sleep_Hours',
            ],

            // ── Kategori 2: Access_to_Resources ─────────────────────
            [
                'pertanyaan' => 'Apa yang biasanya terjadi saat Anda belajar menggunakan perangkat digital?',
                'kategori'   => 'Access_to_Resources',
            ],
            [
                'pertanyaan' => 'Seberapa mudah Anda mengakses internet untuk keperluan belajar?',
                'kategori'   => 'Access_to_Resources',
            ],
            [
                'pertanyaan' => 'Apakah Anda memiliki perangkat (laptop/tablet/HP) yang memadai untuk belajar?',
                'kategori'   => 'Access_to_Resources',
            ],
            [
                'pertanyaan' => 'Bagaimana ketersediaan buku atau materi belajar fisik di rumah Anda?',
                'kategori'   => 'Access_to_Resources',
            ],

            // ── Kategori 3: Motivation_Level ─────────────────────────
            [
                'pertanyaan' => 'Seberapa mudah Anda memahami materi baru yang disampaikan oleh guru?',
                'kategori'   => 'Motivation_Level',
            ],
            [
                'pertanyaan' => 'Bagaimana semangat belajar Anda setiap harinya?',
                'kategori'   => 'Motivation_Level',
            ],
            [
                'pertanyaan' => 'Apakah Anda menetapkan target atau tujuan belajar untuk diri sendiri?',
                'kategori'   => 'Motivation_Level',
            ],
            [
                'pertanyaan' => 'Bagaimana reaksi Anda ketika mendapatkan nilai yang kurang memuaskan?',
                'kategori'   => 'Motivation_Level',
            ],

            // ── Kategori 4: Les ──────────────────────────────────────
            [
                'pertanyaan' => 'Apakah Anda mengikuti kegiatan les atau bimbingan belajar di luar sekolah?',
                'kategori'   => 'Les',
            ],
            [
                'pertanyaan' => 'Berapa kali dalam seminggu Anda mengikuti les atau bimbingan belajar?',
                'kategori'   => 'Les',
            ],
            [
                'pertanyaan' => 'Seberapa besar pengaruh les/bimbel terhadap pemahaman materi Anda?',
                'kategori'   => 'Les',
            ],
            [
                'pertanyaan' => 'Apakah les/bimbel yang Anda ikuti sesuai dengan mata pelajaran yang sulit?',
                'kategori'   => 'Les',
            ],

            // ── Kategori 5: kesulitan_belajar ───────────────────────
            [
                'pertanyaan' => 'Apakah Anda mengalami kesulitan dalam memahami pelajaran tertentu?',
                'kategori'   => 'kesulitan_belajar',
            ],
            [
                'pertanyaan' => 'Seberapa sering Anda merasa frustrasi saat mengerjakan tugas atau PR?',
                'kategori'   => 'kesulitan_belajar',
            ],
            [
                'pertanyaan' => 'Apakah Anda kesulitan berkonsentrasi saat belajar di rumah?',
                'kategori'   => 'kesulitan_belajar',
            ],
            [
                'pertanyaan' => 'Bagaimana kemampuan Anda dalam mengingat materi yang sudah dipelajari?',
                'kategori'   => 'kesulitan_belajar',
            ],
        ]);
    }
}