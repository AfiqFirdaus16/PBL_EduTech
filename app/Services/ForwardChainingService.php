<?php
namespace App\Services;

class ForwardChainingService
{
    /**
     * Menentukan Risk Level dan Rekomendasi Belajar
     *
     * Parameter $data:
     *   attendance_cat  — HIGH/MEDIUM/LOW  (SIAKAD)
     *   hours_cat       — HIGH/MEDIUM/LOW  (SIAKAD)
     *   score_cat       — HIGH/MEDIUM/LOW  (SIAKAD)
     *   sleep_cat       — HIGH/MEDIUM/LOW  (kuis)
     *   resource_cat    — HIGH/MEDIUM/LOW  (kuis)
     *   motivation_cat  — HIGH/MEDIUM/LOW  (kuis)
     *   tutor_cat       — HIGH/MEDIUM/LOW  (kuis)
     *   kesulitan_cat   — HIGH/MEDIUM/LOW  (kuis)
     */
    public function proses(array $data): array
    {
        $attendance = $data['attendance_cat'] ?? null;
        $sleep      = $data['sleep_cat']      ?? null;
        $study      = $data['hours_cat']      ?? null;
        $resource   = $data['resource_cat']   ?? null;
        $motivation = $data['motivation_cat'] ?? null;
        $tutor      = $data['tutor_cat']      ?? null;
        $score      = $data['score_cat']      ?? null;
        $kesulitan  = $data['kesulitan_cat']  ?? null;

        // ────────────────────────────────────────────────────────
        // RULE 1 — LOW risk
        // Semua faktor (SIAKAD + kuis) harus bagus
        // Syarat: SIAKAD bagus DAN minimal 3 dari 5 faktor kuis LOW
        // ────────────────────────────────────────────────────────
        $siakadBagus = (
            $attendance === 'LOW' &&
            $study === 'LOW' &&
            $score === 'LOW'
        );
        $kuisLowCount = collect([
            $sleep, $resource, $motivation, $tutor, $kesulitan
        ])->filter(fn($v) => $v === 'LOW')->count();

        if ($siakadBagus && $kuisLowCount >= 3) {
            return [
                'risk'        => 'LOW',
                'rekomendasi' => 'Pertahankan pola belajar dengan Active Recall dan Spaced Repetition',
            ];
        }

        // ────────────────────────────────────────────────────────
        // RULE 2 — HIGH risk
        // SIAKAD buruk semua + kuis buruk semua
        // ────────────────────────────────────────────────────────
        $siakadBuruk = (
            $attendance === 'HIGH' &&
            $study === 'HIGH' &&
            $score === 'HIGH'
        );

        $kuisHighCount = collect([
            $sleep, $resource, $motivation, $tutor, $kesulitan
        ])->filter(fn($v) => $v === 'HIGH')->count();

        if ($siakadBuruk && $kuisHighCount >= 3) {
            return [
                'risk'        => 'HIGH',
                'rekomendasi' => 'Pomodoro, Active Recall, dan jadwal belajar terstruktur',
            ];
        }

        // ────────────────────────────────────────────────────────
        // RULE 3 — HIGH risk
        // Mayoritas faktor gabungan HIGH (≥5 dari 8 faktor)
        // ────────────────────────────────────────────────────────
        $semuaFaktor = [$attendance, $sleep, $study, $resource, $motivation, $tutor, $score, $kesulitan];
        $totalHigh   = collect($semuaFaktor)->filter(fn($v) => $v === 'HIGH')->count();
        $totalLow    = collect($semuaFaktor)->filter(fn($v) => $v === 'LOW')->count();

        if ($totalHigh >= 5) {
            return [
                'risk'        => 'HIGH',
                'rekomendasi' => 'Pomodoro dan target belajar harian',
            ];
        }

        // ────────────────────────────────────────────────────────
        // RULE 4 — MEDIUM risk
        // Pola tidur buruk + kehadiran sedang
        // ────────────────────────────────────────────────────────
        if ($sleep === 'HIGH' && $attendance === 'MEDIUM') {
            return [
                'risk'        => 'MEDIUM',
                'rekomendasi' => 'Perbaiki jam tidur dan gunakan teknik Interleaving',
            ];
        }

        // ────────────────────────────────────────────────────────
        // RULE 5 — MEDIUM risk
        // Akses sumber belajar buruk
        // ────────────────────────────────────────────────────────
        if ($resource === 'HIGH') {
            return [
                'risk'        => 'MEDIUM',
                'rekomendasi' => 'Gunakan sumber belajar digital gratis dan SQ3R',
            ];
        }

        // ────────────────────────────────────────────────────────
        // RULE 6 — LOW risk
        // Mayoritas faktor LOW (≥5 dari 8)
        // ────────────────────────────────────────────────────────
        if ($totalLow >= 5) {
            return [
                'risk'        => 'LOW',
                'rekomendasi' => 'Pertahankan pola belajar dengan Active Recall dan Spaced Repetition',
            ];
        }

        // ────────────────────────────────────────────────────────
        // DEFAULT — MEDIUM
        // ────────────────────────────────────────────────────────
        return [
            'risk'        => 'MEDIUM',
            'rekomendasi' => 'Active Recall dan Feynman Technique',
        ];
    }
}