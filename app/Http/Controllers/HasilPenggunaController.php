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
        if ($request->filled('risk_level')) {
            $query->where('risk_level', $request->risk_level);
        }

        if ($request->filled('sort_by') && in_array($request->sort_by, $this->allowedSortColumns)) {
            $query->orderBy($request->sort_by, 'asc');
        } else {
            $query->latest();
        }

        return $query;
    }

    public function index(Request $request)
    {
        $query = HasilAnalisa::with(['sesiKuis.siswa.user']);

        $this->applyFilters($query, $request);

        $hasilAnalisa = $query->paginate(10);

        return view('admin.hasil-pengguna', compact('hasilAnalisa'));
    }

    public function export(Request $request)
    {
        $query = HasilAnalisa::with(['sesiKuis.siswa.user']);

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

        $csvData = implode(',', array_map(fn($h) => '"' . $h . '"', $headers)) . "\n";

        foreach ($data as $index => $item) {
            $rekomendasi = collect(
                is_array(json_decode($item->rekomendasi, true))
                    ? json_decode($item->rekomendasi, true)
                    : explode(',', $item->rekomendasi)
            );

            $row = [
                $index + 1,
                $item->sesiKuis->siswa->nama ?? '-',
                $item->sesiKuis->siswa->user->username ?? '-',
                $item->attendance ?? '-',
                $item->sleep_hours ?? '-',
                $item->hours_studied ?? '-',
                $item->access_to_resources ?? '-',
                $item->motivation_level ?? '-',
                $item->tutoring_sessions ?? '-',
                $item->previous_scores ?? '-',
                $item->kesulitan_belajar ?? '-',
                $item->risk_level,
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