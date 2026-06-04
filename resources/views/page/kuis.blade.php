<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuis EduTrace</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins', sans-serif;
        }

        body{
            background:#f3f1fa;
        }

        .navbar{
            width:100%;
            height:75px;
            background:#FFFFFF;
            position:fixed;
            top:0;
            left:0;
            z-index:9999;
            border-bottom:1px solid #E5E5E5;
        }

        .nav-wrapper{
            width:100%;
            height:75px;
            position:relative;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .logo{
            position:absolute;
            left:0;
            display:flex;
            align-items:center;
        }

        .logo img{
            height:100px;
            object-fit:contain;
        }

        .nav-menu{
            display:flex;
            align-items:center;
            gap:28px;
        }

        .nav-menu a{
            color:#666;
            font-size:13px;
            font-weight:700;
            padding:10px 22px;
            border-radius:8px;
            transition:0.3s;
        }

        .nav-menu a.active{
            background:#EF9F27;
            color:#FFFFFF;
        }

        .nav-menu a:hover{
            color:#3C3489;
        }

        /* ── HEADER (tidak diubah) ─────────────────────────────── */
        .header{
            width:100%;
            background:white;
            padding:18px 40px;
            display:flex;
            align-items:center;
            box-shadow:0 1px 4px rgba(0,0,0,0.05);
        }

        .logo{
            font-size:42px;
            font-weight:700;
            display:flex;
            align-items:center;
            gap:8px;
        }

        .logo .edu{ color:#3a2e8f; }
        .logo .trace{ color:#f0a020; }

        .logo-sub{
            font-size:12px;
            color:#777;
            margin-top:-6px;
        }

        /* ── CONTAINER ─────────────────────────────────────────── */
        .container{
            width:100%;
            display:flex;
            justify-content:center;
            padding:50px 20px;
        }

        .card{
            width:100%;
            max-width:950px;
            background:white;
            border-radius:14px;
            padding:40px;
            box-shadow:0 4px 12px rgba(0,0,0,0.05);
        }

        .card-header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:10px;
        }

        .title{
            font-size:22px;
            font-weight:700;
        }

        .step-info{
            font-size:14px;
            color:#888;
            font-weight:500;
        }

        /* ── PROGRESS ─────────────────────────────────────────── */
        .progress-wrapper{
            margin-bottom:40px;
        }

        .progress-info{
            display:flex;
            justify-content:space-between;
            margin-bottom:10px;
            font-size:15px;
        }

        .progress-bar{
            width:100%;
            height:10px;
            background:#ddd;
            border-radius:20px;
            overflow:hidden;
        }

        .progress{
            height:100%;
            background:#e89611;
            border-radius:20px;
            transition:width 0.4s ease;
        }

        /* ── QUESTION ─────────────────────────────────────────── */
        .question{
            font-size:20px;
            font-weight:700;
            margin-bottom:20px;
            line-height:1.5;
            margin-top:40px;
        }

        .question:first-of-type{
            margin-top:0;
        }

        .option{
            border:1.5px solid #ddd;
            border-radius:10px;
            padding:16px 20px;
            display:flex;
            align-items:center;
            gap:20px;
            margin-bottom:14px;
            cursor:pointer;
            transition:0.3s;
        }

        .option:hover{
            border-color:#5a4fcf;
        }

        .option input{
            display:none;
        }

        .circle{
            width:38px;
            height:38px;
            border-radius:50%;
            background:#ddd;
            color:#555;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:600;
            flex-shrink:0;
            transition:0.3s;
        }

        .option-text{
            font-size:15px;
            color:#333;
            line-height:1.5;
        }

        .option.active{
            border-color:#5a4fcf;
            background:#f7f5ff;
        }

        .option.active .circle{
            background:#5a4fcf;
            color:white;
        }

        /* ── ERROR ────────────────────────────────────────────── */
        .alert-error{
            background:#fff0f0;
            border:1px solid #f5c2c7;
            color:#842029;
            border-radius:10px;
            padding:14px 20px;
            margin-bottom:20px;
            font-size:14px;
        }

        /* ── BUTTON ───────────────────────────────────────────── */
        .btn-area{
            display:flex;
            justify-content:flex-end;
            margin-top:30px;
        }

        .btn-next{
            background:#43329b;
            color:white;
            border:none;
            padding:14px 35px;
            border-radius:30px;
            font-size:16px;
            font-weight:600;
            cursor:pointer;
            transition:0.3s;
        }

        .btn-next:hover{
            background:#34257e;
        }

        @media(max-width:768px){
            .card{ padding:25px; }
            .question{ font-size:17px; }
            .option{ align-items:flex-start; }
            .option-text{ font-size:14px; }
            .logo{ font-size:32px; }
        }
    </style>
</head>
<body>

    {{-- ================= NAVBAR ================= --}}
    <nav class="navbar">
        <div class="container nav-wrapper">

            <div class="logo">
                <img src="{{ asset('images/edutrace.png') }}" alt="logo">
            </div>

        </div>
    </nav>

    {{-- ── HEADER (tidak diubah) ───────────────────────────────── --}}
    <div class="header">
        <div>
            <div class="logo">
                <span class="edu">edu</span><span class="trace">Trace</span>
            </div>
            <div class="logo-sub">
                Transforming Learning Habits, Ensuring Success
            </div>
        </div>
    </div>

    {{-- ── CONTENT ──────────────────────────────────────────────── --}}
    <div class="container">
        <div class="card">

            {{-- Judul + info step --}}
            <div class="card-header">
                <div class="title">Modul Penilaian</div>
                <div class="step-info">Halaman {{ $step }} dari {{ $totalStep }}</div>
            </div>

            {{-- Progress --}}
            <div class="progress-wrapper">
                <div class="progress-info">
                    <span></span>
                    <span>{{ $persen }}% selesai</span>
                </div>
                <div class="progress-bar">
                    <div class="progress" style="width:{{ $persen }}%"></div>
                </div>
            </div>

            {{-- Tampilkan error validasi --}}
            @if ($errors->any())
                <div class="alert-error">
                    ⚠️ Harap jawab semua pertanyaan sebelum melanjutkan.
                </div>
            @endif

            {{-- FORM --}}
            <form action="{{ route('kuis.store', $step) }}" method="POST">
                @csrf

                @foreach ($pertanyaan as $index => $p)

                @php
                    $nomorSoal = (($step - 1) * 4) + $loop->iteration;
                    $huruf     = ['A','B','C'];
                    $selected  = old("q_{$p->id}") ?? ($jawabanSession["q_{$p->id}"] ?? null);
                @endphp

                <div class="question" {{ $loop->first ? '' : 'style=margin-top:50px' }}>
                    {{ $nomorSoal }}. {{ $p->pertanyaan }}
                </div>

                @foreach ($p->pilihanJawaban as $pi => $pilihan)
                    <label class="option {{ $selected == $pilihan->id ? 'active' : '' }}">
                        <input
                            type="radio"
                            name="q_{{ $p->id }}"
                            value="{{ $pilihan->id }}"
                            {{ $selected == $pilihan->id ? 'checked' : '' }}
                        >
                        <div class="circle">{{ $huruf[$pi] ?? $pi }}</div>
                        <div class="option-text">{{ $pilihan->jawaban }}</div>
                    </label>
                @endforeach

            @endforeach

                {{-- Tombol navigasi --}}
                <div class="btn-area">
                    @if ($step > 1)
                        <a href="{{ route('kuis.show', $step - 1) }}"
                           style="margin-right:16px; background:#ddd; color:#333; border:none; padding:14px 30px; border-radius:30px; font-size:16px; font-weight:600; cursor:pointer; text-decoration:none; display:inline-flex; align-items:center;">
                            ← Kembali
                        </a>
                    @endif

                    <button type="submit" class="btn-next">
                        {{ $step === $totalStep ? 'Lihat Hasil ✓' : 'Lanjut →' }}
                    </button>
                </div>

            </form>

        </div>
    </div>

    <script>
        // Toggle active state per grup pertanyaan
        document.querySelectorAll('.option').forEach(option => {
            option.addEventListener('click', function () {
                const input = this.querySelector('input');
                const name  = input.name;

                document.querySelectorAll(`input[name="${name}"]`).forEach(inp => {
                    inp.closest('.option').classList.remove('active');
                });

                this.classList.add('active');
                input.checked = true;
            });
        });
    </script>

</body>
</html>