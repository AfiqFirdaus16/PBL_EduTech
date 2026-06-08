<?php

namespace App\Services;

class ForwardChainingService
{
    public function catHours($x)
    {
        if ($x <= 4) {
            return 'HIGH';
        } elseif ($x <= 7) {
            return 'MEDIUM';
        }

        return 'LOW';
    }

    public function catScore($x)
    {
        if ($x < 60) {
            return 'HIGH';
        } elseif ($x < 75) {
            return 'MEDIUM';
        }

        return 'LOW';
    }

    public function catSleep($x)
    {
        if ($x < 6) {
            return 'HIGH';
        } elseif ($x <= 8) {
            return 'MEDIUM';
        }

        return 'LOW';
    }

    public function catText($x)
    {
        if ($x == 'High') {
            return 'LOW';
        }

        if ($x == 'Medium') {
            return 'MEDIUM';
        }

        return 'HIGH';
    }

    public function catTutor($x)
    {
        if ($x == 0) {
            return 'HIGH';
        }

        if ($x == 1) {
            return 'MEDIUM';
        }

        return 'LOW';
    }

    public function riskLevel($data)
    {
        $kategori = [
            $this->catHours($data['hours']),
            $this->catScore($data['score']),
            $this->catSleep($data['sleep']),
            $this->catText($data['resource']),
            $this->catText($data['motivation']),
            $this->catTutor($data['tutor']),
        ];

        $high = count(array_filter($kategori, fn($v) => $v == 'HIGH'));
        $medium = count(array_filter($kategori, fn($v) => $v == 'MEDIUM'));
        $low = count(array_filter($kategori, fn($v) => $v == 'LOW'));

        if ($high >= 4) {
            return 'HIGH RISK';
        }

        if ($high >= 2) {
            return 'MEDIUM RISK';
        }

        return 'LOW RISK';
    }

    public function rekomendasi($data, $risk)
    {
        $hours = $this->catHours($data['hours']);
        $score = $this->catScore($data['score']);
        $sleep = $this->catSleep($data['sleep']);

        $resource = $this->catText($data['resource']);
        $motivation = $this->catText($data['motivation']);

        if (
            $score == 'HIGH'
            && $hours == 'HIGH'
        ) {
            return 'Active Recall, Spaced Repetition, Blurting';
        }

        if (
            $sleep == 'HIGH'
            && $motivation == 'HIGH'
        ) {
            return 'Pomodoro, Mind Mapping, Interleaving';
        }

        if (
            $resource == 'HIGH'
        ) {
            return 'Feynman Technique, SQ3R';
        }

        if ($risk == 'HIGH RISK') {
            return 'Active Recall, Pomodoro, Spaced Repetition';
        }

        if ($risk == 'MEDIUM RISK') {
            return 'Active Recall, Feynman Technique';
        }

        return 'Pertahankan pola belajar saat ini';
    }
}