{{-- resources/views/page/hasil.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTrace - Hasil Analisa</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        html { scroll-behavior: smooth; }
        body { background: #F5F6FA; overflow-x: hidden; }

        :root {
            --primary: #3C3489;
            --secondary: #EF9F27;
            --soft: #EEEDFE;
            --white: #FFFFFF;
            --danger: #E53535;
            --success: #27AE60;
            --warning: #EF9F27;
        }

        a { text-decoration: none; }
        ul { list-style: none; }

        /* ===== NAVBAR ===== */
        .navbar {
            width: 100%;
            height: 70px;
            background: #fff;
            position: fixed;
            top: 0; left: 0;
            z-index: 9999;
            border-bottom: 1px solid #EBEBEB;
        }
        .nav-wrapper {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }
        .logo img { height: 95px; object-fit: contain; }
        .nav-menu { display: flex; align-items: center; gap: 4px; position: absolute; left: 50%; transform: translateX(-50%); }
        .nav-menu a {
            color: #666;
            font-size: 13px;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 8px;
            transition: 0.2s;
        }
        .nav-menu a.active { background: var(--secondary); color: #fff; }
        .nav-menu a:hover:not(.active) { color: var(--primary); }

        /* Profile */
        .nav-auth { display: flex; align-items: center; }
        .profile-trigger {
            display: flex; align-items: center; gap: 10px;
            cursor: pointer; padding: 6px 10px;
            border-radius: 10px; transition: 0.2s;
            position: relative; user-select: none;
        }
        .profile-trigger:hover { background: #F3F2FF; }
        .profile-avatar {
            width: 38px; height: 38px; border-radius: 50%;
            background: var(--primary);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; flex-shrink: 0;
        }
        .profile-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .profile-info { display: flex; flex-direction: column; line-height: 1.3; }
        .profile-name { font-size: 13px; font-weight: 700; color: #222; }
        .profile-level { font-size: 11px; color: #888; font-weight: 500; }
        .profile-trigger .fa-chevron-down { font-size: 11px; color: #888; transition: 0.3s; }
        .profile-trigger.open .fa-chevron-down { transform: rotate(180deg); }

        .profile-dropdown {
            position: absolute; top: calc(100% + 10px); right: 0;
            width: 200px; background: #fff; border-radius: 14px;
            box-shadow: 0 8px 28px rgba(0,0,0,.13);
            border: 1px solid #EFEFEF;
            padding: 10px; opacity: 0; pointer-events: none;
            transform: translateY(-8px); transition: 0.25s ease; z-index: 99999;
        }
        .profile-dropdown.show { opacity: 1; pointer-events: all; transform: translateY(0); }
        .dropdown-item {
            display: flex; align-items: center; gap: 10px;
            padding: 11px 14px; border-radius: 10px;
            font-size: 14px; font-weight: 600;
            cursor: pointer; transition: 0.2s; text-decoration: none;
        }
        .dropdown-item.edit { background: var(--soft); color: var(--primary); margin-bottom: 2px; }
        .dropdown-item.edit:hover { background: #dddcfc; }
        .dropdown-item.keluar { color: var(--danger); margin-top: 4px; }
        .dropdown-item.keluar:hover { background: #FFF0F0; }
        .dropdown-divider { height: 1px; background: #F0F0F0; margin: 6px 0; }

        /* ===== PAGE LAYOUT ===== */
        .page-wrapper {
            width: 90%;
            max-width: 1200px;
            margin: 90px auto 40px;
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 24px;
        }

        /* ===== CARD BASE ===== */
        .card {
            background: #fff;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 4px 20px rgba(0,0,0,.06);
        }

        /* ===== HASIL UTAMA ===== */
        .hasil-utama {
            display: flex;
            align-items: center;
            gap: 28px;
            margin-bottom: 24px;
        }

        /* Donut Chart */
        .donut-wrap {
            flex-shrink: 0;
            position: relative;
            width: 120px; height: 120px;
        }
        .donut-wrap svg { width: 120px; height: 120px; }
        .donut-center {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            line-height: 1.2;
        }
        .donut-center span { font-size: 10px; color: #888; font-weight: 500; display: block; }
        .donut-center strong { font-size: 15px; font-weight: 800; }
        .donut-center strong.low    { color: var(--success); }
        .donut-center strong.medium { color: var(--warning); }
        .donut-center strong.high   { color: var(--danger); }

        /* Risk text */
        .hasil-text h2 { font-size: 22px; font-weight: 800; color: var(--primary); margin-bottom: 8px; }
        .hasil-text p  { font-size: 13px; color: #555; line-height: 1.7; max-width: 420px; }

        /* ===== GRID KATEGORI ===== */
        .grid-kategori {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .kat-card {
            background: #FAFAFA;
            border: 1px solid #EEEEEE;
            border-radius: 14px;
            padding: 16px;
            text-align: center;
        }
        .kat-card .kat-title { font-size: 12px; font-weight: 600; color: #555; margin-bottom: 10px; }
        .kat-card .kat-icon  { font-size: 26px; margin-bottom: 10px; }
        .kat-card .kat-value { font-size: 13px; font-weight: 700; color: #333; margin-bottom: 4px; }
        .kat-card .kat-risk-label { font-size: 11px; color: #888; margin-bottom: 6px; }

        /* Siakad badge */
        .siakad-badge {
            display: inline-block;
            font-size: 9px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
            background: #EEF0FF;
            color: var(--primary);
            margin-bottom: 8px;
            letter-spacing: 0.3px;
        }

        /* Progress bar */
        .risk-bar-wrap { height: 8px; background: #EBEBEB; border-radius: 99px; overflow: hidden; }
        .risk-bar      { height: 8px; border-radius: 99px; transition: width 0.6s ease; }
        .risk-bar.low    { background: var(--success); width: 30%; }
        .risk-bar.medium { background: var(--warning); width: 60%; }
        .risk-bar.high   { background: var(--danger);  width: 90%; }

        .kat-risk-text { font-size: 11px; font-weight: 700; margin-top: 6px; }
        .kat-risk-text.low    { color: var(--success); }
        .kat-risk-text.medium { color: var(--warning); }
        .kat-risk-text.high   { color: var(--danger);  }

        /* ===== TOP 3 TEKNIK BELAJAR ===== */
        .teknik-section { margin-top: 24px; }
        .teknik-section h3 { font-size: 20px; font-weight: 800; color: #222; margin-bottom: 4px; }
        .teknik-section .teknik-subtitle {
            font-size: 12px; color: #888; margin-bottom: 18px;
            font-style: italic;
        }
        .teknik-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }

        .teknik-card {
            background: #fff;
            border: 1px solid #EEEEEE;
            border-radius: 16px;
            overflow: hidden;
        }
        .teknik-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px 0;
        }
        .teknik-num {
            width: 32px; height: 32px;
            border-radius: 8px;
            background: var(--secondary);
            color: #fff;
            font-size: 15px; font-weight: 800;
            display: flex; align-items: center; justify-content: center;
        }
        .teknik-num.n2 { background: var(--primary); }
        .teknik-num.n3 { background: #6C63FF; }
        .teknik-toggle {
            width: 28px; height: 28px; border-radius: 8px;
            border: 1px solid #EBEBEB;
            background: #fff; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; color: #aaa; transition: 0.2s;
        }
        .teknik-toggle:hover { background: #F3F2FF; color: var(--primary); }

        .teknik-img-placeholder {
            width: 100%; height: 120px;
            background: linear-gradient(135deg, #f0eefc 0%, #e0dcfb 100%);
            display: flex; align-items: center; justify-content: center;
            font-size: 40px;
            margin-top: 10px;
        }

        .teknik-body { padding: 14px 16px; }
        .teknik-name {
            font-size: 14px; font-weight: 700;
            color: var(--primary);
            margin-bottom: 6px;
        }
        .teknik-desc { font-size: 12px; color: #666; line-height: 1.6; }

        .teknik-cara {
            padding: 12px 16px;
            border-top: 1px dashed #EBEBEB;
            background: #FAFAFA;
            display: none;
        }
        .teknik-cara.open { display: block; }
        .teknik-cara h5 { font-size: 12px; font-weight: 700; color: #333; margin-bottom: 8px; }
        .teknik-cara ul { padding-left: 0; }
        .teknik-cara ul li {
            font-size: 12px; color: #555;
            padding: 3px 0 3px 16px;
            position: relative;
        }
        .teknik-cara ul li::before {
            content: '•';
            position: absolute; left: 0;
            color: var(--secondary);
        }

        /* Rekomendasi lengkap */
        .rekomendasi-full {
            margin-top: 16px;
            background: #F9F8FF;
            border: 1px solid #E0DCFC;
            border-radius: 12px;
            padding: 14px 16px;
            font-size: 12px;
            color: #444;
            line-height: 1.7;
        }
        .rekomendasi-full strong { color: var(--primary); font-size: 12px; }

        /* ===== SIDEBAR ===== */
        .sidebar { display: flex; flex-direction: column; gap: 20px; }

        /* Riwayat */
        .riwayat-card h3 { font-size: 18px; font-weight: 800; color: #222; margin-bottom: 16px; }
        .riwayat-list { display: flex; flex-direction: column; gap: 8px; max-height: 260px; overflow-y: auto; padding-right: 4px; }
        .riwayat-list::-webkit-scrollbar { width: 4px; }
        .riwayat-list::-webkit-scrollbar-thumb { background: #D0D0D0; border-radius: 4px; }

        .riwayat-item {
            border: 1px solid #EBEBEB;
            border-radius: 12px;
            padding: 12px 14px;
            cursor: pointer;
            transition: 0.2s;
            position: relative;
        }
        .riwayat-item:hover { border-color: var(--primary); background: #F9F8FF; }
        .riwayat-item.active-high   { border-left: 3px solid var(--danger);  background: #FFF8F8; }
        .riwayat-item.active-low    { border-left: 3px solid var(--success); background: #F5FFF7; }
        .riwayat-item.active-medium { border-left: 3px solid var(--warning); background: #FFFBF0; }

        .riwayat-dot {
            width: 10px; height: 10px; border-radius: 50%;
            position: absolute; top: 14px; right: 14px;
        }
        .riwayat-dot.high   { background: var(--danger); }
        .riwayat-dot.low    { background: var(--success); }
        .riwayat-dot.medium { background: var(--warning); }

        .riwayat-tanggal { font-size: 11px; color: #AAA; font-weight: 500; margin-bottom: 4px; }
        .riwayat-level   { font-size: 13px; font-weight: 700; color: #333; }
        .riwayat-waktu   { font-size: 11px; color: #888; }
        .riwayat-note { font-size: 11px; color: #AAA; text-align: center; margin-top: 8px; }

        /* CTA Card */
        .cta-card {
            background: var(--primary);
            border-radius: 20px;
            padding: 28px;
        }
        .cta-card h3 { font-size: 20px; font-weight: 800; color: #fff; margin-bottom: 10px; }
        .cta-card p  { font-size: 13px; color: rgba(255,255,255,.8); line-height: 1.7; margin-bottom: 20px; }
        .btn-ulang {
            display: block;
            width: 100%;
            background: #fff;
            color: var(--primary);
            font-size: 14px; font-weight: 700;
            padding: 13px;
            border-radius: 12px;
            text-align: center;
            transition: 0.2s;
        }
        .btn-ulang:hover { background: #F3F2FF; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .page-wrapper { grid-template-columns: 1fr; }
            .grid-kategori { grid-template-columns: repeat(2, 1fr); }
            .teknik-grid   { grid-template-columns: 1fr; }
        }
        @media (max-width: 500px) {
            .grid-kategori { grid-template-columns: 1fr; }
            .hasil-utama   { flex-direction: column; text-align: center; }
            .profile-info, .profile-trigger .fa-chevron-down { display: none; }
        }
    </style>
</head>
<body>

    {{-- ===== NAVBAR ===== --}}
    @auth
    <nav class="navbar">
        <div class="nav-wrapper">
            <div class="logo">
                <img src="{{ asset('images/edutrace.png') }}" alt="EduTrace">
            </div>

            <ul class="nav-menu">
                <li><a href="{{ url('/#beranda') }}">Beranda</a></li>
                <li><a href="{{ url('/#fitur') }}">Fitur</a></li>
                <li><a href="{{ url('/#faq') }}">FAQ</a></li>
                <li><a href="{{ route('kuis.hasil') }}" class="active">Hasil Analisa</a></li>
            </ul>

            <div class="nav-auth">
                <div class="profile-trigger" id="profileTrigger">
                    <div class="profile-avatar">
                        @if(Auth::user()->siswa && Auth::user()->siswa->foto)
                            <img src="{{ asset('storage/' . Auth::user()->siswa->foto) }}" alt="Foto">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->siswa->nama ?? 'User') }}&background=3C3489&color=fff" alt="Avatar">
                        @endif
                    </div>
                    <div class="profile-info">
                        <span class="profile-name">{{ Auth::user()->siswa->nama ?? 'User' }}</span>
                        <span class="profile-level">{{ Auth::user()->siswa->jenjang ?? '-' }}</span>
                    </div>
                    <i class="fa-solid fa-chevron-down"></i>

                    <div class="profile-dropdown" id="profileDropdown">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item edit">
                            <i class="fa-solid fa-pen-to-square"></i> Edit Profil
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item keluar"
                                style="width:100%;border:none;background:none;font-family:'Poppins',sans-serif;cursor:pointer;">
                                <i class="fa-solid fa-right-from-bracket"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @endauth

    {{-- ===== PAGE WRAPPER ===== --}}
    <div class="page-wrapper">

        {{-- ============================
             KOLOM KIRI (KONTEN UTAMA)
        ============================= --}}
        <div class="left-col">

            {{-- ── HASIL RESIKO UTAMA ── --}}
            <div class="card" style="margin-bottom:24px;">

                <div class="hasil-utama">
                    @php
                        $riskLower = strtolower($riskTotal);
                        $donutColor = match($riskLower) {
                            'low'  => '#27AE60',
                            'high' => '#E53535',
                            default => '#EF9F27',
                        };
                        $circumference = 283;
                        $fillPercent = match($riskLower) {
                            'low'  => 0.30,
                            'high' => 0.90,
                            default => 0.60,
                        };
                        $dasharray = round($circumference * $fillPercent);
                    @endphp

                    <div class="donut-wrap">
                        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="45"
                                fill="none" stroke="#EBEBEB" stroke-width="10"/>
                            <circle cx="50" cy="50" r="45"
                                fill="none"
                                stroke="{{ $donutColor }}"
                                stroke-width="10"
                                stroke-linecap="round"
                                stroke-dasharray="{{ $dasharray }} {{ $circumference - $dasharray }}"
                                stroke-dashoffset="71"
                                transform="rotate(-90 50 50)"/>
                        </svg>
                        <div class="donut-center">
                            <span>Level Resiko</span>
                            <strong class="{{ $riskLower }}">{{ strtoupper($riskTotal) }}</strong>
                        </div>
                    </div>

                    <div class="hasil-text">
                        <h2>Hasil Resiko Belajar</h2>
                        <p>
                            Berdasarkan pola aktivitas Anda, tingkat risiko burnout berada
                            pada level <strong>{{ strtolower($riskTotal) }}</strong>.
                            @if($rekomendasi)
                                Rekomendasi teknik belajar untuk Anda: <em>{{ $rekomendasi }}</em>
                            @endif
                        </p>
                    </div>
                </div>

                {{-- ── GRID KATEGORI ── --}}
                @php
                    $ikonKategori = [
                        'Sleep_Hours'         => '🌙',
                        'Access_to_Resources' => '📚',
                        'Motivation_Level'    => '💡',
                        'Les'                 => '📊',
                        'Kesulitan_Belajar'   => '🧠',
                    ];

                    {{--
                        Konversi nilai category string (HIGH/MEDIUM/LOW) dari SIAKAD
                        ke class CSS yang dipakai di blade.
                        $attendanceCat, $hoursCat, $scoreCat dikirim dari controller.
                    --}}
                    $siakadRiskClass = fn(string $cat): string => match(strtolower($cat)) {
                        'low'  => 'low',
                        'high' => 'high',
                        default => 'medium',
                    };

                    $siakadRiskLabel = fn(string $cat): string => match(strtolower($cat)) {
                        'low'  => 'Resiko Rendah',
                        'high' => 'Resiko Tinggi',
                        default => 'Resiko Normal',
                    };
                @endphp

                <div class="grid-kategori">

                    {{-- ── 3 KARTU DATA SIAKAD ── --}}
                    {{-- Kehadiran --}}
                    <div class="kat-card">
                        <div class="kat-title">Kehadiran</div>
                        <div class="kat-icon">🏫</div>
                        <div class="siakad-badge">SIAKAD</div>
                        <div class="kat-value">{{ $attendanceNum ?? '-' }}%</div>
                        <div class="kat-risk-label">{{ $siakadRiskLabel($attendanceCat) }}</div>
                        <div class="risk-bar-wrap">
                            <div class="risk-bar {{ $siakadRiskClass($attendanceCat) }}"></div>
                        </div>
                        <div class="kat-risk-text {{ $siakadRiskClass($attendanceCat) }}">
                            {{ ucfirst(strtolower($attendanceCat)) }}
                        </div>
                    </div>

                    {{-- Jam Belajar --}}
                    <div class="kat-card">
                        <div class="kat-title">Jam Belajar</div>
                        <div class="kat-icon">🕐</div>
                        <div class="siakad-badge">SIAKAD</div>
                        <div class="kat-value">{{ $hoursStudiedNum ?? '-' }} jam/hari</div>
                        <div class="kat-risk-label">{{ $siakadRiskLabel($hoursCat) }}</div>
                        <div class="risk-bar-wrap">
                            <div class="risk-bar {{ $siakadRiskClass($hoursCat) }}"></div>
                        </div>
                        <div class="kat-risk-text {{ $siakadRiskClass($hoursCat) }}">
                            {{ ucfirst(strtolower($hoursCat)) }}
                        </div>
                    </div>

                    {{-- Nilai Sebelumnya --}}
                    <div class="kat-card">
                        <div class="kat-title">Nilai Sebelumnya</div>
                        <div class="kat-icon">📝</div>
                        <div class="siakad-badge">SIAKAD</div>
                        <div class="kat-value">{{ $previousScoreNum ?? '-' }}</div>
                        <div class="kat-risk-label">{{ $siakadRiskLabel($scoreCat) }}</div>
                        <div class="risk-bar-wrap">
                            <div class="risk-bar {{ $siakadRiskClass($scoreCat) }}"></div>
                        </div>
                        <div class="kat-risk-text {{ $siakadRiskClass($scoreCat) }}">
                            {{ ucfirst(strtolower($scoreCat)) }}
                        </div>
                    </div>

                    {{-- ── 5 KARTU DATA KUIS ── --}}
                    @foreach($riskPerKategori as $key => $item)
                        @php
                            $riskClass = strtolower($item['risk']);
                            $riskLabel = match($riskClass) {
                                'low'  => 'Resiko Rendah',
                                'high' => 'Resiko Tinggi',
                                default => 'Resiko Normal',
                            };
                            $ikon = $ikonKategori[$key] ?? '📋';
                        @endphp
                        <div class="kat-card">
                            <div class="kat-title">{{ $item['label'] }}</div>
                            <div class="kat-icon">{{ $ikon }}</div>
                            <div class="kat-risk-label">{{ $riskLabel }}</div>
                            <div class="risk-bar-wrap">
                                <div class="risk-bar {{ $riskClass }}"></div>
                            </div>
                            <div class="kat-risk-text {{ $riskClass }}">
                                {{ $item['risk'] }}
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            {{-- ── TOP 3 TEKNIK BELAJAR ── --}}
            {{--
                $teknikBelajar dikirim dari controller sebagai array berisi maks 3 teknik
                yang dipilih berdasarkan rekomendasi Forward Chaining.
            --}}
            <div class="teknik-section">
                <h3>Top 3 Teknik Belajar</h3>
                <p class="teknik-subtitle">
                    Dipilih berdasarkan hasil analisa risiko Anda: <em>"{{ $rekomendasi }}"</em>
                </p>
                <div class="teknik-grid">
                    @foreach($teknikBelajar as $idx => $teknik)
                        @php $n = $idx + 1; @endphp
                        <div class="teknik-card">

                            <div class="teknik-header">
                                <div class="teknik-num {{ $n === 2 ? 'n2' : ($n === 3 ? 'n3' : '') }}">
                                    {{ $n }}
                                </div>
                                <button class="teknik-toggle" onclick="toggleCara(this)">
                                    <i class="fa-solid fa-chevron-{{ $n === 1 ? 'up' : 'down' }}"></i>
                                </button>
                            </div>

                            <div class="teknik-img-placeholder">{{ $teknik['ikon'] }}</div>

                            <div class="teknik-body">
                                <div class="teknik-name">{{ $teknik['nama'] }}</div>
                                <div class="teknik-desc">{{ $teknik['desc'] }}</div>
                            </div>

                            <div class="teknik-cara {{ $n === 1 ? 'open' : '' }}">
                                <h5>Cara :</h5>
                                <ul>
                                    @foreach($teknik['cara'] as $step)
                                        <li>{{ $step }}</li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- ============================
             KOLOM KANAN (SIDEBAR)
        ============================= --}}
        <div class="sidebar">

            {{-- ── RIWAYAT TEST ── --}}
            <div class="card riwayat-card">
                <h3>Riwayat Test</h3>

                <div class="riwayat-list">
                    @php
                        $siswaId = Auth::user()->siswa->id ?? null;
                        $riwayat = [];

                        if ($siswaId) {
                            $riwayat = \Illuminate\Support\Facades\DB::table('hasil_analisa')
                                ->join('sesi_kuis', 'hasil_analisa.sesi_id', '=', 'sesi_kuis.id')
                                ->where('sesi_kuis.siswa_id', $siswaId)
                                ->where('sesi_kuis.tanggal_kuis', '>=', now()->subDays(30))
                                ->orderByDesc('sesi_kuis.tanggal_kuis')
                                ->select(
                                    'hasil_analisa.risk_level',
                                    'sesi_kuis.tanggal_kuis'
                                )
                                ->get();
                        }
                    @endphp

                    @forelse($riwayat as $r)
                        @php
                            $rl          = strtolower($r->risk_level);
                            $tanggal     = \Carbon\Carbon::parse($r->tanggal_kuis);
                            $activeClass = 'active-' . $rl;
                        @endphp
                        <div class="riwayat-item {{ $activeClass }}">
                            <div class="riwayat-dot {{ $rl }}"></div>
                            <div class="riwayat-tanggal">{{ $tanggal->translatedFormat('d F Y') }}</div>
                            <div class="riwayat-level">Level Resiko {{ ucfirst($rl) }}</div>
                            <div class="riwayat-waktu">Mulai Test : {{ $tanggal->format('H.i') }} WIB</div>
                        </div>
                    @empty
                        <p style="font-size:13px;color:#AAA;text-align:center;padding:20px 0;">
                            Belum ada riwayat test.
                        </p>
                    @endforelse
                </div>

                <p class="riwayat-note">Hanya riwayat 30 hari terakhir yang ditampilkan di atas</p>
            </div>

            {{-- ── CTA CARD ── --}}
            <div class="cta-card">
                <h3>Kurang puas dengan hasilnya?</h3>
                <p>Lakukan penilaian mendalam untuk mendapatkan rekomendasi belajar yang dipersonalisasi.</p>
                <a href="{{ route('kuis.show', 1) }}" class="btn-ulang">Mulai Test Ulang</a>
            </div>

        </div>

    </div>

    <script>
        // ===== PROFILE DROPDOWN =====
        const trigger  = document.getElementById('profileTrigger');
        const dropdown = document.getElementById('profileDropdown');

        if (trigger && dropdown) {
            trigger.addEventListener('click', e => {
                e.stopPropagation();
                trigger.classList.toggle('open');
                dropdown.classList.toggle('show');
            });
            document.addEventListener('click', () => {
                trigger.classList.remove('open');
                dropdown.classList.remove('show');
            });
            dropdown.addEventListener('click', e => e.stopPropagation());
        }

        // ===== TOGGLE CARA BELAJAR =====
        function toggleCara(btn) {
            const card = btn.closest('.teknik-card');
            const cara = card.querySelector('.teknik-cara');
            const icon = btn.querySelector('i');
            cara.classList.toggle('open');
            icon.className = cara.classList.contains('open')
                ? 'fa-solid fa-chevron-up'
                : 'fa-solid fa-chevron-down';
        }
    </script>

</body>
</html>