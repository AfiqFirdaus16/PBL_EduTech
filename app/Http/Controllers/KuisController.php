<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pertanyaan;
use App\Services\ForwardChainingService;

class KuisController extends Controller
{
    /**
     * Daftar kategori kuis secara berurutan.
     * Urutan ini menentukan halaman ke-1 s/d ke-5.
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

        // Buat aturan validasi: setiap q_{id} wajib diisi
        $rules = [];
        foreach ($pertanyaan as $p) {
            $rules["q_{$p->id}"] = 'required|integer|exists:pilihan_jawaban,id';
        }

        $validated = $request->validate($rules);

        // Gabungkan jawaban ke session
        $jawaban = session('jawaban', []);
        foreach ($validated as $key => $pilihanId) {
            $jawaban[$key] = (int) $pilihanId;
        }
        session(['jawaban' => $jawaban]);

        // Langkah terakhir → ke halaman hasil
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
        $siswaId = Auth::user()->siswa->id ?? null;
        $jawaban = session('jawaban', []);

        // =========================================================================
        // SKENARIO A: SISWA BARU SAJA SELESAI KUIS (Hitung, Forward Chaining, & Simpan DB)
        // =========================================================================
        if (!empty($jawaban)) {
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
                        if ($pilihan) $skor[$pilihan->risk_level]++;
                    }
                }
                arsort($skor);
                $riskDominan = array_key_first($skor);

        // Hitung risk per kategori
        $riskPerKategori = [];

            $allRisks   = array_column($riskPerKategori, 'risk');
            $riskCounts = array_count_values($allRisks);
            arsort($riskCounts);
            $riskTotal = array_key_first($riskCounts);

            $forward      = new ForwardChainingService();
            $hasilForward = $forward->proses([
                'attendance_cat' => 'HIGH',
                'sleep_cat'      => strtoupper($riskPerKategori['Sleep_Hours']['risk']),
                'hours_cat'      => 'MEDIUM',
                'resource_cat'   => strtoupper($riskPerKategori['Access_to_Resources']['risk']),
                'motivation_cat' => strtoupper($riskPerKategori['Motivation_Level']['risk']),
                'tutor_cat'      => strtoupper($riskPerKategori['Les']['risk']),
                'score_cat'      => 'HIGH',
            ]);

            $skor = ['Low' => 0, 'Medium' => 0, 'High' => 0];

            if ($siswaId) {
                $sesiId = DB::table('sesi_kuis')->insertGetId([
                    'siswa_id'     => $siswaId,
                    'tanggal_kuis' => now(),
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);

                $insertJawaban = [];
                foreach ($jawaban as $key => $pilihanId) {
                    $pertanyaanId    = str_replace('q_', '', $key);
                    $insertJawaban[] = [
                        'sesi_id'       => $sesiId,
                        'pertanyaan_id' => $pertanyaanId,
                        'pilihan_id'    => $pilihanId,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ];
                }
                DB::table('jawaban_kuis')->insert($insertJawaban);

                DB::table('hasil_analisa')->insert([
                    'sesi_id'     => $sesiId,
                    'risk_level'  => $riskTotal,
                    'rekomendasi' => $rekomendasi,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }

            // Tentukan risk dominan
            arsort($skor);
            $riskDominan = array_key_first($skor);

            // TODO: ganti dengan data real dari SIAKAD API
            $attendanceCat    = 'HIGH';
            $attendanceNum    = 85;
            $hoursCat         = 'MEDIUM';
            $hoursStudiedNum  = 3;
            $scoreCat         = 'HIGH';
            $previousScoreNum = 78;
            $teknikBelajar    = $this->getTeknikBelajar($rekomendasi ?? '');

            return view('page.hasil', compact(
                'riskPerKategori', 'riskTotal', 'rekomendasi',
                'attendanceCat', 'attendanceNum',
                'hoursCat', 'hoursStudiedNum',
                'scoreCat', 'previousScoreNum',
                'teknikBelajar',
            ));
        }

        // Risk keseluruhan (majority vote)
        $allRisks    = array_column($riskPerKategori, 'risk');
        $riskCounts  = array_count_values($allRisks);
        arsort($riskCounts);
        $riskTotal   = array_key_first($riskCounts);

        // ====================================================
        // DUMMY DATA SIAKAD (sementara)
        // Nanti diganti API SIAKAD
        // ====================================================

        $attendanceCat = 'HIGH';
        $hoursCat      = 'MEDIUM';
        $scoreCat      = 'HIGH';

        // dari hasil kuis
        $sleepCat = strtoupper(
            $riskPerKategori['Sleep_Hours']['risk']
        );

        $resourceCat = strtoupper(
            $riskPerKategori['Access_to_Resources']['risk']
        );

        $motivationCat = strtoupper(
            $riskPerKategori['Motivation_Level']['risk']
        );

        $tutorCat = strtoupper(
            $riskPerKategori['Les']['risk']
        );

        $kesulitanBelajar = strtoupper(
            $riskPerKategori['Kesulitan_Belajar']['risk']
        );

        // ─────────────────────────────────────────────────────────────
        // Function Model: Forward Chaining
        // ─────────────────────────────────────────────────────────────
        $forward = new ForwardChainingService();

        $hasilForward = $forward->proses([
            'attendance_cat' => $attendanceCat,
            'sleep_cat'      => $sleepCat,
            'hours_cat'      => $hoursCat,
            'resource_cat'   => $resourceCat,
            'motivation_cat' => $motivationCat,
            'tutor_cat'      => $tutorCat,
            'score_cat'      => $scoreCat,
        ]);

        $riskTotal = $hasilForward['risk'] ?? $riskTotal;
        $rekomendasi = $hasilForward['rekomendasi'] ?? null;

        // ====================================================
        // 🚀 PROSES SIMPAN KE DATABASE (SESUAI SKEMA GAMBAR)
        // ====================================================
        $siswaId = \Illuminate\Support\Facades\Auth::user()->siswa->id ?? null;

        if ($siswaId) {
            $latestSesi = DB::table('sesi_kuis')
                ->where('siswa_id', $siswaId)
                ->orderByDesc('tanggal_kuis')
                ->first();

            if ($latestSesi) {
                $hasilAnalisa = DB::table('hasil_analisa')
                    ->where('sesi_id', $latestSesi->id)
                    ->first();

                $riskTotal   = $hasilAnalisa->risk_level ?? 'Medium';
                $rekomendasi = $hasilAnalisa->rekomendasi ?? null;

                $jawabanDB = DB::table('jawaban_kuis')
                    ->join('pertanyaan', 'jawaban_kuis.pertanyaan_id', '=', 'pertanyaan.id')
                    ->join('pilihan_jawaban', 'jawaban_kuis.pilihan_id', '=', 'pilihan_jawaban.id')
                    ->where('jawaban_kuis.sesi_id', $latestSesi->id)
                    ->select('pertanyaan.kategori', 'pilihan_jawaban.risk_level')
                    ->get();

                $riskPerKategori = [];
                foreach ($this->kategoriUrutan as $kategori) {
                    $skor = ['Low' => 0, 'Medium' => 0, 'High' => 0];
                    foreach ($jawabanDB as $j) {
                        if ($j->kategori === $kategori && isset($skor[$j->risk_level])) {
                            $skor[$j->risk_level]++;
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

                // TODO: ganti dengan data real dari SIAKAD API
                $attendanceCat    = 'HIGH';
                $attendanceNum    = 85;
                $hoursCat         = 'MEDIUM';
                $hoursStudiedNum  = 3;
                $scoreCat         = 'HIGH';
                $previousScoreNum = 78;
                $teknikBelajar    = $this->getTeknikBelajar($rekomendasi ?? '');

                return view('page.hasil', compact(
                    'riskPerKategori', 'riskTotal', 'rekomendasi',
                    'attendanceCat', 'attendanceNum',
                    'hoursCat', 'hoursStudiedNum',
                    'scoreCat', 'previousScoreNum',
                    'teknikBelajar',
                ));
            }
            // Insert massal ke tabel jawaban_kuis
            \Illuminate\Support\Facades\DB::table('jawaban_kuis')->insert($insertJawaban);

            // 3. Simpan Hasil Analisa Akhir
            \Illuminate\Support\Facades\DB::table('hasil_analisa')->insert([
                'sesi_id' => $sesiId, // Di gambar Anda nama kolomnya sesi_id
                'risk_level' => $riskTotal,
                'rekomendasi' => $rekomendasi,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Hapus session setelah selesai
        session()->forget('jawaban');

        return view('page.hasil', compact('riskPerKategori', 'riskTotal', 'rekomendasi'));
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

    // ─────────────────────────────────────────────────────────────
    // Helper: ambil top 3 teknik belajar berdasarkan rekomendasi
    // ─────────────────────────────────────────────────────────────
    private function getTeknikBelajar(string $rekomendasi): array
    {
        $semua = [
            [
                'nama'       => 'Pomodoro',
                'desc'       => 'Belajar fokus 25 menit, istirahat 5 menit.',
                'penjelasan' => 'Teknik Pomodoro membantu menjaga konsentrasi dengan membagi waktu belajar menjadi sesi pendek yang terstruktur sehingga otak tidak mudah lelah.',
                'img'        => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600',
                'cara'       => [
                    'Siapkan timer selama 25 menit',
                    'Fokus penuh tanpa gangguan selama timer berjalan',
                    'Istirahat 5 menit setelah satu sesi selesai',
                    'Setiap 4 sesi, ambil istirahat panjang 15–30 menit',
                ],
            ],
            [
                'nama'       => 'Active Recall',
                'desc'       => 'Mengingat kembali materi tanpa melihat catatan.',
                'penjelasan' => 'Aktif mengambil informasi dari memori terbukti jauh lebih efektif daripada sekadar membaca ulang catatan.',
                'img'        => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?w=600',
                'cara'       => [
                    'Pelajari materi selama 20–30 menit',
                    'Tutup semua catatan dan buku',
                    'Tulis atau ucapkan kembali apa yang kamu ingat',
                    'Cek dan koreksi bagian yang salah atau terlupa',
                ],
            ],
            [
                'nama'       => 'Spaced Repetition',
                'desc'       => 'Ulang materi di interval waktu yang makin panjang.',
                'penjelasan' => 'Mengulang materi secara berkala sebelum benar-benar lupa akan memperkuat memori jangka panjang secara signifikan.',
                'img'        => 'https://images.unsplash.com/photo-1512314889357-e157c22f938d?w=600',
                'cara'       => [
                    'Pelajari materi baru hari ini',
                    'Ulang keesokan harinya, lalu 3 hari lagi, lalu seminggu lagi',
                    'Gunakan flashcard atau aplikasi seperti Anki',
                    'Fokus lebih lama pada materi yang sering terlupa',
                ],
            ],
            [
                'nama'       => 'Feynman Technique',
                'desc'       => 'Jelaskan materi seolah mengajar orang lain.',
                'penjelasan' => 'Dengan menjelaskan konsep menggunakan bahasa sederhana, kamu akan tahu persis bagian mana yang belum benar-benar dipahami.',
                'img'        => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=600',
                'cara'       => [
                    'Pilih satu konsep yang ingin dipahami',
                    'Jelaskan konsep itu dengan kata-kata sendiri seperti mengajar anak SD',
                    'Identifikasi bagian yang masih bingung atau macet',
                    'Kembali ke sumber belajar dan pelajari ulang bagian tersebut',
                ],
            ],
            [
                'nama'       => 'Mind Mapping',
                'desc'       => 'Visualisasi konsep dalam diagram cabang.',
                'penjelasan' => 'Mind map membantu melihat hubungan antar konsep secara menyeluruh sehingga lebih mudah dipahami dan diingat.',
                'img'        => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=600',
                'cara'       => [
                    'Tulis topik utama di tengah halaman',
                    'Buat cabang untuk setiap subtopik',
                    'Tambahkan detail kecil di tiap cabang',
                    'Gunakan warna dan gambar agar lebih mudah diingat',
                ],
            ],
            [
                'nama'       => 'Interleaving',
                'desc'       => 'Campur beberapa topik dalam satu sesi belajar.',
                'penjelasan' => 'Belajar dengan mengganti-ganti topik membuat otak bekerja lebih keras sehingga pemahaman dan retensi menjadi lebih kuat.',
                'img'        => 'https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?w=600',
                'cara'       => [
                    'Siapkan 2–3 topik berbeda yang ingin dipelajari',
                    'Belajar topik pertama selama 20 menit',
                    'Beralih ke topik kedua tanpa jeda panjang',
                    'Rotasi antar topik hingga semua selesai',
                ],
            ],
            [
                'nama'       => 'SQ3R',
                'desc'       => 'Survey, Question, Read, Recite, Review.',
                'penjelasan' => 'Metode membaca aktif yang terstruktur agar setiap halaman yang dibaca benar-benar dipahami dan tersimpan dalam memori.',
                'img'        => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=600',
                'cara'       => [
                    'Survey: baca judul, subjudul, dan gambar secara cepat',
                    'Question: ubah setiap subjudul menjadi pertanyaan',
                    'Read: baca untuk menjawab pertanyaan yang sudah dibuat',
                    'Recite & Review: rangkum jawabannya lalu tinjau ulang',
                ],
            ],
        ];

        // ── FIX: Cocokkan keyword rekomendasi dengan nama teknik ──
        $hasil = [];
        foreach ($semua as $teknik) {
            if (stripos($rekomendasi, $teknik['nama']) !== false) {
                $hasil[] = $teknik;
            }
        }

        // ── FIX: Kalau kurang dari 3, tambahin dari sisa array ──
        if (count($hasil) < 3) {
            foreach ($semua as $teknik) {
                $sudahAda = array_filter($hasil, fn($t) => $t['nama'] === $teknik['nama']);
                if (empty($sudahAda)) {
                    $hasil[] = $teknik;
                }
                if (count($hasil) === 3) break;
            }
        }

        return $hasil;
    }
}