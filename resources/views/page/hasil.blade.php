{{-- resources/views/page/hasil.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Analisa - EduTrace</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins', sans-serif;
        }

        body{
            background:#f4f2fb;
        }

        a{
            text-decoration:none;
        }

        /* ================= HEADER ================= */
        .navbar{
            background:#fff;
            padding:18px 40px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            box-shadow:0 1px 5px rgba(0,0,0,0.05);
        }

        .logo{
            display:flex;
            flex-direction:column;
        }

        .logo h1{
            font-size:26px;
            line-height:1;
        }

        .logo .edu{
            color:#352a87;
            font-weight:800;
        }

        .logo .trace{
            color:#f0a11b;
            font-weight:800;
        }

        .logo small{
            color:#888;
            font-size:10px;
        }

        .menu{
            display:flex;
            align-items:center;
            gap:40px;
        }

        .menu a{
            color:#555;
            font-weight:600;
        }

        .menu .active{
            background:#f0a11b;
            color:white;
            padding:12px 22px;
            border-radius:12px;
        }

        /* ================= PROFILE DROPDOWN ================= */
        .profile-dropdown{
            position:relative;
        }

        .profile-btn{
            display:flex;
            align-items:center;
            gap:15px;
            cursor:pointer;
            padding:8px 14px;
            border-radius:12px;
            transition:0.3s;
        }

        .profile-btn:hover{
            background:#f5f5f5;
        }

        .avatar{
            width:48px;
            height:48px;
            background:#43329b;
            border-radius:50%;
        }

        .profile-info h4{
            font-size:15px;
            color:#43329b;
            margin-bottom:2px;
        }

        .profile-info p{
            font-size:13px;
            color:#666;
        }

        .arrow{
            font-size:18px;
            color:#555;
        }

        .dropdown-menu{
            position:absolute;
            top:75px;
            right:0;
            width:220px;
            background:white;
            border-radius:12px;
            box-shadow:0 5px 20px rgba(0,0,0,0.1);
            overflow:hidden;
            display:none;
            z-index:999;
        }

        .dropdown-menu.show{
            display:block;
        }

        .dropdown-menu a{
            display:block;
            padding:14px 18px;
            color:#333;
            font-size:14px;
            font-weight:500;
            transition:0.3s;
        }

        .dropdown-menu a:hover{
            background:#f4f2fb;
            color:#43329b;
        }

        /* ================= LAYOUT ================= */
        .container{
            padding:30px 60px;
        }

        .grid{
            display:grid;
            grid-template-columns:2fr 1fr;
            gap:20px;
        }

        .card{
            background:white;
            border-radius:12px;
            padding:20px;
            border:1px solid #ddd;
        }

        /* ================= RESULT ================= */
        .result-box{
            display:flex;
            gap:25px;
            align-items:center;
        }

        .circle-wrap{
            width:170px;
            height:170px;
            border-radius:50%;
            background:
                conic-gradient(red 0% 70%, #e5e5e5 70% 100%);
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .circle-inner{
            width:120px;
            height:120px;
            background:white;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            flex-direction:column;
            text-align:center;
        }

        .circle-inner h2{
            color:red;
            font-size:20px;
        }

        .result-text h1{
            font-size:26px;
            margin-bottom:10px;
        }

        .result-text p{
            color:#444;
            line-height:1.7;
        }

        /* ================= SMALL CARD ================= */
        .small-grid{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:18px;
            margin-top:20px;
        }

        .small-card{
            background:white;
            border-radius:10px;
            padding:18px;
            border:1px solid #ddd;
        }

        .small-card h4{
            color:#43329b;
            font-size:15px;
            margin-bottom:15px;
            text-align:center;
        }

        .icon{
            font-size:52px;
            text-align:center;
            margin-bottom:12px;
        }

        .risk{
            font-size:13px;
            font-weight:600;
            margin-bottom:6px;
        }

        .risk.high{
            color:red;
        }

        .risk.normal{
            color:#e58d00;
        }

        .risk.low{
            color:green;
        }

        .progress{
            width:100%;
            height:12px;
            background:#ddd;
            border-radius:20px;
            overflow:hidden;
        }

        .bar{
            height:100%;
            border-radius:20px;
        }

        .red{
            width:82%;
            background:red;
        }

        .orange{
            width:55%;
            background:#e58d00;
        }

        .green{
            width:30%;
            background:green;
        }

        /* ================= RIGHT ================= */
        .history h2{
            margin-bottom:20px;
        }

        .history-item{
            border:1px solid #ddd;
            border-radius:10px;
            padding:15px;
            margin-bottom:12px;
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
        }

        .history-item.active{
            background:#f5e4bf;
        }

        .dot{
            width:12px;
            height:12px;
            border-radius:50%;
            background:#999;
            margin-top:6px;
        }

        .dot.orange{
            background:#e89d13;
        }

        .history-left{
            display:flex;
            gap:12px;
        }

        .history-item h4{
            font-size:15px;
        }

        .history-item p{
            font-size:12px;
            color:#666;
        }

        .history-date{
            font-size:12px;
            color:#777;
        }

        .history-note{
            text-align:center;
            color:#888;
            font-size:12px;
            margin-top:12px;
        }

        /* ================= RETEST ================= */
        .retest{
            margin-top:20px;
            background:#43329b;
            color:white;
        }

        .retest h2{
            font-size:26px;
            line-height:1.3;
            margin-bottom:15px;
        }

        .retest p{
            line-height:1.8;
            margin-bottom:20px;
        }

        .btn{
            width:100%;
            border:none;
            background:#e9e2ff;
            padding:16px;
            border-radius:10px;
            font-weight:700;
            font-size:16px;
            cursor:pointer;
            color:#111;
        }

        /* ================= TECHNIQUE ================= */
        .section-title{
            font-size:28px;
            font-weight:800;
            margin:35px 0 20px;
        }

        .tech-grid{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:18px;
        }

        .tech-card{
            background:white;
            border-radius:12px;
            border:1px solid #ddd;
            overflow:hidden;
        }

        .tech-top{
            padding:18px;
        }

        .number{
            width:44px;
            height:44px;
            border-radius:8px;
            background:#f3c56c;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:28px;
            font-weight:700;
            color:#8a5b00;
            margin-bottom:15px;
        }

        .tech-image{
            width:100%;
            height:130px;
            border-radius:10px;
            object-fit:cover;
            margin-bottom:15px;
        }

        .tech-card h3{
            text-align:center;
            color:#43329b;
            margin-bottom:10px;
        }

        .tech-card p{
            text-align:center;
            color:#555;
            line-height:1.8;
            font-size:15px;
        }

        .tech-bottom{
            margin-top:25px;
            border-top:1px solid #ddd;
            padding:20px;
            text-align:center;
            color:#43329b;
            font-weight:700;
            background:linear-gradient(to bottom, white, #e9e2ff);
        }

        @media(max-width:1000px){

            .grid{
                grid-template-columns:1fr;
            }

            .small-grid{
                grid-template-columns:1fr;
            }

            .tech-grid{
                grid-template-columns:1fr;
            }

            .menu{
                display:none;
            }

            .container{
                padding:20px;
            }

            .result-box{
                flex-direction:column;
                text-align:center;
            }
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <div class="navbar">

        <div class="logo">
            <h1>
                <span class="edu">edu</span><span class="trace">Trace</span>
            </h1>
            <small>Transforming Learning Habits, Ensuring Success</small>
        </div>

        <div class="menu">
            <a href="#">Beranda</a>
            <a href="#">Fitur</a>
            <a href="#">FAQ</a>
            <a href="#" class="active">Hasil Analisa</a>
        </div>

        {{-- PROFILE DROPDOWN --}}
        <div class="profile-dropdown">

            <div class="profile-btn" onclick="toggleDropdown()">

                <div class="avatar"></div>

                <div class="profile-info">
                    <h4>Kartika Tri Juliana</h4>
                    <p>Tingkat SMA</p>
                </div>

                <div class="arrow">⌄</div>

            </div>

            <div class="dropdown-menu" id="dropdownMenu">
                <a href="{{ url('/profile') }}">Profil Saya</a>
                <a href="#">Keluar</a>
            </div>

        </div>

    </div>

    <script>
        function toggleDropdown() {
            document.getElementById("dropdownMenu")
                .classList.toggle("show");
        }

        window.onclick = function(event) {

            if (!event.target.closest('.profile-dropdown')) {

                const dropdown =
                    document.getElementById("dropdownMenu");

                if (dropdown.classList.contains('show')) {
                    dropdown.classList.remove('show');
                }
            }
        }
    </script>

</body>
</html>