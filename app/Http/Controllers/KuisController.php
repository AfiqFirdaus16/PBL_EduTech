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

        $totalStep    = 5;
        $persen       = round((($step - 1) / $totalStep) * 100);
        $stepBerikut  = $step + 1;
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
        $kategori    = $this->kategoriUrutan[$step];
        $pertanyaan  = \App\Models\Pertanyaan::where('kategori', $kategori)->get();

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
    // Halaman hasil  →  GET /kuis/hasil (HYBRID MODE)
    // ─────────────────────────────────────────────────────────────
    public function hasil()
    {
        $siswaId = \Illuminate\Support\Facades\Auth::user()->siswa->id ?? null;
        $jawaban = session('jawaban', []);

        // =========================================================================
        // SKENARIO A: SISWA BARU SAJA SELESAI KUIS (Hitung, Forward Chaining, & Simpan DB)
        // =========================================================================
        if (!empty($jawaban)) {
            $riskPerKategori = [];

            foreach ($this->kategoriUrutan as $step => $kategori) {
                $pertanyaan = \App\Models\Pertanyaan::with('pilihanJawaban')->where('kategori', $kategori)->get();
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

                $riskPerKategori[$kategori] = [
                    'skor'  => $skor,
                    'risk'  => $riskDominan,
                    'label' => $this->labelKategori($kategori),
                ];
            }

            $allRisks   = array_column($riskPerKategori, 'risk');
            $riskCounts = array_count_values($allRisks);
            arsort($riskCounts);
            $riskTotal  = array_key_first($riskCounts);

            // ---> DI SINI LOGIKA FORWARD CHAINING ANDA TETAP BERJALAN <---
            $forward = new ForwardChainingService();
            $hasilForward = $forward->proses([
                'attendance_cat' => 'HIGH',
                'sleep_cat'      => strtoupper($riskPerKategori['Sleep_Hours']['risk']),
                'hours_cat'      => 'MEDIUM',
                'resource_cat'   => strtoupper($riskPerKategori['Access_to_Resources']['risk']),
                'motivation_cat' => strtoupper($riskPerKategori['Motivation_Level']['risk']),
                'tutor_cat'      => strtoupper($riskPerKategori['Les']['risk']),
                'score_cat'      => 'HIGH',
            ]);

            $riskTotal   = $hasilForward['risk'] ?? $riskTotal;
            $rekomendasi = $hasilForward['rekomendasi'] ?? null;

            if ($siswaId) {
                $sesiId = \Illuminate\Support\Facades\DB::table('sesi_kuis')->insertGetId([
                    'siswa_id' => $siswaId,
                    'tanggal_kuis' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $insertJawaban = [];
                foreach ($jawaban as $key => $pilihanId) {
                    $pertanyaanId = str_replace('q_', '', $key);
                    $insertJawaban[] = [
                        'sesi_id'       => $sesiId,
                        'pertanyaan_id' => $pertanyaanId,
                        'pilihan_id'    => $pilihanId,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ];
                }
                \Illuminate\Support\Facades\DB::table('jawaban_kuis')->insert($insertJawaban);

                \Illuminate\Support\Facades\DB::table('hasil_analisa')->insert([
                    'sesi_id'     => $sesiId,
                    'risk_level'  => $riskTotal,
                    'rekomendasi' => $rekomendasi,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }

            session()->forget('jawaban');

            return view('page.hasil', compact('riskPerKategori', 'riskTotal', 'rekomendasi'));
        }

        // =========================================================================
        // SKENARIO B: SISWA KLIK DARI NAVBAR / LOGIN ULANG (Ambil dari Database)
        // =========================================================================
        if ($siswaId) {
            $latestSesi = \Illuminate\Support\Facades\DB::table('sesi_kuis')
                ->where('siswa_id', $siswaId)
                ->orderByDesc('tanggal_kuis')
                ->first();

            if ($latestSesi) {
                $hasilAnalisa = \Illuminate\Support\Facades\DB::table('hasil_analisa')->where('sesi_id', $latestSesi->id)->first();
                $riskTotal   = $hasilAnalisa->risk_level ?? 'Medium';
                $rekomendasi = $hasilAnalisa->rekomendasi ?? null;

                $jawabanDB = \Illuminate\Support\Facades\DB::table('jawaban_kuis')
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

                return view('page.hasil', compact('riskPerKategori', 'riskTotal', 'rekomendasi'));
            }
        }

        // =========================================================================
        // SKENARIO C: BENAR-BENAR BELUM KUIS
        // =========================================================================
        return redirect()->route('kuis.show', 1)->with('info', 'Silakan selesaikan kuis terlebih dahulu.');
    }

    // ─────────────────────────────────────────────────────────────
    // Helper: label ramah untuk nama kategori DB
    // ─────────────────────────────────────────────────────────────
    private function labelKategori(string $kategori): string
    {
        return match ($kategori) {
            'Sleep_Hours'          => 'Pola Tidur',
            'Access_to_Resources'  => 'Akses Sumber Belajar',
            'Motivation_Level'     => 'Motivasi Belajar',
            'Les'                  => 'Les / Bimbingan Belajar',
            'Kesulitan_Belajar'    => 'Kesulitan Belajar',
            default                => $kategori,
        };
    }
}
