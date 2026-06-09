<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PilihanJawabanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pilihan_jawaban')->insert([

            // ════════════════════════════════════════════════════════
            // KATEGORI 1 – Sleep_Hours  (pertanyaan_id 1–4)
            // ════════════════════════════════════════════════════════

            // Q1 – Pola tidur beberapa minggu terakhir
            ['pertanyaan_id' => 1, 'jawaban' => 'Saya biasanya tidur cukup dan bangun dalam kondisi cukup segar untuk beraktivitas.', 'risk_level' => 'Low'],
            ['pertanyaan_id' => 1, 'jawaban' => 'Jam tidur saya kadang tidak teratur, terkadang cukup tapi sering merasa kurang istirahat.', 'risk_level' => 'Medium'],
            ['pertanyaan_id' => 1, 'jawaban' => 'Saya sering tidur larut atau kurang tidur sehingga mudah lelah saat belajar.', 'risk_level' => 'High'],

            // Q2 – Rata-rata jam tidur per malam
            ['pertanyaan_id' => 2, 'jawaban' => 'Lebih dari 8 jam, saya merasa istirahat sangat cukup.', 'risk_level' => 'Low'],
            ['pertanyaan_id' => 2, 'jawaban' => 'Antara 6–8 jam, cukup namun kadang masih mengantuk.', 'risk_level' => 'Medium'],
            ['pertanyaan_id' => 2, 'jawaban' => 'Kurang dari 6 jam, saya sering kelelahan keesokan harinya.', 'risk_level' => 'High'],

            // Q3 – Sering terbangun di tengah malam
            ['pertanyaan_id' => 3, 'jawaban' => 'Tidak, saya tidur nyenyak dan jarang terbangun.', 'risk_level' => 'Low'],
            ['pertanyaan_id' => 3, 'jawaban' => 'Kadang-kadang terbangun tetapi bisa segera tidur kembali.', 'risk_level' => 'Medium'],
            ['pertanyaan_id' => 3, 'jawaban' => 'Sering terbangun dan sulit untuk tidur kembali hingga pagi.', 'risk_level' => 'High'],

            // Q4 – Kondisi saat bangun tidur
            ['pertanyaan_id' => 4, 'jawaban' => 'Saya merasa segar dan siap memulai aktivitas.', 'risk_level' => 'Low'],
            ['pertanyaan_id' => 4, 'jawaban' => 'Saya butuh beberapa waktu untuk benar-benar terjaga dan bersemangat.', 'risk_level' => 'Medium'],
            ['pertanyaan_id' => 4, 'jawaban' => 'Saya selalu merasa mengantuk dan lemas sepanjang pagi.', 'risk_level' => 'High'],

            // ════════════════════════════════════════════════════════
            // KATEGORI 2 – Access_to_Resources  (pertanyaan_id 5–8)
            // ════════════════════════════════════════════════════════

            // Q5 – Belajar menggunakan perangkat digital
            ['pertanyaan_id' => 5, 'jawaban' => 'Saya sesekali membuka media sosial atau aplikasi lain, tetapi masih dapat kembali fokus pada kegiatan belajar.', 'risk_level' => 'Low'],
            ['pertanyaan_id' => 5, 'jawaban' => 'Saya mampu fokus belajar dan hanya membuka aplikasi atau situs yang berkaitan dengan materi yang sedang dipelajari.', 'risk_level' => 'Medium'],
            ['pertanyaan_id' => 5, 'jawaban' => 'Saya sering terdistraksi oleh media sosial, video, atau pesan sehingga waktu belajar banyak terbuang.', 'risk_level' => 'High'],

            // Q6 – Akses internet untuk belajar
            ['pertanyaan_id' => 6, 'jawaban' => 'Sangat mudah, koneksi internet stabil dan selalu tersedia.', 'risk_level' => 'Low'],
            ['pertanyaan_id' => 6, 'jawaban' => 'Cukup mudah, meski terkadang ada gangguan koneksi.', 'risk_level' => 'Medium'],
            ['pertanyaan_id' => 6, 'jawaban' => 'Sulit, akses internet terbatas atau sering tidak stabil.', 'risk_level' => 'High'],

            // Q7 – Kepemilikan perangkat belajar
            ['pertanyaan_id' => 7, 'jawaban' => 'Ya, saya memiliki perangkat pribadi yang memadai dan selalu siap digunakan.', 'risk_level' => 'Low'],
            ['pertanyaan_id' => 7, 'jawaban' => 'Saya harus berbagi perangkat dengan anggota keluarga lain.', 'risk_level' => 'Medium'],
            ['pertanyaan_id' => 7, 'jawaban' => 'Tidak, saya tidak memiliki perangkat yang cukup untuk belajar secara digital.', 'risk_level' => 'High'],

            // Q8 – Ketersediaan buku/materi fisik
            ['pertanyaan_id' => 8, 'jawaban' => 'Lengkap, semua buku dan modul yang dibutuhkan tersedia di rumah.', 'risk_level' => 'Low'],
            ['pertanyaan_id' => 8, 'jawaban' => 'Sebagian tersedia, beberapa harus meminjam atau mencari di tempat lain.', 'risk_level' => 'Medium'],
            ['pertanyaan_id' => 8, 'jawaban' => 'Sangat terbatas, hampir tidak ada buku atau materi belajar di rumah.', 'risk_level' => 'High'],

            // ════════════════════════════════════════════════════════
            // KATEGORI 3 – Motivation_Level  (pertanyaan_id 9–12)
            // ════════════════════════════════════════════════════════

            // Q9 – Memahami materi baru dari guru
            ['pertanyaan_id' => 9, 'jawaban' => 'Saya umumnya dapat memahami materi baru dengan baik setelah satu atau dua kali penjelasan.', 'risk_level' => 'Low'],
            ['pertanyaan_id' => 9, 'jawaban' => 'Saya memerlukan penjelasan tambahan atau contoh lain untuk memahami beberapa materi tertentu.', 'risk_level' => 'Medium'],
            ['pertanyaan_id' => 9, 'jawaban' => 'Saya sering kesulitan memahami materi meskipun sudah dijelaskan berulang kali.', 'risk_level' => 'High'],

            // Q10 – Semangat belajar setiap hari
            ['pertanyaan_id' => 10, 'jawaban' => 'Saya selalu bersemangat dan tidak sabar untuk belajar hal baru setiap hari.', 'risk_level' => 'Low'],
            ['pertanyaan_id' => 10, 'jawaban' => 'Semangat saya naik turun tergantung suasana hati dan mata pelajarannya.', 'risk_level' => 'Medium'],
            ['pertanyaan_id' => 10, 'jawaban' => 'Saya sering merasa malas dan tidak tertarik untuk belajar.', 'risk_level' => 'High'],

            // Q11 – Menetapkan target belajar
            ['pertanyaan_id' => 11, 'jawaban' => 'Ya, saya selalu menetapkan target yang jelas dan berusaha keras mencapainya.', 'risk_level' => 'Low'],
            ['pertanyaan_id' => 11, 'jawaban' => 'Kadang-kadang saya menetapkan target, tetapi tidak selalu konsisten menjalankannya.', 'risk_level' => 'Medium'],
            ['pertanyaan_id' => 11, 'jawaban' => 'Tidak, saya belajar seadanya tanpa target yang jelas.', 'risk_level' => 'High'],

            // Q12 – Reaksi terhadap nilai kurang memuaskan
            ['pertanyaan_id' => 12, 'jawaban' => 'Saya termotivasi untuk belajar lebih giat dan mencari tahu kesalahan saya.', 'risk_level' => 'Low'],
            ['pertanyaan_id' => 12, 'jawaban' => 'Saya sedikit kecewa, tetapi mencoba untuk tetap berusaha lebih baik ke depannya.', 'risk_level' => 'Medium'],
            ['pertanyaan_id' => 12, 'jawaban' => 'Saya merasa putus asa dan tidak yakin bisa memperbaiki nilai tersebut.', 'risk_level' => 'High'],

            // ════════════════════════════════════════════════════════
            // KATEGORI 4 – Les  (pertanyaan_id 13–16)
            // ════════════════════════════════════════════════════════

            // Q13 – Mengikuti les/bimbel
            ['pertanyaan_id' => 13, 'jawaban' => 'Ya, saya rutin mengikuti les atau bimbingan belajar untuk mendukung pembelajaran di sekolah.', 'risk_level' => 'Low'],
            ['pertanyaan_id' => 13, 'jawaban' => 'Kadang-kadang, hanya saat mendekati ujian atau ada materi yang sulit.', 'risk_level' => 'Medium'],
            ['pertanyaan_id' => 13, 'jawaban' => 'Tidak, saya tidak mengikuti les atau bimbingan belajar apapun.', 'risk_level' => 'High'],

            // Q14 – Frekuensi les per minggu
            ['pertanyaan_id' => 14, 'jawaban' => 'Lebih dari 3 kali seminggu, saya sangat aktif mengikuti les.', 'risk_level' => 'Low'],
            ['pertanyaan_id' => 14, 'jawaban' => '1–2 kali seminggu, cukup untuk mengulang materi sekolah.', 'risk_level' => 'Medium'],
            ['pertanyaan_id' => 14, 'jawaban' => 'Tidak pernah atau sangat jarang mengikuti les.', 'risk_level' => 'High'],

            // Q15 – Pengaruh les terhadap pemahaman
            ['pertanyaan_id' => 15, 'jawaban' => 'Sangat besar, les sangat membantu pemahaman materi dan meningkatkan nilai saya.', 'risk_level' => 'Low'],
            ['pertanyaan_id' => 15, 'jawaban' => 'Cukup berpengaruh untuk beberapa mata pelajaran tertentu saja.', 'risk_level' => 'Medium'],
            ['pertanyaan_id' => 15, 'jawaban' => 'Tidak terlalu berpengaruh, saya masih kesulitan meskipun sudah ikut les.', 'risk_level' => 'High'],

            // Q16 – Kesesuaian les dengan mata pelajaran sulit
            ['pertanyaan_id' => 16, 'jawaban' => 'Ya, les yang saya ikuti sesuai dengan mata pelajaran yang paling saya kesulitan.', 'risk_level' => 'Low'],
            ['pertanyaan_id' => 16, 'jawaban' => 'Sebagian sesuai, namun ada beberapa mata pelajaran sulit yang belum tercover.', 'risk_level' => 'Medium'],
            ['pertanyaan_id' => 16, 'jawaban' => 'Tidak sesuai, les yang saya ikuti tidak membantu mata pelajaran yang paling sulit.', 'risk_level' => 'High'],

            // ════════════════════════════════════════════════════════
            // KATEGORI 5 – Kesulitan_Belajar  (pertanyaan_id 17–20)
            // ════════════════════════════════════════════════════════

            // Q17 – Kesulitan memahami pelajaran tertentu
            ['pertanyaan_id' => 17, 'jawaban' => 'Tidak, saya dapat mengikuti semua mata pelajaran dengan cukup baik.', 'risk_level' => 'Low'],
            ['pertanyaan_id' => 17, 'jawaban' => 'Ada beberapa mata pelajaran yang cukup sulit, tetapi masih bisa saya tangani.', 'risk_level' => 'Medium'],
            ['pertanyaan_id' => 17, 'jawaban' => 'Ya, saya sering mengalami kesulitan besar dalam memahami pelajaran tertentu.', 'risk_level' => 'High'],

            // Q18 – Frustrasi saat mengerjakan tugas/PR
            ['pertanyaan_id' => 18, 'jawaban' => 'Jarang, saya biasanya dapat menyelesaikan tugas dengan tenang.', 'risk_level' => 'Low'],
            ['pertanyaan_id' => 18, 'jawaban' => 'Kadang-kadang, terutama saat tugas sangat banyak atau sulit.', 'risk_level' => 'Medium'],
            ['pertanyaan_id' => 18, 'jawaban' => 'Sering, saya hampir selalu merasa frustrasi dan kewalahan saat mengerjakan tugas.', 'risk_level' => 'High'],

            // Q19 – Konsentrasi belajar di rumah
            ['pertanyaan_id' => 19, 'jawaban' => 'Tidak, saya dapat berkonsentrasi dengan baik saat belajar di rumah.', 'risk_level' => 'Low'],
            ['pertanyaan_id' => 19, 'jawaban' => 'Kadang-kadang, tergantung suasana rumah dan kondisi saya.', 'risk_level' => 'Medium'],
            ['pertanyaan_id' => 19, 'jawaban' => 'Ya, saya sangat mudah terdistraksi dan sulit fokus belajar di rumah.', 'risk_level' => 'High'],

            // Q20 – Kemampuan mengingat materi
            ['pertanyaan_id' => 20, 'jawaban' => 'Baik, saya dapat mengingat sebagian besar materi yang telah dipelajari.', 'risk_level' => 'Low'],
            ['pertanyaan_id' => 20, 'jawaban' => 'Cukup, namun saya perlu mengulang beberapa kali agar benar-benar ingat.', 'risk_level' => 'Medium'],
            ['pertanyaan_id' => 20, 'jawaban' => 'Lemah, saya sering lupa materi yang sudah dipelajari meskipun baru saja belajar.', 'risk_level' => 'High'],
        ]);
    }
}