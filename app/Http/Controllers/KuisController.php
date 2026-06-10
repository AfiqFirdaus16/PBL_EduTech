<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Pertanyaan;
use App\Services\ForwardChainingService;

class KuisController extends Controller
{
    /**
     * Daftar kategori kuis secara berurutan.
     */
    private array $kategoriUrutan = [
        1 => 'Sleep_Hours',
        2 => 'Access_to_Resources',
        3 => 'Motivation_Level',
        4 => 'Les',
        5 => 'Kesulitan_Belajar',
    ];

    // ─────────────────────────────────────────────────────────────
    // Halaman kuis per kategori  →  GET /kuis/{step}
    // ─────────────────────────────────────────────────────────────
    public function show(int $step)
    {
        if ($step < 1 || $step > 5) {
            return redirect()->route('kuis.show', 1);
        }

        $kategori = $this->kategoriUrutan[$step];

        $pertanyaan = \App\Models\Pertanyaan::with('pilihanJawaban')
            ->where('kategori', $kategori)
            ->get();

        $totalStep      = 5;
        $persen         = round((($step - 1) / $totalStep) * 100);
        $stepBerikut    = $step + 1;
        $jawabanSession = session('jawaban', []);

        return view('page.kuis', compact(
            'step',
            'totalStep',
            'persen',
            'kategori',
            'pertanyaan',
            'stepBerikut',
            'jawabanSession',
        ));
    }

    // ─────────────────────────────────────────────────────────────
    // Simpan jawaban satu halaman  →  POST /kuis/{step}
    // ─────────────────────────────────────────────────────────────
    public function store(Request $request, int $step)
    {
        $kategori   = $this->kategoriUrutan[$step];
        $pertanyaan = \App\Models\Pertanyaan::where('kategori', $kategori)->get();

        $rules = [];
        foreach ($pertanyaan as $p) {
            $rules["q_{$p->id}"] = 'required|integer|exists:pilihan_jawaban,id';
        }

        $validated = $request->validate($rules);

        $jawaban = session('jawaban', []);
        foreach ($validated as $key => $pilihanId) {
            $jawaban[$key] = (int) $pilihanId;
        }
        session(['jawaban' => $jawaban]);

        if ($step === 5) {
            return redirect()->route('kuis.hasil');
        }

        return redirect()->route('kuis.show', $step + 1);
    }

