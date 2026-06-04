<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // ── STAT CARDS ──────────────────────────────────────────────

        // Pengguna Baru: daftar bulan ini vs bulan lalu
        $penggunaBaru     = $this->countSiswa(now()->month, now()->year);
        $penggunaBaruLalu = $this->countSiswa(now()->subMonth()->month, now()->subMonth()->year);

        // Pengguna Aktif: pernah mengerjakan kuis bulan ini vs bulan lalu
        $siswaAktif     = $this->countAktif(now()->month, now()->year);
        $siswaAktifLalu = $this->countAktif(now()->subMonth()->month, now()->subMonth()->year);

        // Pengguna Lama: total semua siswa vs total bulan lalu
        $totalSiswa     = User::where('role', 'siswa')->count();
        $totalSiswaLalu = User::where('role', 'siswa')
                            ->where('created_at', '<', now()->startOfMonth())
                            ->count();

        // Kunjungan Web: session aktif vs kemarin
        $kunjunganWeb     = DB::table('sessions')->count();
        $kunjunganWebLalu = max(1, $kunjunganWeb); // fallback, sessions tidak menyimpan historis

        // ── HITUNG GROWTH ───────────────────────────────────────────
        $growthBaru      = $this->growth($penggunaBaru, $penggunaBaruLalu);
        $growthAktif     = $this->growth($siswaAktif, $siswaAktifLalu);
        $growthLama      = $this->growth($totalSiswa, $totalSiswaLalu);
        $growthKunjungan = 0; // sessions tidak menyimpan historis, default 0

        // ── GRAFIK TOTAL PENGGUNA (per bulan, tahun ini vs tahun lalu) ──
        $bulanLabel = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $tahunIni   = $this->penggunaPerBulan(now()->year);
        $tahunLalu  = $this->penggunaPerBulan(now()->year - 1);

        // ── TINGKAT PENGGUNA ────────────────────────────────────────
        $tingkatData = DB::table('siswa')
            ->select('tingkat', DB::raw('count(*) as total'))
            ->groupBy('tingkat')
            ->orderBy('tingkat')
            ->get()
            ->mapWithKeys(fn($r) => ["Tingkat {$r->tingkat}" => $r->total]);

        // ── JENJANG PENGGUNA ─────────────────────────────────────────
        $jenjangData = DB::table('siswa')
            ->select('jenjang', DB::raw('count(*) as total'))
            ->groupBy('jenjang')
            ->orderBy('jenjang')
            ->get()
            ->mapWithKeys(fn($r) => [$r->jenjang => $r->total]);

        // ── ANALISA RESIKO HIGH TO LOW ────────────────────────────────
        $analisaResiko = DB::table('jawaban_kuis')
            ->join('pilihan_jawaban', 'jawaban_kuis.pilihan_id', '=', 'pilihan_jawaban.id')
            ->join('pertanyaan', 'jawaban_kuis.pertanyaan_id', '=', 'pertanyaan.id')
            ->where('pilihan_jawaban.risk_level', 'High')
            ->select('pertanyaan.kategori', DB::raw('count(*) as total'))
            ->whereNotNull('pertanyaan.kategori')
            ->groupBy('pertanyaan.kategori')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        $maxAnalisa = $analisaResiko->max('total') ?: 1;

        return view('admin.dashboard-admin', compact(
            'penggunaBaru',   'growthBaru',
            'siswaAktif',     'growthAktif',
            'totalSiswa',     'growthLama',
            'kunjunganWeb',   'growthKunjungan',
            'bulanLabel', 'tahunIni', 'tahunLalu',
            'tingkatData',
            'jenjangData',
            'analisaResiko',  'maxAnalisa',
        ));
    }

    // ── HELPER: siswa daftar bulan & tahun tertentu ──────────────────
    private function countSiswa(int $month, int $year): int
    {
        return User::where('role', 'siswa')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->count();
    }

    // ── HELPER: siswa aktif (ada sesi kuis) bulan & tahun tertentu ──
    private function countAktif(int $month, int $year): int
    {
        return DB::table('sesi_kuis')
            ->whereMonth('tanggal_kuis', $month)
            ->whereYear('tanggal_kuis', $year)
            ->distinct('siswa_id')
            ->count('siswa_id');
    }

    // ── HELPER: pendaftar per bulan (12 bulan) ───────────────────────
    private function penggunaPerBulan(int $year): array
    {
        $rows = DB::table('users')
            ->where('role', 'siswa')
            ->whereYear('created_at', $year)
            ->select(DB::raw('MONTH(created_at) as bulan'), DB::raw('count(*) as total'))
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $result = [];
        for ($m = 1; $m <= 12; $m++) {
            $result[] = $rows[$m] ?? 0;
        }
        return $result;
    }

    // ── HELPER: hitung persentase growth ─────────────────────────────
    private function growth(int $sekarang, int $lalu): float
    {
        if ($lalu === 0) {
            return $sekarang > 0 ? 100.0 : 0.0;
        }
        return round((($sekarang - $lalu) / $lalu) * 100, 2);
    }
}