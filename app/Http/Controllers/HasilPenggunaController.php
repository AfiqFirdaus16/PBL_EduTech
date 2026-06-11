<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HasilAnalisa;
use Illuminate\Http\Request;

class HasilPenggunaController extends Controller
{
    private array $allowedSortColumns = [
        'attendance',
        'sleep_hours',
        'hours_studied',
        'access_to_resources',
        'motivation_level',
        'tutoring_sessions',
        'previous_scores',
        'kesulitan_belajar',
    ];

    private function applyFilters($query, Request $request)
    {
        // Filter Tingkat Risiko
        if ($request->filled('risk_level')) {
            $query->where('risk_level', $request->risk_level);
        }

        // Search Server-Side Fallback (Jika admin pindah halaman paginasi)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('sesiKuis.siswa', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($qu) use ($search) {
                        $qu->where('username', 'like', "%{$search}%");
                    });
            });
        }

        // Pengurutan Variabel
        if ($request->filled('sort_by') && in_array($request->sort_by, $this->allowedSortColumns)) {
            $query->orderBy($request->sort_by, 'asc');
        } else {
            $query->latest('created_at');
        }

        return $query;
    }

    public function index(Request $request)
    {
        // Memanggil Eager Loading yang sudah diperbaiki relasinya
        $query = HasilAnalisa::with(['sesiKuis.siswa.user']);

        $this->applyFilters($query, $request);

        $hasilAnalisa = $query->paginate(10);

        return view('admin.hasil-pengguna', compact('hasilAnalisa'));
    }

    public function export(Request $request)
    {
        $query = HasilAnalisa::with(['sesi.siswa.user']);

        $this->applyFilters($query, $request);

        $data = $query->get();

        $headers = [
            'No',
            'Nama',
            'Username',
            'Kehadiran (Attendance)',
            'Jam Tidur (Sleep Hours)',
            'Jam Belajar (Hours Studied)',
            'Akses Sumber Belajar (Access to Resources)',
            'Motivasi (Motivation Level)',
            'Sesi Bimbingan (Tutoring Sessions)',
            'Nilai Sebelumnya (Previous Scores)',
            'Kesulitan Belajar',
            'Tingkat Risiko',
            'Rekomendasi 1',
            'Rekomendasi 2',
            'Rekomendasi 3',
        ];

        // Format CSV agar kompatibel dengan Excel (UTF-8 BOM)
        $csvData = "\xEF\xBB\xBF";
        $csvData .= implode(',', array_map(fn($h) => '"' . $h . '"', $headers)) . "\n";

        foreach ($data as $index => $item) {

            // Pengamanan parsing rekomendasi teknik belajar dari KuisController
            $rawRec = $item->rekomendasi;
            $decoded = json_decode($rawRec, true);

            if (is_array($decoded)) {
                $rekomendasi = collect($decoded);
            } elseif (!empty($rawRec)) {
                // jika tersimpan string koma bersambung atau teks mentah campuran
                $rekomendasi = collect(explode(',', $rawRec));
            } else {
                $rekomendasi = collect([]);
            }

            $row = [
                $index + 1,
                $item->sesiKuis->siswa->nama ?? '-',
                $item->sesiKuis->siswa->user->username ?? '-',
                $item->attendance ?? '0',
                $item->sleep_hours ?? '-',
                $item->hours_studied ?? '0',
                $item->access_to_resources ?? '-',
                $item->motivation_level ?? '-',
                $item->tutoring_sessions ?? '-',
                $item->previous_scores ?? '0',
                $item->kesulitan_belajar ?? '-',
                $item->risk_level ?? 'Medium',
                trim($rekomendasi->get(0, '-')),
                trim($rekomendasi->get(1, '-')),
                trim($rekomendasi->get(2, '-')),
            ];

            $csvData .= implode(',', array_map(
                fn($cell) => '"' . str_replace('"', '""', $cell) . '"',
                $row
            )) . "\n";
        }

        $filename = 'hasil-analisis-pengguna';
        if ($request->filled('risk_level')) {
            $filename .= '-' . strtolower($request->risk_level);
        }
        if ($request->filled('sort_by')) {
            $filename .= '-sortby-' . $request->sort_by;
        }
        $filename .= '.csv';

        return response($csvData, 200, [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
