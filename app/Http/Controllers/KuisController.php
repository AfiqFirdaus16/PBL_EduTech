<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        5 => 'kesulitan_belajar',
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
        // Ambil pertanyaan untuk step ini agar bisa validasi dinamis
        $kategori    = $this->kategoriUrutan[$step];
        $pertanyaan  = \App\Models\Pertanyaan::where('kategori', $kategori)->get();

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
        $jawaban = session('jawaban', []);

        if (empty($jawaban)) {
            return redirect()->route('kuis.show', 1);
        }

        // Hitung risk per kategori
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

            // Tentukan risk dominan
            arsort($skor);
            $riskDominan = array_key_first($skor);

            $riskPerKategori[$kategori] = [
                'skor'        => $skor,
                'risk'        => $riskDominan,
                'label'       => $this->labelKategori($kategori),
            ];
        }

        // Risk keseluruhan (majority vote)
        $allRisks    = array_column($riskPerKategori, 'risk');
        $riskCounts  = array_count_values($allRisks);
        arsort($riskCounts);
        $riskTotal   = array_key_first($riskCounts);

        // Hapus session setelah selesai
        session()->forget('jawaban');

        return view('page.hasil', compact('riskPerKategori', 'riskTotal'));
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
            'kesulitan_belajar'    => 'Kesulitan Belajar',
            default                => $kategori,
        };
    }

    // ─────────────────────────────────────────────────────────────
    // Function Model: Forward Chaining
    // ─────────────────────────────────────────────────────────────
    public function proses(Request $request)
    {
        $forward = new ForwardChainingService();

        $data = [
            'hours'      => $request->hours_studied,
            'score'      => $request->previous_scores,
            'sleep'      => $request->sleep_hours,
            'resource'   => $request->access_to_resources,
            'motivation' => $request->motivation_level,
            'tutor'      => $request->tutoring_sessions,
        ];

        $risk = $forward->riskLevel($data);

        $rekomendasi = $forward->rekomendasi(
            $data,
            $risk
        );

        dd([
            'risk' => $risk,
            'rekomendasi' => $rekomendasi
        ]);
    }
}
