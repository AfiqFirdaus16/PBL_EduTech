@extends('layouts.app-admin')

@section('page-title', 'Dashboard')

@push('styles')
<style>
    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 20px 24px;
        border: 1px solid #e8e8f0;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .stat-label { font-size: 13px; color: #888; font-weight: 500; }
    .stat-value { font-size: 28px; font-weight: 800; color: #1a1a2e; letter-spacing: -0.5px; }
    .stat-growth { font-size: 12px; color: #22a06b; font-weight: 600; display: flex; align-items: center; gap: 4px; }
    .stat-growth.down { color: #e53e3e; }

    .chart-card {
        background: #fff;
        border-radius: 16px;
        padding: 22px 24px;
        border: 1px solid #e8e8f0;
    }
    .chart-title { font-size: 15px; font-weight: 700; color: #1a1a2e; margin-bottom: 4px; }

    .analisa-row { display: flex; align-items: center; gap: 10px; margin-bottom: 14px; }
    .analisa-num {
        width: 22px; height: 22px; border-radius: 50%;
        background: #3C3489; color: #fff;
        font-size: 11px; font-weight: 700;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .analisa-label { font-size: 13px; font-weight: 500; color: #333; width: 110px; flex-shrink: 0; }
    .analisa-bar-wrap { flex: 1; background: #f0f0f0; border-radius: 99px; height: 8px; overflow: hidden; }
    .analisa-bar { height: 100%; border-radius: 99px; background: #ef9f27; }
</style>
@endpush

@section('content')

{{-- ── STAT CARDS ── --}}
<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:24px;">

    <div class="stat-card">
        <div class="stat-label">Pengguna Baru</div>
        <div style="display:flex; align-items:flex-end; justify-content:space-between;">
            <div class="stat-value">{{ number_format($penggunaBaru) }}</div>
            <div class="stat-growth {{ $growthBaru < 0 ? 'down' : '' }}">
                {{ $growthBaru >= 0 ? '+' : '' }}{{ number_format($growthBaru, 2) }}%
                {{ $growthBaru >= 0 ? '↗' : '↘' }}
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Pengguna Aktif</div>
        <div style="display:flex; align-items:flex-end; justify-content:space-between;">
            <div class="stat-value">{{ number_format($siswaAktif) }}</div>
            <div class="stat-growth {{ $growthAktif < 0 ? 'down' : '' }}">
                {{ $growthAktif >= 0 ? '+' : '' }}{{ number_format($growthAktif, 2) }}%
                {{ $growthAktif >= 0 ? '↗' : '↘' }}
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Pengguna Lama</div>
        <div style="display:flex; align-items:flex-end; justify-content:space-between;">
            <div class="stat-value">{{ number_format($totalSiswa) }}</div>
            <div class="stat-growth {{ $growthLama < 0 ? 'down' : '' }}">
                {{ $growthLama >= 0 ? '+' : '' }}{{ number_format($growthLama, 2) }}%
                {{ $growthLama >= 0 ? '↗' : '↘' }}
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Kunjungan Web</div>
        <div style="display:flex; align-items:flex-end; justify-content:space-between;">
            <div class="stat-value">{{ number_format($kunjunganWeb) }}</div>
            <div class="stat-growth">
                {{ $growthKunjungan >= 0 ? '+' : '' }}{{ number_format($growthKunjungan, 2) }}% ↗
            </div>
        </div>
    </div>

</div>

{{-- ── ROW 2: LINE CHART + ANALISA RESIKO ── --}}
<div style="display:grid; grid-template-columns:1fr 280px; gap:16px; margin-bottom:24px;">

    <div class="chart-card">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
            <div class="chart-title">Total Pengguna</div>
            <div style="display:flex; align-items:center; gap:16px; font-size:12px; color:#888;">
                <span style="display:flex;align-items:center;gap:5px;">
                    <span style="width:10px;height:10px;border-radius:50%;background:#ef9f27;display:inline-block;"></span>
                    Tahun ini
                </span>
                <span style="display:flex;align-items:center;gap:5px;">
                    <span style="width:10px;height:10px;border-radius:50%;background:#3C3489;display:inline-block;"></span>
                    Tahun terakhir
                </span>
            </div>
        </div>
        <canvas id="lineChart" height="90"></canvas>
    </div>

    <div class="chart-card">
        <div class="chart-title" style="margin-bottom:16px;">Analisa Resiko High to Low</div>
        @forelse($analisaResiko as $i => $item)
        <div class="analisa-row">
            <div class="analisa-num">{{ $i + 1 }}</div>
            <div class="analisa-label">{{ $item->kategori }}</div>
            <div class="analisa-bar-wrap">
                <div class="analisa-bar" style="width:{{ round(($item->total / $maxAnalisa) * 100) }}%"></div>
            </div>
        </div>
        @empty
        <p style="font-size:13px;color:#aaa;">Belum ada data analisa.</p>
        @endforelse
    </div>

</div>

{{-- ── ROW 3: TINGKAT + JENJANG ── --}}
<div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">

    <div class="chart-card">
        <div class="chart-title" style="margin-bottom:16px;">Tingkat Pengguna</div>
        <canvas id="tingkatChart" height="110"></canvas>
    </div>

    <div class="chart-card">
        <div class="chart-title" style="margin-bottom:16px;">Jenjang Pengguna</div>
        <canvas id="jenjangChart" height="110"></canvas>
    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const bulanLabel = @json($bulanLabel);
    const tahunIni   = @json($tahunIni);
    const tahunLalu  = @json($tahunLalu);

    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: bulanLabel,
            datasets: [
                {
                    label: 'Tahun ini',
                    data: tahunIni,
                    borderColor: '#ef9f27',
                    backgroundColor: 'rgba(239,159,39,0.12)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 3,
                    borderWidth: 2,
                },
                {
                    label: 'Tahun terakhir',
                    data: tahunLalu,
                    borderColor: '#3C3489',
                    backgroundColor: 'transparent',
                    fill: false,
                    tension: 0.4,
                    borderDash: [5, 4],
                    pointRadius: 3,
                    borderWidth: 2,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { font: { size: 11 } }, grid: { color: '#f0f0f0' } },
                x: { ticks: { font: { size: 11 } }, grid: { display: false } }
            }
        }
    });

    const tingkatData = @json($tingkatData);
    new Chart(document.getElementById('tingkatChart'), {
        type: 'bar',
        data: {
            labels: Object.keys(tingkatData),
            datasets: [{
                data: Object.values(tingkatData),
                backgroundColor: ['#ef9f27', '#3C3489', '#ef9f27'],
                borderRadius: 6,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                x: { beginAtZero: true, ticks: { font: { size: 11 } }, grid: { color: '#f0f0f0' } },
                y: { ticks: { font: { size: 11 } }, grid: { display: false } }
            }
        }
    });

    const jenjangData = @json($jenjangData);
    new Chart(document.getElementById('jenjangChart'), {
        type: 'bar',
        data: {
            labels: Object.keys(jenjangData),
            datasets: [{
                data: Object.values(jenjangData),
                backgroundColor: ['#9b93e0', '#ef9f27'],
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { font: { size: 11 } }, grid: { color: '#f0f0f0' } },
                x: { ticks: { font: { size: 11 } }, grid: { display: false } }
            }
        }
    });
</script>
@endpush