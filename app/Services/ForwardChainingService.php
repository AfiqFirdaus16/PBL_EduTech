<?php

namespace App\Services;

class ForwardChainingService
{
    /**
     * Menentukan Risk Level dan Rekomendasi Belajar
     */
    public function proses(array $data): array
    {
        $attendance = $data['attendance_cat'] ?? null;
        $sleep      = $data['sleep_cat'] ?? null;
        $study      = $data['hours_cat'] ?? null;
        $resource   = $data['resource_cat'] ?? null;
        $motivation = $data['motivation_cat'] ?? null;
        $tutor      = $data['tutor_cat'] ?? null;
        $score      = $data['score_cat'] ?? null;

        /*
        ====================================================
        RULE 1
        ====================================================
        */
        if (
            $attendance === 'HIGH' &&
            $study === 'HIGH' &&
            $score === 'HIGH'
        ) {
            return [
                'risk' => 'LOW',
                'rekomendasi' =>
                    'Pertahankan pola belajar dengan Active Recall dan Spaced Repetition'
            ];
        }

        /*
        ====================================================
        RULE 2
        ====================================================
        */
        if (
            $attendance === 'LOW' &&
            $study === 'LOW' &&
            $score === 'LOW'
        ) {
            return [
                'risk' => 'HIGH',
                'rekomendasi' =>
                    'Pomodoro, Active Recall, dan jadwal belajar terstruktur'
            ];
        }

        /*
        ====================================================
        RULE 3
        ====================================================
        */
        if (
            $motivation === 'LOW' &&
            $study === 'LOW'
        ) {
            return [
                'risk' => 'HIGH',
                'rekomendasi' =>
                    'Pomodoro dan target belajar harian'
            ];
        }

        /*
        ====================================================
        RULE 4
        ====================================================
        */
        if (
            $sleep === 'LOW' &&
            $attendance === 'MEDIUM'
        ) {
            return [
                'risk' => 'MEDIUM',
                'rekomendasi' =>
                    'Perbaiki jam tidur dan gunakan teknik Interleaving'
            ];
        }

        /*
        ====================================================
        RULE 5
        ====================================================
        */
        if (
            $resource === 'LOW'
        ) {
            return [
                'risk' => 'MEDIUM',
                'rekomendasi' =>
                    'Gunakan sumber belajar digital gratis dan SQ3R'
            ];
        }

        /*
        ====================================================
        DEFAULT
        ====================================================
        */
        return [
            'risk' => 'MEDIUM',
            'rekomendasi' =>
                'Active Recall dan Feynman Technique'
        ];
    }
}