{{-- resources/views/page/kuis.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuis EduTrace</title>

    {{-- Google Font --}}
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

        /* HEADER */
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

        .logo .edu{
            color:#3a2e8f;
        }

        .logo .trace{
            color:#f0a020;
        }

        .logo-sub{
            font-size:12px;
            color:#777;
            margin-top:-6px;
        }

        /* CONTAINER */
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

        .title{
            font-size:22px;
            font-weight:700;
            margin-bottom:10px;
        }

        /* PROGRESS */
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
            width:33%;
            height:100%;
            background:#e89611;
            border-radius:20px;
        }

        /* QUESTION */
        .question{
            font-size:22px;
            font-weight:700;
            margin-bottom:30px;
            line-height:1.5;
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
            font-size:16px;
            color:#333;
        }

        .option.active{
            border-color:#5a4fcf;
            background:#f7f5ff;
        }

        .option.active .circle{
            background:#5a4fcf;
            color:white;
        }

        /* BUTTON */
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
            .card{
                padding:25px;
            }

            .question{
                font-size:18px;
            }

            .option{
                align-items:flex-start;
            }

            .option-text{
                font-size:14px;
            }
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
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

    {{-- CONTENT --}}
    <div class="container">
        <div class="card">

            <div class="title">Modul Penilaian</div>

            {{-- Progress --}}
            <div class="progress-wrapper">
                <div class="progress-info">
                    <span></span>
                    <span>33% selesai</span>
                </div>

                <div class="progress-bar">
                    <div class="progress"></div>
                </div>
            </div>

            {{-- FORM --}}
            <form action="{{ route('hasil') }}" method="GET">

                {{-- PERTANYAAN 1 --}}
                <div class="question">
                    1. Bagaimana pola tidur kamu selama beberapa minggu terakhir?
                </div>

                <label class="option active">
                    <input type="radio" name="q1" value="A" checked>
                    <div class="circle">A</div>
                    <div class="option-text">
                        Saya biasanya tidur cukup dan bangun dalam kondisi cukup segar untuk beraktivitas
                    </div>
                </label>

                <label class="option">
                    <input type="radio" name="q1" value="B">
                    <div class="circle">B</div>
                    <div class="option-text">
                        Jam tidur saya kadang tidak teratur, terkadang cukup tapi sering merasa kurang istirahat
                    </div>
                </label>

                <label class="option">
                    <input type="radio" name="q1" value="C">
                    <div class="circle">C</div>
                    <div class="option-text">
                        Saya sering tidur larut atau kurang tidur sehingga mudah lelah saat belajar
                    </div>
                </label>

                {{-- PERTANYAAN 2 --}}
                <div class="question" style="margin-top:50px;">
                    2. Bagaimana kebiasaan belajar kamu setiap hari?
                </div>

                <label class="option">
                    <input type="radio" name="q2" value="A">
                    <div class="circle">A</div>
                    <div class="option-text">
                        Saya memiliki jadwal belajar yang konsisten dan teratur
                    </div>
                </label>

                <label class="option">
                    <input type="radio" name="q2" value="B">
                    <div class="circle">B</div>
                    <div class="option-text">
                        Saya belajar hanya ketika ada tugas atau ujian
                    </div>
                </label>

                <label class="option">
                    <input type="radio" name="q2" value="C">
                    <div class="circle">C</div>
                    <div class="option-text">
                        Saya sering menunda belajar dan sulit fokus
                    </div>
                </label>

                {{-- PERTANYAAN 3 --}}
                <div class="question" style="margin-top:50px;">
                    3. Bagaimana kondisi fokus kamu saat mengikuti pembelajaran?
                </div>

                <label class="option">
                    <input type="radio" name="q3" value="A">
                    <div class="circle">A</div>
                    <div class="option-text">
                        Saya dapat fokus dengan baik selama pembelajaran berlangsung
                    </div>
                </label>

                <label class="option">
                    <input type="radio" name="q3" value="B">
                    <div class="circle">B</div>
                    <div class="option-text">
                        Saya terkadang kehilangan fokus saat pelajaran berlangsung
                    </div>
                </label>

                <label class="option">
                    <input type="radio" name="q3" value="C">
                    <div class="circle">C</div>
                    <div class="option-text">
                        Saya sering sulit berkonsentrasi dan mudah terdistraksi
                    </div>
                </label>

                {{-- BUTTON --}}
                <div class="btn-area">
                    <button type="submit" class="btn-next">
                        Lanjut →
                    </button>
                </div>

            </form>

        </div>
    </div>

    <script>
        const options = document.querySelectorAll('.option');

        options.forEach(option => {
            option.addEventListener('click', function () {

                const input = this.querySelector('input');
                const name = input.name;

                document.querySelectorAll(`input[name="${name}"]`).forEach(input => {
                    input.closest('.option').classList.remove('active');
                });

                this.classList.add('active');
                input.checked = true;
            });
        });
    </script>

</body>
</html>