    // ─────────────────────────────────────────────────────────────
    // Halaman hasil  →  GET /kuis/hasil
    // ─────────────────────────────────────────────────────────────
    public function hasil()
    {
        $jawaban = session('jawaban', []);

        if (empty($jawaban)) {
            return redirect()->route('kuis.show', 1);
        }

        // ── Hitung risk & skor per kategori ──
        $riskPerKategori = [];

        foreach ($this->kategoriUrutan as $step => $kategori) {
            $pertanyaan = \App\Models\Pertanyaan::with('pilihanJawaban')
                ->where('kategori', $kategori)
                ->get();

            $skor = ['Low' => 0, 'Medium' => 0, 'High' => 0];

            foreach ($pertanyaan as $p) {
                $pilihanId = $jawaban["q_{$p->id}"] ?? null;
                if ($pilihanId) {
                    $pilihan = $p->pilihanJawaban->firstWhere('id', $pilihanId);
                    if ($pilihan) {
                        $skor[$pilihan->risk_level]++;
                    }
                }
            }

            arsort($skor);
            $riskDominan = array_key_first($skor);

            $riskPerKategori[$kategori] = [
                'skor'  => $skor,
                'risk'  => $riskDominan,
                'label' => $this->labelKategori($kategori),
            ];
        }

        // ── Majority vote risk keseluruhan ──
        $allRisks   = array_column($riskPerKategori, 'risk');
        $riskCounts = array_count_values($allRisks);
        arsort($riskCounts);
        $riskTotal = array_key_first($riskCounts);

        // ── Nilai per-kategori untuk disimpan ke DB ──
        $sleepVal      = $riskPerKategori['Sleep_Hours']['risk'];          // Low/Medium/High
        $resourceVal   = $riskPerKategori['Access_to_Resources']['risk'];
        $motivationVal = $riskPerKategori['Motivation_Level']['risk'];
        $tutorVal      = $riskPerKategori['Les']['risk'];
        $kesulitanVal  = $riskPerKategori['Kesulitan_Belajar']['risk'];

        // ── Ambil data akademik dari API SIAKAD ──
        $nisn             = Auth::user()->siswa->nisn ?? null;
        $attendanceNum    = null;
        $hoursStudiedNum  = null;
        $previousScoreNum = null;
        $attendanceCat    = 'MEDIUM'; // fallback jika API gagal
        $hoursCat         = 'MEDIUM';
        $scoreCat         = 'MEDIUM';

        if ($nisn) {
            try {
                $siakadUrl  = rtrim(config('services.siakad.base_url'), '/') . '/api/student/' . $nisn;
                $response   = \Illuminate\Support\Facades\Http::timeout(8)->get($siakadUrl);

                if ($response->successful()) {
                    $siakad = $response->json('data');

                    $attendanceNum    = $siakad['attendance']      ?? null;
                    $hoursStudiedNum  = $siakad['hours_studied']   ?? null;
                    $previousScoreNum = $siakad['previous_scores'] ?? null;

                    // Konversi nilai numerik → kategori HIGH/MEDIUM/LOW
                    // Kehadiran: ≥80% = HIGH, 60–79% = MEDIUM, <60% = LOW
                    $attendanceCat = match(true) {
                        $attendanceNum >= 80 => 'HIGH',
                        $attendanceNum >= 60 => 'MEDIUM',
                        default              => 'LOW',
                    };

                    // Jam belajar: ≥7 = HIGH, 4–6 = MEDIUM, <4 = LOW
                    $hoursCat = match(true) {
                        $hoursStudiedNum >= 7 => 'HIGH',
                        $hoursStudiedNum >= 4 => 'MEDIUM',
                        default               => 'LOW',
                    };

                    // Nilai sebelumnya: ≥75 = HIGH, 50–74 = MEDIUM, <50 = LOW
                    $scoreCat = match(true) {
                        $previousScoreNum >= 75 => 'HIGH',
                        $previousScoreNum >= 50 => 'MEDIUM',
                        default                 => 'LOW',
                    };
                }
            } catch (\Exception $e) {
                // API SIAKAD tidak bisa diakses — lanjut dengan fallback MEDIUM
                \Illuminate\Support\Facades\Log::warning('SIAKAD API gagal: ' . $e->getMessage());
            }
        }

        $forward = new ForwardChainingService();

        $hasilForward = $forward->proses([
            'attendance_cat' => $attendanceCat,
            'sleep_cat'      => strtoupper($sleepVal),
            'hours_cat'      => $hoursCat,
            'resource_cat'   => strtoupper($resourceVal),
            'motivation_cat' => strtoupper($motivationVal),
            'tutor_cat'      => strtoupper($tutorVal),
            'score_cat'      => $scoreCat,
            'kesulitan_cat'  => strtoupper($kesulitanVal),
        ]);

        $riskTotal   = $hasilForward['risk'] ?? $riskTotal;
        $rekomendasi = $hasilForward['rekomendasi'] ?? null;

        // ── Mapping rekomendasi → daftar teknik belajar ──
        $teknikDatabase = $this->getTeknikDatabase();
        $teknikBelajar  = $this->mapRekomendasiToTeknik($rekomendasi, $teknikDatabase);

        // ── Simpan ke database ──
        $siswaId = Auth::user()->siswa->id ?? null;

        if ($siswaId) {
            // 1. Buat sesi kuis
            $sesiId = DB::table('sesi_kuis')->insertGetId([
                'siswa_id'     => $siswaId,
                'tanggal_kuis' => now(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);

            // 2. Simpan jawaban per pertanyaan
            $insertJawaban = [];
            foreach ($jawaban as $key => $pilihanId) {
                $pertanyaanId    = (int) str_replace('q_', '', $key);
                $insertJawaban[] = [
                    'sesi_id'       => $sesiId,
                    'pertanyaan_id' => $pertanyaanId,
                    'pilihan_id'    => $pilihanId,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ];
            }
            DB::table('jawaban_kuis')->insert($insertJawaban);

            // 3. Simpan hasil analisa lengkap
            //    — kolom kuis: nilai risk level per kategori (Low/Medium/High)
            //    — kolom SIAKAD: nilai numerik dummy (ganti nanti dari API)
            DB::table('hasil_analisa')->insert([
                'sesi_id'              => $sesiId,
                // DATA SIAKAD (dummy — ganti dengan nilai dari API SIAKAD)
                'attendance'           => $attendanceNum,
                'hours_studied'        => $hoursStudiedNum,
                'previous_scores'      => $previousScoreNum,
                // DATA KUIS (nilai risk level per kategori)
                'sleep_hours'          => $sleepVal,
                'access_to_resources'  => $resourceVal,
                'motivation_level'     => $motivationVal,
                'tutoring_sessions'    => $tutorVal,
                'kesulitan_belajar'    => $kesulitanVal,
                // HASIL FORWARD CHAINING
                'risk_level'           => $riskTotal,
                'rekomendasi'          => $rekomendasi,
                'created_at'           => now(),
                'updated_at'           => now(),
            ]);
        }

        // Hapus session
        session()->forget('jawaban');

        return view('page.hasil', compact(
            'riskPerKategori',
            'riskTotal',
            'rekomendasi',
            'teknikBelajar',
            // Data SIAKAD untuk ditampilkan di kartu kategori
            'attendanceCat',
            'hoursCat',
            'scoreCat',
            'attendanceNum',
            'hoursStudiedNum',
            'previousScoreNum',
        ));
    }

    // ─────────────────────────────────────────────────────────────
    // Helper: mapping rekomendasi teks → array teknik belajar
    // ─────────────────────────────────────────────────────────────
    private function mapRekomendasiToTeknik(string $rekomendasi, array $teknikDatabase): array
    {
        $hasil = [];

        // Cek setiap teknik apakah namanya disebut di string rekomendasi
        foreach ($teknikDatabase as $teknik) {
            foreach ($teknik['keywords'] as $keyword) {
                if (stripos($rekomendasi, $keyword) !== false) {
                    $hasil[$teknik['nama']] = $teknik; // key by nama agar tidak duplikat
                    break;
                }
            }
        }

        // Ambil maks 3, reset index
        $hasil = array_values(array_slice($hasil, 0, 3));

        // Jika kurang dari 3, tambahkan teknik default
        $defaults = ['Pomodoro', 'Active Recall', 'Feynman'];
        foreach ($defaults as $nama) {
            if (count($hasil) >= 3) break;
            $sudahAda = collect($hasil)->pluck('nama')->contains($nama);
            if (!$sudahAda) {
                $teknik = collect($teknikDatabase)->firstWhere('nama', $nama);
                if ($teknik) $hasil[] = $teknik;
            }
        }

        return array_slice($hasil, 0, 3);
    }

    // ─────────────────────────────────────────────────────────────
    // Helper: database teknik belajar lengkap
    // ─────────────────────────────────────────────────────────────
    private function getTeknikDatabase(): array
    {
        return [
            [
                'nama'        => 'Pomodoro',
                'ikon'        => '🍅',
                'img'         => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=600',
                'keywords'    => ['Pomodoro'],
                'desc'        => 'Teknik belajar dengan membagi waktu menjadi sesi fokus 25 menit yang diselingi istirahat singkat untuk menjaga konsentrasi.',
                'penjelasan'  => 'Teknik Pomodoro adalah metode belajar atau bekerja dengan membagi waktu menjadi sesi fokus 25 menit yang diselingi istirahat singkat 5 menit. Setelah 4 sesi, ambil istirahat lebih panjang 15–30 menit. Metode ini terbukti meningkatkan fokus, mengurangi kelelahan mental, dan membantu manajemen waktu belajar.',
                'cara'        => [
                    'Belajar 25 menit (fokus penuh, tidak ada gangguan)',
                    'Istirahat 5 menit — berdiri, minum, atau jalan sebentar',
                    'Ulangi 4 siklus, lalu istirahat panjang 15–30 menit',
                ],
            ],
            [
                'nama'        => 'Active Recall',
                'ikon'        => '🔁',
                'img'         => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=600',
                'keywords'    => ['Active Recall'],
                'desc'        => 'Teknik menguji ingatan secara aktif tanpa melihat catatan untuk memperkuat memori jangka panjang.',
                'penjelasan'  => 'Active Recall adalah teknik belajar dengan mengingat informasi secara aktif tanpa melihat catatan. Alih-alih membaca ulang, kamu menutup buku lalu mencoba mengingat kembali apa yang telah dipelajari. Teknik ini memperkuat jalur memori di otak dan jauh lebih efektif dibandingkan membaca pasif.',
                'cara'        => [
                    'Baca atau pelajari materi satu kali dengan fokus',
                    'Tutup buku dan coba ingat semua poin utama',
                    'Periksa ulang dan ulangi bagian yang terlupakan',
                ],
            ],
            [
                'nama'        => 'Spaced Repetition',
                'ikon'        => '📅',
                'img'         => 'https://images.unsplash.com/photo-1516534775068-ba3e7458af70?w=600',
                'keywords'    => ['Spaced Repetition'],
                'desc'        => 'Teknik mengulang materi pada interval waktu yang semakin panjang agar informasi tersimpan lebih lama di memori.',
                'penjelasan'  => 'Spaced Repetition adalah teknik mengulang materi pada interval waktu yang semakin lama seiring bertambahnya penguasaan materi. Alih-alih belajar sekaligus (cramming), kamu mengulas materi hari ini, lalu 2 hari lagi, lalu seminggu lagi. Teknik ini sangat efektif untuk hafalan jangka panjang.',
                'cara'        => [
                    'Pelajari materi baru hari ini',
                    'Ulangi setelah 1 hari, lalu 3 hari, lalu 1 minggu',
                    'Gunakan flashcard (fisik atau aplikasi seperti Anki)',
                ],
            ],
            [
                'nama'        => 'Feynman',
                'ikon'        => '🧑‍🏫',
                'img'         => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?w=600',
                'keywords'    => ['Feynman', 'Feynman Technique'],
                'desc'        => 'Metode memahami konsep rumit dengan cara menjelaskannya kembali menggunakan bahasa sesederhana mungkin.',
                'penjelasan'  => 'Metode Feynman adalah teknik belajar cepat untuk memahami konsep sulit dengan cara menjelaskan ulang materi menggunakan bahasa yang sederhana, seolah-olah kamu sedang mengajarkannya kepada orang lain yang baru belajar. Jika ada bagian yang sulit dijelaskan, itu sinyal untuk kembali belajar bagian tersebut.',
                'cara'        => [
                    'Pilih satu konsep yang ingin dipahami',
                    'Jelaskan konsep tersebut seolah mengajar orang awam',
                    'Identifikasi bagian yang sulit dijelaskan dan pelajari ulang',
                ],
            ],
            [
                'nama'        => 'Interleaving',
                'ikon'        => '🔀',
                'img'         => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=600',
                'keywords'    => ['Interleaving'],
                'desc'        => 'Teknik mencampur beberapa topik berbeda dalam satu sesi belajar agar otak lebih adaptif dalam memecahkan masalah.',
                'penjelasan'  => 'Interleaving adalah teknik belajar dengan mencampur beberapa topik atau mata pelajaran berbeda dalam satu sesi belajar, daripada menyelesaikan satu topik hingga tuntas sebelum pindah ke topik lain. Meski terasa lebih sulit, teknik ini terbukti meningkatkan kemampuan problem-solving dan transfer pengetahuan.',
                'cara'        => [
                    'Bagi sesi belajar menjadi 3 blok topik berbeda',
                    'Pindah topik setiap 20–30 menit meskipun belum selesai',
                    'Evaluasi pemahaman setiap topik di akhir sesi',
                ],
            ],
            [
                'nama'        => 'SQ3R',
                'ikon'        => '📖',
                'img'         => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=600',
                'keywords'    => ['SQ3R'],
                'desc'        => 'Metode membaca aktif: Survey, Question, Read, Recite, Review untuk memaksimalkan pemahaman dari teks.',
                'penjelasan'  => 'SQ3R adalah metode membaca terstruktur yang terdiri dari 5 langkah: Survey (tinjau sekilas), Question (buat pertanyaan), Read (baca untuk menjawab), Recite (ceritakan kembali), dan Review (ulang keseluruhan). Metode ini sangat efektif untuk memahami teks akademis yang panjang dan padat.',
                'cara'        => [
                    'Survey: pindai judul, subjudul, dan ringkasan',
                    'Question: ubah setiap judul menjadi pertanyaan',
                    'Read, Recite, Review: baca, jawab pertanyaan, dan tinjau ulang',
                ],
            ],
            [
                'nama'        => 'Jadwal Terstruktur',
                'ikon'        => '🗓️',
                'img'         => 'https://images.unsplash.com/photo-1506784365847-bbad939e9335?w=600',
                'keywords'    => ['jadwal belajar terstruktur', 'target belajar harian'],
                'desc'        => 'Membuat jadwal belajar harian yang terstruktur dengan target spesifik untuk meningkatkan konsistensi.',
                'penjelasan'  => 'Jadwal Terstruktur adalah metode belajar dengan membuat rencana harian yang jelas — menentukan waktu belajar tetap, target per mata pelajaran, dan evaluasi rutin. Konsistensi jadwal terbukti meningkatkan produktivitas dan mengurangi kebiasaan menunda belajar (prokrastinasi).',
                'cara'        => [
                    'Tentukan waktu belajar tetap setiap hari (minimal 2 jam)',
                    'Bagi waktu per mata pelajaran dengan target yang jelas',
                    'Evaluasi pencapaian setiap malam sebelum tidur',
                ],
            ],
        ];
    }

    // ─────────────────────────────────────────────────────────────
    // Helper: label ramah untuk nama kategori DB
    // ─────────────────────────────────────────────────────────────
    private function labelKategori(string $kategori): string
    {
        return match ($kategori) {
            'Sleep_Hours'         => 'Pola Tidur',
            'Access_to_Resources' => 'Akses Sumber Belajar',
            'Motivation_Level'    => 'Motivasi Belajar',
            'Les'                 => 'Les / Bimbingan Belajar',
            'Kesulitan_Belajar'   => 'Kesulitan Belajar',
            default               => $kategori,
        };
    }
}