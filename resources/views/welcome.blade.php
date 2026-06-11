<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTrace</title>

    {{-- GOOGLE FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- FONT AWESOME --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    
    {{-- LOTTIE PLAYER --}}
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <script>

    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    hamburgerBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('show');
    });

    </script>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins', sans-serif;
        }

        html{
            scroll-behavior:smooth;
        }

        body{
            overflow-x:hidden;
            background:#FFFFFF;
        }

        :root{
            --primary:#3C3489;
            --secondary:#EF9F27;
            --soft:#EEEDFE;
            --white:#FFFFFF;
        }

        .container{
            width:90%;
            max-width:1200px;
            margin:auto;
        }

        a{
            text-decoration:none;
        }

        ul{
            list-style:none;
        }

        /* ================= NAVBAR ================= */

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

        /* ================= NAVBAR GUEST BUTTONS ================= */

        .btn-daftar{
            color:#3C3489;
            font-size:13px;
            font-weight:700;
            padding:9px 20px;
            border-radius:8px;
            border:2px solid #3C3489;
            transition:0.3s;
            display:inline-block;
        }

        .btn-daftar:hover{
            background:#3C3489;
            color:#FFFFFF;
        }

        .btn-masuk{
            background:#3C3489;
            color:#FFFFFF;
            font-size:13px;
            font-weight:700;
            padding:9px 20px;
            border-radius:8px;
            border:2px solid #3C3489;
            transition:0.3s;
            display:inline-block;
        }

        .btn-masuk:hover{
            background:#2a2468;
            border-color:#2a2468;
        }

        /* ================= NAVBAR PROFILE DROPDOWN ================= */

        .nav-auth{
            position:absolute;
            right:0;
            display:flex;
            align-items:center;
        }

        .profile-trigger{
            display:flex;
            align-items:center;
            gap:10px;
            cursor:pointer;
            padding:6px 10px;
            border-radius:10px;
            transition:0.2s;
            position:relative;
            user-select:none;
        }

        .profile-trigger:hover{
            background:#F3F2FF;
        }

        .profile-avatar{
            width:38px;
            height:38px;
            border-radius:50%;
            background:#3C3489;
            display:flex;
            align-items:center;
            justify-content:center;
            flex-shrink:0;
        }

        .profile-avatar i{
            color:#FFFFFF;
            font-size:18px;
        }

        .profile-info{
            display:flex;
            flex-direction:column;
            line-height:1.3;
        }

        .profile-name{
            font-size:13px;
            font-weight:700;
            color:#222;
        }

        .profile-level{
            font-size:11px;
            color:#888;
            font-weight:500;
        }

        .profile-trigger .fa-chevron-down{
            font-size:11px;
            color:#888;
            transition:0.3s;
        }

        .profile-trigger.open .fa-chevron-down{
            transform:rotate(180deg);
        }

        /* Dropdown */

        .profile-dropdown{
            position:absolute;
            top:calc(100% + 10px);
            right:0;
            width:200px;
            background:#FFFFFF;
            border-radius:14px;
            box-shadow:0 8px 28px rgba(0,0,0,0.13);
            border:1px solid #EFEFEF;
            padding:10px;
            opacity:0;
            pointer-events:none;
            transform:translateY(-8px);
            transition:0.25s ease;
            z-index:99999;
        }

        .profile-dropdown.show{
            opacity:1;
            pointer-events:all;
            transform:translateY(0);
        }

        .dropdown-item{
            display:flex;
            align-items:center;
            gap:10px;
            padding:11px 14px;
            border-radius:10px;
            font-size:14px;
            font-weight:600;
            cursor:pointer;
            transition:0.2s;
            text-decoration:none;
        }

        .dropdown-item.edit{
            background:#EEEDFE;
            color:#3C3489;
            margin-bottom:2px;
        }

        .dropdown-item.edit:hover{
            background:#dddcfc;
        }

        .dropdown-item.keluar{
            color:#E53535;
            background:transparent;
            margin-top:4px;
        }

        .dropdown-item.keluar:hover{
            background:#FFF0F0;
        }

        .dropdown-divider{
            height:1px;
            background:#F0F0F0;
            margin:6px 0;
        }

        /* ================= HERO ================= */

        .hero{
            width:100%;
            min-height:760px;
            background:
                linear-gradient(rgba(60,52,137,0.82), rgba(60,52,137,0.82)),
                url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=1974&auto=format&fit=crop');
            background-size:cover;
            background-position:center;
            display:flex;
            align-items:center;
            justify-content:center;
            text-align:center;
            padding-top:75px;
        }

        .hero-content img{
            width:160px;
            margin-bottom:20px;
        }

        .hero-content h1{
            color:#FFFFFF;
            font-size:58px;
            line-height:1.2;
            font-weight:800;
            margin-bottom:25px;
        }

        .hero-content p{
            color:#FFFFFF;
            font-size:21px;
            line-height:1.8;
            max-width:950px;
            margin:auto;
            margin-bottom:40px;
        }

        .hero-btn{
            background:#EF9F27;
            border:none;
            color:#FFFFFF;
            padding:16px 65px;
            border-radius:10px;
            font-size:22px;
            font-weight:700;
            cursor:pointer;
            display:inline-block;
        }

        /* ================= FITUR ================= */

        .fitur{
            padding:100px 0;
            background:#F7F7F7;
        }

        .section-title{
            text-align:center;
            color:#3C3489;
            font-size:34px;
            font-weight:800;
            margin-bottom:60px;
        }

        .fitur-grid{
            display:grid;
            grid-template-columns:repeat(3, 1fr);
            gap:28px;
        }

        .fitur-card{
            border-radius:18px;
            background:#FFFFFF;
            border:1.5px solid #E0DCFC;
            padding:40px 28px;
            text-align:center;
            box-shadow:0 4px 16px rgba(0,0,0,0.06);
            transition:0.3s ease;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
        }

        .fitur-card:hover{
            transform:translateY(-6px);
            background:#3C3489;
            border-color:#3C3489;
            box-shadow:0 10px 30px rgba(60,52,137,0.35);
        }

        .fitur-card .icon-wrap{
            width:64px;
            height:64px;
            border-radius:50%;
            background:#EEEDFE;
            display:flex;
            align-items:center;
            justify-content:center;
            margin:0 auto 18px;
            transition:0.3s ease;
        }

        .fitur-card:hover .icon-wrap{
            background:rgba(255,255,255,0.2);
        }

        .fitur-card .icon-wrap i{
            font-size:30px;
            color:#3C3489;
            transition:0.3s ease;
        }

        .fitur-card:hover .icon-wrap i{
            color:#FFFFFF;
        }

        .fitur-card h3{
            font-size:17px;
            font-weight:700;
            margin-bottom:10px;
            line-height:1.4;
            color:#222;
            transition:0.3s ease;
        }

        .fitur-card:hover h3{
            color:#FFFFFF;
        }

        .fitur-card p{
            font-size:13px;
            line-height:1.7;
            color:#666;
            transition:0.3s ease;
        }

        .fitur-card:hover p{
            color:rgba(255,255,255,0.8);
        }

        /* ================= ANALISA SETELAH TES ================= */

        .analisa{
            padding:70px 0 90px;
            background:linear-gradient(180deg, #D8D3F4 0%, #CEC8F1 45%, #C4BDEB 100%);
        }

        .analisa-title{
            font-size:22px;
            font-weight:700;
            color:#3C3489;
            margin-bottom:30px;
            display:flex;
            align-items:center;
            gap:10px;
        }

        .analisa-title::before{
            content:'';
            display:inline-block;
            width:6px;
            height:28px;
            background:#EF9F27;
            border-radius:4px;
        }

        .analisa-grid{
            display:grid;
            grid-template-columns:1.4fr 1fr;
            gap:20px;
            margin-bottom:40px;
            align-items:start;
        }

        .analisa-left{
            display:flex;
            flex-direction:column;
            gap:14px;
        }

        /* ===== HASIL RESIKO CARD (atas) ===== */

        .hasil-card{
            background:#FFFFFF;
            border-radius:16px;
            padding:28px 28px 24px;
            box-shadow:0 4px 16px rgba(0,0,0,0.07);
        }

        .hasil-top{
            display:flex;
            align-items:center;
            gap:24px;
        }

        /* ===== GAUGE / DONUT ===== */

        .risiko-gauge-wrap{
            flex-shrink:0;
            width:130px;
            height:130px;
            position:relative;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .risiko-gauge-wrap svg{
            position:absolute;
            top:0; left:0;
            width:100%; height:100%;
            transform:rotate(-210deg);
        }

        .gauge-bg{
            fill:none;
            stroke:#F0F0F0;
            stroke-width:11;
        }

        .gauge-fill{
            fill:none;
            stroke:#E53535;
            stroke-width:11;
            stroke-linecap:round;
            stroke-dasharray:251;
            stroke-dashoffset:70;
        }

        .risiko-gauge-inner{
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            z-index:1;
        }

        .risiko-gauge-inner .risiko-sub{
            font-size:9px;
            font-weight:500;
            color:#888;
            text-align:center;
            line-height:1.3;
        }

        .risiko-gauge-inner .risiko-main{
            font-size:18px;
            font-weight:800;
            color:#E53535;
            text-align:center;
            letter-spacing:0.5px;
        }

        /* ===== HASIL DESC ===== */

        .hasil-desc-wrap h4{
            font-size:20px;
            font-weight:800;
            color:#111;
            margin-bottom:10px;
        }

        .hasil-desc{
            font-size:13.5px;
            line-height:1.75;
            color:#555;
        }

        /* ===== STAT ROW (3 card bawah terpisah) ===== */

        .stat-row{
            display:grid;
            grid-template-columns: repeat(3, 1fr);
            gap:14px;
            margin-top:16px;
        }

        .stat-item{
            background:#FFFFFF;
            border-radius:14px;
            padding:16px 12px 14px;
            box-shadow:0 4px 14px rgba(0,0,0,0.07);
            display:flex;
            flex-direction:column;
            align-items:center;
            gap:10px;
        }

        .stat-label{
            font-size:12px;
            font-weight:700;
            color:#3C3489;
            text-align:center;
            line-height:1.3;
        }

        .stat-icon-wrap{
            width:52px;
            height:52px;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            background:#EEEDFE;
        }

        .stat-icon-wrap i{ font-size:24px; }
        .stat-icon-wrap.red i{ color:#E53535; }
        .stat-icon-wrap.blue i{ color:#3C3489; }
        .stat-icon-wrap.gray i{ color:#888; }

        .stat-bar{
            width:100%;
            height:7px;
            border-radius:4px;
            background:#F0F0F0;
            overflow:hidden;
        }

        .stat-bar-fill{
            height:100%;
            border-radius:4px;
        }

        .stat-bar-fill.red  { background:#E53535; width:85%; }
        .stat-bar-fill.blue { background:#E53535; width:85%; }
        .stat-bar-fill.gray { background:#EF9F27; width:50%; }

        /* ===== RIWAYAT CARD ===== */

        .riwayat-card{
            background:#FFFFFF;
            border-radius:16px;
            padding:24px;
            box-shadow:0 4px 16px rgba(0,0,0,0.07);
        }

        .riwayat-card h4{
            font-size:18px;
            font-weight:700;
            margin-bottom:16px;
            color:#111;
        }

        .riwayat-item{
            border-radius:12px;
            padding:12px 14px;
            margin-bottom:10px;
            background:#FFFFFF;
            border:1px solid #F0F0F0;
        }

        .riwayat-item.active-item{
            background:#FEF3C7;
            border:1px solid #FDE68A;
        }

        .riwayat-item:last-child{
            margin-bottom:0;
        }

        .riwayat-top-row{
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin-bottom:4px;
        }

        .riwayat-left{
            display:flex;
            align-items:center;
            gap:10px;
        }

        .riwayat-dot{
            width:10px;
            height:10px;
            border-radius:50%;
            flex-shrink:0;
        }

        .riwayat-dot.high  { background:#E53535; }
        .riwayat-dot.low   { background:#22C55E; }
        .riwayat-dot.medium{ background:#F59E0B; }

        .riwayat-info span{
            font-size:13px;
            font-weight:700;
            color:#111;
        }

        .riwayat-date{
            font-size:11px;
            color:#999;
        }

        .riwayat-sub{
            font-size:11px;
            color:#888;
            padding-left:20px;
        }

        .riwayat-footer-note{
            font-size:11px;
            color:#aaa;
            text-align:center;
            margin-top:14px;
        }

        /* ===== TOP 9 TEKNIK ===== */

        .teknik-section{
            margin-top:40px;
        }

        .teknik-title{
            font-size:22px;
            font-weight:700;
            color:#111;
            margin-bottom:20px;
            text-align:center;
        }

        .teknik-grid{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:20px;
        }

        .teknik-card{
            border-radius:12px;
            overflow:hidden;
            box-shadow:0 8px 20px rgba(65,55,160,0.18);
            transition:.3s ease;
            position:relative;
            background:#000;
        }

        .teknik-card:hover{
            transform:translateY(-6px);
            box-shadow:0 14px 30px rgba(65,55,160,0.28);
        }

        .teknik-img{
            width:100%;
            height:220px;
            object-fit:cover;
            display:block;
            transition:0.4s ease;
        }

        .teknik-card:hover .teknik-img{
            transform:scale(1.05);
            opacity:0.85;
        }

        .teknik-overlay{
            position:absolute;
            inset:0;
            background:linear-gradient(
                to bottom,
                rgba(0,0,0,0) 30%,
                rgba(30,20,80,0.55) 65%,
                rgba(20,10,60,0.92) 100%
            );
            pointer-events:none;
        }

        .teknik-label{
            position:absolute;
            bottom:0;
            left:0;
            right:0;
            padding:14px 16px 16px;
            z-index:2;
        }

        .teknik-label h4{
            color:#fff;
            font-size:17px;
            font-weight:800;
            margin:0;
            text-shadow:0 2px 8px rgba(0,0,0,0.5);
            letter-spacing:0.3px;
        }

        /* ===== INFO BUTTON ===== */

        .teknik-info-btn{
            position:absolute;
            top:10px;
            right:10px;
            width:28px;
            height:28px;
            border-radius:50%;
            background:rgba(255,255,255,0.85);
            border:none;
            cursor:pointer;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:13px;
            font-weight:800;
            color:#3C3489;
            transition:0.2s;
            z-index:2;
            line-height:1;
            font-family:'Poppins', sans-serif;
        }

        .teknik-info-btn:hover{
            background:#fff;
            transform:scale(1.1);
        }

        /* ===== MODAL INFO TEKNIK ===== */

        .teknik-modal-overlay{
            position:fixed;
            inset:0;
            background:rgba(0,0,0,0.45);
            z-index:99999;
            display:flex;
            align-items:center;
            justify-content:center;
            opacity:0;
            pointer-events:none;
            transition:0.25s ease;
        }

        .teknik-modal-overlay.show{
            opacity:1;
            pointer-events:all;
        }

        .teknik-modal{
            background:#fff;
            border-radius:18px;
            padding:32px 28px;
            max-width:420px;
            width:90%;
            box-shadow:0 16px 50px rgba(0,0,0,0.22);
            transform:translateY(16px) scale(0.96);
            transition:0.25s ease;
            position:relative;
        }

        .teknik-modal-overlay.show .teknik-modal{
            transform:translateY(0) scale(1);
        }

        .teknik-modal-close{
            position:absolute;
            top:14px;
            right:16px;
            background:none;
            border:none;
            font-size:20px;
            cursor:pointer;
            color:#888;
            line-height:1;
            transition:0.2s;
        }

        .teknik-modal-close:hover{
            color:#333;
        }

        .teknik-modal img{
            width:100%;
            height:160px;
            object-fit:cover;
            border-radius:12px;
            margin-bottom:16px;
        }

        .teknik-modal h4{
            font-size:20px;
            font-weight:800;
            color:#3C3489;
            margin-bottom:10px;
        }

        .teknik-modal p{
            font-size:14px;
            line-height:1.8;
            color:#555;
        }

        /* ================= CARA KERJA ================= */

        .cara-kerja{
            padding:120px 0;
            background:#F8F9FF;
        }

        .cara-title{
            text-align:center;
            font-size:46px;
            font-weight:800;
            margin-bottom:70px;

            background:linear-gradient(
                90deg,
                #3C3489,
                #5B4CD8,
                #EF9F27
            );

            background-clip:text;
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
        }

        .cara-grid{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:28px;
        }

        .cara-card{
            background:#FFFFFF;
            border-radius:24px;
            padding:30px 24px;

            text-align:center;

            border:1px solid #ECE9FF;

            box-shadow:
                0 10px 30px rgba(60,52,137,0.08);

            transition:.35s ease;

            position:relative;
            overflow:hidden;
        }

        .cara-card:hover{
            transform:translateY(-10px);

            box-shadow:
                0 18px 40px rgba(60,52,137,0.15);
        }

        .cara-card::before{
            content:'';
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:5px;

            background:linear-gradient(
                90deg,
                #3C3489,
                #5B4CD8,
                #EF9F27
            );
        }

        .step-badge{
            display:inline-block;

            background:#EEEDFE;
            color:#3C3489;

            font-size:12px;
            font-weight:700;

            padding:7px 16px;
            border-radius:999px;

            margin-bottom:18px;
        }

        .cara-lottie{
            width:120px;
            height:120px;

            margin:0 auto 20px;
        }

        .cara-lottie lottie-player{
            width:100%;
            height:100%;
        }

        .cara-card h3{
            font-size:22px;
            font-weight:700;
            color:#222;

            margin-bottom:12px;
        }

        .cara-card p{
            font-size:14px;
            color:#666;
            line-height:1.9;
        }

        /* ================= HAMBURGER ================= */

        .hamburger{
            display:none;
            border:none;
            background:none;
            font-size:24px;
            color:#3C3489;
            cursor:pointer;
        }

        /* ================= MOBILE ================= */

        @media (max-width:768px){

            /* ---------- CONTAINER ---------- */

            .container{
                width:92%;
            }

            /* ---------- NAVBAR ---------- */

            .navbar{
                height:70px;
            }

            .nav-wrapper{
                display:flex;
                align-items:center;
                height:70px;
                justify-content:space-between;
            }

            .logo{
                position:static;
            }

            .logo img{
                height:55px;
            }

            .mobile-left{
                display:flex;
                align-items:center;
                gap:12px;
            }

            /* HAMBURGER */

            .hamburger{
                display:flex;
                width:40px;
                height:40px;
                align-items:center;
                justify-content:center;
                font-size:22px;
                color:#3C3489;
                cursor:pointer;
            }

            /* MOBILE MENU */

            .nav-menu{
                position:fixed;
                top:70px;
                left:-100%;

                width:260px;
                height:100vh;

                background:#FFFFFF;

                display:none;
                flex-direction:column;
                align-items:flex-start;

                padding:20px;
                gap:10px;

                box-shadow:0 10px 30px rgba(0,0,0,.15);

                transition:.3s ease;

                z-index:9999;
            }

            .nav-menu.show{
                left:0;
            }

            .nav-menu a{
                width:100%;
                display:block;
                padding:14px 16px;
                border-radius:10px;
            }

            .nav-menu a:hover{
                background:#EEEDFE;
            }

            .nav-auth{
                position:static;
            }

            .profile-info{
                display:none;
            }

            .profile-trigger .fa-chevron-down{
                display:none;
            }

            .btn-daftar,
            .btn-masuk{
                font-size:11px;
                padding:7px 12px;
            }

            /* ---------- HERO ---------- */

            .hero{
                min-height:100vh;
                padding:100px 15px 40px;
            }

            .hero-content img{
                width:110px;
                margin-bottom:15px;
            }

            .hero-content h1{
                font-size:34px;
                line-height:1.25;
                margin-bottom:20px;
            }

            .hero-content p{
                font-size:15px;
                line-height:1.8;
                margin-bottom:30px;
            }

            .hero-btn{
                font-size:17px;
                padding:13px 35px;
            }

            /* ---------- TITLE ---------- */

            .section-title{
                font-size:26px;
                margin-bottom:40px;
            }

            /* ---------- FITUR ---------- */

            .fitur{
                padding:70px 0;
            }

            .fitur-grid{
                grid-template-columns:1fr;
                gap:20px;
            }

            /* ---------- ANALISA ---------- */

            .analisa{
                padding:60px 0;
            }

            .analisa-grid{
                grid-template-columns:1fr;
            }

            .hasil-top{
                flex-direction:column;
                text-align:center;
            }

            .stat-row{
                grid-template-columns:1fr;
            }

            /* ---------- TEKNIK ---------- */

            .teknik-grid{
                grid-template-columns:1fr;
            }

            .teknik-img{
                height:220px;
            }

            /* ---------- CARA KERJA ---------- */

            .cara-kerja{
                padding:80px 0;
            }

            .cara-title{
                font-size:32px;
                margin-bottom:40px;
            }

            .cara-grid{
                grid-template-columns:1fr;
            }

            .cara-card{
                padding:25px;
            }

            .cara-lottie{
                width:100px;
                height:100px;
            }

            /* ---------- TUJUAN ---------- */

            .tujuan{
                padding:70px 0;
            }

            .tujuan-title{
                width:100%;
                text-align:center;
                font-size:22px;
            }

            .tujuan-item{
                flex-direction:column;
                text-align:center;
            }

            .tujuan-item p{
                font-size:14px;
            }

            /* ---------- FAQ ---------- */

            .faq{
                padding:70px 0;
            }

            .faq h2{
                font-size:36px;
            }

            .faq-question span{
                font-size:15px;
                padding-right:10px;
            }

            .faq-answer{
                font-size:14px;
            }

            /* ---------- FOOTER ---------- */

            .footer-wrapper{
                flex-direction:column;
                gap:30px;
            }

            .footer-brand p{
                max-width:100%;
            }

        }


        /* ================= TUJUAN ================= */

        .tujuan{
            padding:90px 0;
            background:linear-gradient(180deg, #D8D3F4 0%, #CEC8F1 45%, #C4BDEB 100%);
        }

        .tujuan-box{
            background:#F9F9F9;
            border-radius:18px;
            padding:30px;
            box-shadow:0 4px 10px rgba(0,0,0,0.03);
        }

        .tujuan-title{
            width:170px;
            background:linear-gradient(to right, #6A56C9, #EF9F27);
            padding:12px 25px;
            border-radius:20px;
            color:#FFFFFF;
            font-size:26px;
            font-weight:700;
            margin-bottom:30px;
        }

        .tujuan-item{
            border:1.5px solid #4D46A6;
            border-radius:16px;
            padding:20px;
            display:flex;
            align-items:center;
            gap:18px;
            margin-bottom:18px;
        }

        .tujuan-item:last-child{
            margin-bottom:0;
        }

        .tujuan-icon{
            width:48px;
            height:48px;
            border-radius:8px;
            background:linear-gradient(to bottom, #B5A8FF, #3C3489);
            display:flex;
            align-items:center;
            justify-content:center;
            flex-shrink:0;
        }

        .tujuan-icon i{
            color:#FFFFFF;
            font-size:20px;
        }

        .tujuan-item p{
            font-size:16px;
            line-height:1.8;
            font-weight:600;
            color:#3F3F3F;
        }

        /* ================= FAQ ================= */

        .faq{
            padding:90px 0;
            background:#FFFFFF;
        }

        .faq h2{
            text-align:center;
            color:#5A54B8;
            font-size:58px;
            font-weight:800;
            margin-bottom:40px;
        }

        .faq-wrapper{
            max-width:820px;
            margin:auto;
        }

        .faq-item{
            border:1.5px solid #4D46A6;
            border-radius:14px;
            margin-bottom:14px;
            overflow:hidden;
            background:#FFFFFF;
        }

        .faq-question{
            padding:22px 24px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            cursor:pointer;
        }

        .faq-question span{
            font-size:18px;
            font-weight:700;
        }

        .faq-question i{
            transition:0.3s;
        }

        .faq-answer{
            max-height:0;
            overflow:hidden;
            transition:0.4s ease;
            padding:0 24px;
            line-height:2;
            color:#444;
        }

        .faq-item.active .faq-answer{
            max-height:300px;
            padding:0 24px 24px;
        }

        .faq-item.active .faq-question i{
            transform:rotate(180deg);
        }

        /* ================= FOOTER ================= */

        footer{
            background:#120D49;
            color:#FFFFFF;
            padding:60px 0 20px;
        }

        .footer-wrapper{
            display:flex;
            justify-content:space-between;
            gap:40px;
            margin-bottom:40px;
        }

        .footer-logo{
            display:flex;
            align-items:center;
            gap:12px;
            margin-bottom:18px;
        }

        .footer-logo img{
            width:80px;
            height:80px;
            object-fit:contain;
        }

        .footer-logo h2{
            font-size:28px;
            font-weight:800;
        }

        .footer-logo h2 span{
            color:#EF9F27;
        }

        .footer-brand p{
            line-height:1.9;
            max-width:300px;
        }

        .footer-contact h3{
            margin-bottom:18px;
        }

        .footer-contact p{
            margin-bottom:12px;
        }

        .footer-social p{
            margin-bottom:15px;
            display:flex;
            align-items:center;
            gap:12px;
        }

        .footer-social i{
            width:30px;
            height:30px;
            border-radius:8px;
            display:flex;
            align-items:center;
            justify-content:center;
            color:#FFFFFF;
        }

        .fa-facebook-f{ background:#3461FF; }
        .fa-instagram{ background:#FF5C9D; }
        .fa-youtube{ background:#FF3131; }

        .footer-bottom{
            border-top:1px solid rgba(255,255,255,0.2);
            padding-top:18px;
            text-align:center;
            font-size:14px;
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width:768px){
            .hero-content h1{ font-size:32px; }
            .hero-content p{ font-size:15px; }
            .hero-btn{ font-size:16px; padding:12px 36px; }
            .fitur-grid{ grid-template-columns:1fr; }
            .analisa-grid{ grid-template-columns:1fr; }
            .teknik-grid{ grid-template-columns:1fr; }
            .footer-wrapper{ flex-direction:column; }
            .faq h2{ font-size:34px; }
            .section-title{ font-size:22px; }
            .profile-info{ display:none; }
            .profile-trigger .fa-chevron-down{ display:none; }
            .nav-auth-guest{ gap:6px; }
            .btn-daftar, .btn-masuk{ font-size:11px; padding:7px 12px; }
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

            <ul class="nav-menu">
                <li><a href="#beranda" class="nav-link active">Beranda</a></li>
                <li><a href="#fitur" class="nav-link">Fitur</a></li>
                <li><a href="#faq" class="nav-link">FAQ</a></li>
                <li>
                    @auth
                        <a href="{{ route('kuis.hasil') }}" class="nav-link">Hasil Analisa</a>
                    @else
                        <a href="{{ route('reAnalisa') }}" class="nav-link">Hasil Analisa</a>
                    @endauth
                </li>
            </ul>

            {{-- AUTH: sudah login --}}
            @auth
            <div class="nav-auth">
                <div class="profile-trigger" id="profileTrigger">

                    <div class="profile-avatar">

                        @if(Auth::user()->siswa && Auth::user()->siswa->foto)
                            <img
                                src="{{ asset('storage/' . Auth::user()->siswa->foto) }}"
                                alt="Profile"
                                style="
                                    width:100%;
                                    height:100%;
                                    object-fit:cover;
                                    border-radius:50%;
                                ">
                        @else
                            <img
                                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->siswa->nama ?? 'User') }}"
                                alt="Profile"
                                style="
                                    width:100%;
                                    height:100%;
                                    object-fit:cover;
                                    border-radius:50%;
                                ">
                        @endif

                    </div>

                    <div class="profile-info">
                    <span class="profile-name">
                        {{ Auth::user()->siswa->nama ?? 'User' }}
                    </span>

                    <span class="profile-level">
                        {{ Auth::user()->siswa->jenjang ?? '-' }}
                    </span>
                </div>

                    <i class="fa-solid fa-chevron-down"></i>

                    <div class="profile-dropdown" id="profileDropdown">

                        <a href="{{ route('profile.edit') }}" class="dropdown-item edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                            Edit Profil
                        </a>

                        <div class="dropdown-divider"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                type="submit"
                                class="dropdown-item keluar"
                                style="width:100%;border:none;background:none;font-family:'Poppins',sans-serif;cursor:pointer;"
                            >
                                <i class="fa-solid fa-right-from-bracket"></i>
                                Keluar
                            </button>
                        </form>

                    </div>

                </div>
            </div>
            @endauth

            {{-- GUEST: belum login --}}
            @guest
            <div class="nav-auth" style="gap:10px;">
                {{-- <a href="{{ route('register') }}" class="btn-daftar">Daftar</a> --}}
                <a href="{{ route('login') }}" class="btn-masuk">Masuk</a>
            </div>
            @endguest

        </div>

    </nav>

    {{-- ================= HERO ================= --}}
    <section class="hero" id="beranda">

        <div class="hero-content container">

            <img src="{{ asset('images/edutrace2.png') }}" alt="">

            <h1>
                SISTEM KEBIASAAN BELAJAR <br>
                PADA SISWA
            </h1>

            <p>
                Manfaatkan AI canggih untuk menganalisis risiko akademik,
                dan menentukan teknik belajar yang dipersonalisasi khusus
                untuk peningkatan performa siswa SMP dan SMA sederajat.
            </p>

            @auth
                <a href="{{ route('kuis') }}" class="hero-btn">Mulai Test</a>
            @else
                <a href="{{ route('login') }}" class="hero-btn">Mulai Test</a>
            @endauth

        </div>

    </section>

    {{-- ================= CARA KERJA ================= --}}
    <section class="cara-kerja">

        <div class="container">

            <h2 class="cara-title">
                Cara Kerjanya Gampang!
            </h2>

            <div class="cara-grid">

                <!-- STEP 1 -->
                <div class="cara-card">

                    <span class="step-badge">STEP 1</span>

                    <div class="cara-lottie">
                        <lottie-player
                            src="{{ asset('lottie/Form.json') }}"
                            background="transparent"
                            speed="1"
                            loop
                            autoplay>
                        </lottie-player>
                    </div>

                    <h3>Isi Kuesioner</h3>

                    <p>
                        Jawab beberapa pertanyaan mengenai
                        kebiasaan belajar yang kamu lakukan sehari-hari.
                    </p>

                </div>

                <!-- STEP 2 -->
                <div class="cara-card">

                    <span class="step-badge">STEP 2</span>

                    <div class="cara-lottie">
                        <lottie-player
                            src="{{ asset('lottie/Robot.json') }}"
                            background="transparent"
                            speed="1"
                            loop
                            autoplay>
                        </lottie-player>
                    </div>

                    <h3>Analisis AI</h3>

                    <p>
                        Sistem akan menganalisis pola belajar
                        dan menghitung tingkat risiko akademikmu.
                    </p>

                </div>

                <!-- STEP 3 -->
                <div class="cara-card">

                    <span class="step-badge">STEP 3</span>

                    <div class="cara-lottie">
                        <lottie-player
                            src="{{ asset('lottie/Visualisasi.json') }}"
                            background="transparent"
                            speed="1"
                            loop
                            autoplay>
                        </lottie-player>
                    </div>

                    <h3>Hasil Risiko</h3>

                    <p>
                        Dapatkan hasil analisis risiko akademik
                        secara otomatis dan mudah dipahami.
                    </p>

                </div>

                <!-- STEP 4 -->
                <div class="cara-card">

                    <span class="step-badge">STEP 4</span>

                    <div class="cara-lottie">
                        <lottie-player
                            src="{{ asset('lottie/Learning.json') }}"
                            background="transparent"
                            speed="1"
                            loop
                            autoplay>
                        </lottie-player>
                    </div>

                    <h3>Rekomendasi Teknik</h3>

                    <p>
                        Sistem memberikan teknik belajar yang
                        paling sesuai berdasarkan hasil analisismu.
                    </p>

                </div>

            </div>

        </div>

    </section>

    {{-- ================= FITUR ================= --}}
    <section class="fitur" id="fitur">

        <div class="container">

            <h2 class="section-title">AKSES FITUR SISTEM REKOMENDASI</h2>

            <div class="fitur-grid">

                <div class="fitur-card">
                    <div class="icon-wrap"><i class="fa-solid fa-stopwatch"></i></div>
                    <h3>Teknik Belajar</h3>
                    <p>Teknik Belajar yang cocok sesuai kondisi dari siswa</p>
                </div>

                <div class="fitur-card">
                    <div class="icon-wrap"><i class="fa-regular fa-face-smile"></i></div>
                    <h3>Hasil Resiko Akademik</h3>
                    <p>Meningkatkan kebiasaan akademik dari kebiasaan akademik yang beresiko</p>
                </div>

                <div class="fitur-card">
                    <div class="icon-wrap"><i class="fa-solid fa-chart-column"></i></div>
                    <h3>Riwayat</h3>
                    <p>Riwayat untuk mengetahui hasil tes dari terakhir</p>
                </div>

            </div>

        </div>

    </section>

    {{-- ================= ANALISA SETELAH TES ================= --}}
    <section class="analisa">

        <div class="container">

            <div class="analisa-title">Contoh Analisa Setelah Tes</div>

            <div class="analisa-grid">

                <div class="analisa-left">

                    {{-- Hasil Resiko Belajar --}}
                    <div class="hasil-card">

                        <div class="hasil-top">

                            {{-- Gauge / Donut SVG --}}
                            <div class="risiko-gauge-wrap">
                                <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                    <circle class="gauge-bg" cx="50" cy="50" r="40"/>
                                    <circle class="gauge-fill" cx="50" cy="50" r="40"/>
                                </svg>
                                <div class="risiko-gauge-inner">
                                    <span class="risiko-sub">Level Resiko</span>
                                    <span class="risiko-main">HIGH</span>
                                </div>
                            </div>

                            <div class="hasil-desc-wrap">
                                <h4>Hasil Resiko Belajar</h4>
                                <div class="hasil-desc">
                                    Berdasarkan pola aktivitas Anda, tingkat risiko burnout berada
                                    pada level menengah. Disarankan untuk mengatur jadwal
                                    istirahat yang lebih konsisten untuk menjaga performa kognitif
                                    jangka panjang.
                                </div>
                            </div>

                        </div>

                    </div>

                    {{-- 3 Stat Card terpisah di bawah hasil card --}}
                    <div class="stat-row">

                        <div class="stat-item">
                            <span class="stat-label">Jam Belajar</span>
                            <div class="stat-icon-wrap red">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div class="stat-bar"><div class="stat-bar-fill red"></div></div>
                            <span style="font-size:11px;font-weight:600;color:#E53535;">Resiko Tinggi</span>
                        </div>

                        <div class="stat-item">
                            <span class="stat-label">Jam Tidur</span>
                            <div class="stat-icon-wrap blue">
                                <i class="fa-solid fa-moon"></i>
                            </div>
                            <div class="stat-bar"><div class="stat-bar-fill blue"></div></div>
                            <span style="font-size:11px;font-weight:600;color:#E53535;">Resiko Tinggi</span>
                        </div>

                        <div class="stat-item">
                            <span class="stat-label">Akses Pembelajaran</span>
                            <div class="stat-icon-wrap gray">
                                <i class="fa-solid fa-book-open"></i>
                            </div>
                            <div class="stat-bar"><div class="stat-bar-fill gray"></div></div>
                            <span style="font-size:11px;font-weight:600;color:#EF9F27;">Resiko Normal</span>
                        </div>

                    </div>

                </div>{{-- end analisa-left --}}

                {{-- Riwayat Test --}}
                <div class="riwayat-card">

                    <h4>Riwayat Test</h4>

                    <div class="riwayat-item active-item">
                        <div class="riwayat-top-row">
                            <div class="riwayat-left">
                                <div class="riwayat-dot high"></div>
                                <div class="riwayat-info"><span>Level Resiko High</span></div>
                            </div>
                            <span class="riwayat-date">12 Mei 2025</span>
                        </div>
                        <div class="riwayat-sub">Mulai Test : 12.00 WIB</div>
                    </div>

                    <div class="riwayat-item">
                        <div class="riwayat-top-row">
                            <div class="riwayat-left">
                                <div class="riwayat-dot low"></div>
                                <div class="riwayat-info"><span>Level Resiko Low</span></div>
                            </div>
                            <span class="riwayat-date">05 Mei 2025</span>
                        </div>
                        <div class="riwayat-sub">Mulai Test : 10.00 WIB</div>
                    </div>

                    <div class="riwayat-item">
                        <div class="riwayat-top-row">
                            <div class="riwayat-left">
                                <div class="riwayat-dot low"></div>
                                <div class="riwayat-info"><span>Level Resiko Low</span></div>
                            </div>
                            <span class="riwayat-date">21 Mei 2025</span>
                        </div>
                        <div class="riwayat-sub">Mulai Test : 09.00 WIB</div>
                    </div>

                    <div class="riwayat-item">
                        <div class="riwayat-top-row">
                            <div class="riwayat-left">
                                <div class="riwayat-dot medium"></div>
                                <div class="riwayat-info"><span>Level Resiko Medium</span></div>
                            </div>
                            <span class="riwayat-date">09 April 2025</span>
                        </div>
                        <div class="riwayat-sub">Mulai Test : 17.00 WIB</div>
                    </div>

                    <p class="riwayat-footer-note">Hanya tersimpan 30 hari terakhir yang ditampilkan diatas</p>

                </div>

            </div>

            {{-- Top 9 Teknik --}}
            <div class="teknik-section">

                <h3 class="teknik-title">Rekomendasi Teknik Belajar</h3>

                <div class="teknik-grid">

                    <div class="teknik-card">
                        <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=600" alt="Pomodoro" class="teknik-img">
                        <div class="teknik-overlay"></div>
                        <button class="teknik-info-btn" onclick="openTeknikModal('Pomodoro','https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=600','Teknik Pomodoro adalah metode belajar atau bekerja dengan membagi waktu menjadi sesi fokus 25 menit yang diselingi istirahat singkat 5 menit. Setelah 4 sesi, ambil istirahat lebih panjang 15–30 menit. Metode ini terbukti meningkatkan fokus, mengurangi kelelahan mental, dan membantu manajemen waktu belajar.')">i</button>
                        <div class="teknik-label"><h4>Pomodoro</h4></div>
                    </div>

                    <div class="teknik-card">
                        <img src="https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?w=600" alt="Feynman" class="teknik-img">
                        <div class="teknik-overlay"></div>
                        <button class="teknik-info-btn" onclick="openTeknikModal('Feynman','https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?w=600','Metode Feynman adalah teknik belajar cepat untuk memahami konsep sulit dengan cara menjelaskan ulang materi menggunakan bahasa yang sederhana, seolah-olah kamu sedang mengajarkannya kepada orang lain yang baru belajar. Jika ada bagian yang sulit dijelaskan, itu sinyal untuk kembali belajar bagian tersebut.')">i</button>
                        <div class="teknik-label"><h4>Feynman</h4></div>
                    </div>

                    <div class="teknik-card">
                        <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=600" alt="Active Recall" class="teknik-img">
                        <div class="teknik-overlay"></div>
                        <button class="teknik-info-btn" onclick="openTeknikModal('Active Recall','https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=600','Active Recall adalah teknik belajar dengan mengingat informasi secara aktif tanpa melihat catatan. Alih-alih membaca ulang, kamu menutup buku lalu mencoba mengingat kembali apa yang telah dipelajari. Teknik ini memperkuat jalur memori di otak dan jauh lebih efektif dibandingkan membaca pasif.')">i</button>
                        <div class="teknik-label"><h4>Active Recall</h4></div>
                    </div>

                    <div class="teknik-card">
                        <img src="https://images.unsplash.com/photo-1516534775068-ba3e7458af70?w=600" alt="Spaced Repetition" class="teknik-img">
                        <div class="teknik-overlay"></div>
                        <button class="teknik-info-btn" onclick="openTeknikModal('Spaced Repetition','https://images.unsplash.com/photo-1516534775068-ba3e7458af70?w=600','Spaced Repetition adalah teknik mengulang materi pada interval waktu yang semakin lama seiring bertambahnya penguasaan materi. Alih-alih belajar sekaligus (cramming), kamu mengulas materi hari ini, lalu 2 hari lagi, lalu seminggu lagi. Teknik ini sangat efektif untuk hafalan jangka panjang.')">i</button>
                        <div class="teknik-label"><h4>Spaced Repetition</h4></div>
                    </div>

                    <div class="teknik-card">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=600" alt="Interleaving" class="teknik-img">
                        <div class="teknik-overlay"></div>
                        <button class="teknik-info-btn" onclick="openTeknikModal('Interleaving','https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=600','Interleaving adalah teknik belajar dengan mencampur beberapa topik atau mata pelajaran berbeda dalam satu sesi belajar, daripada menyelesaikan satu topik hingga tuntas sebelum pindah ke topik lain. Meski terasa lebih sulit, teknik ini terbukti meningkatkan kemampuan problem-solving dan transfer pengetahuan.')">i</button>
                        <div class="teknik-label"><h4>Interleaving</h4></div>
                    </div>

                    <div class="teknik-card">
                        <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=600" alt="Blurting Method" class="teknik-img">
                        <div class="teknik-overlay"></div>
                        <button class="teknik-info-btn" onclick="openTeknikModal('Blurting Method','https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=600','Blurting Method adalah teknik belajar dengan cara membaca materi sekali, lalu menutup buku dan menulis atau mengucapkan semua yang kamu ingat tanpa melihat catatan. Setelah selesai, bandingkan dengan materi asli dan tandai bagian yang terlewat. Ulangi prosesnya hingga semua bagian terkuasai.')">i</button>
                        <div class="teknik-label"><h4>Blurting Method</h4></div>
                    </div>

                    <div class="teknik-card">
                        <img src="https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?w=600" alt="Mind Mapping" class="teknik-img">
                        <div class="teknik-overlay"></div>
                        <button class="teknik-info-btn" onclick="openTeknikModal('Mind Mapping','https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?w=600','Mind Mapping adalah teknik mencatat visual dengan menempatkan topik utama di tengah, lalu membuat cabang-cabang yang menghubungkan ide-ide terkait. Metode ini memanfaatkan kedua sisi otak, membuat informasi lebih mudah diingat dan dipahami secara menyeluruh, cocok untuk merangkum bab yang kompleks.')">i</button>
                        <div class="teknik-label"><h4>Mind Mapping</h4></div>
                    </div>

                    <div class="teknik-card">
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=600" alt="Teach Back" class="teknik-img">
                        <div class="teknik-overlay"></div>
                        <button class="teknik-info-btn" onclick="openTeknikModal('Teach Back','https://images.unsplash.com/photo-1509062522246-3755977927d7?w=600','Teach Back adalah teknik belajar dengan cara mengajarkan kembali materi yang telah dipelajari kepada orang lain, seperti teman atau anggota keluarga. Proses mengajar memaksa otak untuk mengorganisir informasi dengan lebih terstruktur dan mengidentifikasi bagian yang belum benar-benar dipahami.')">i</button>
                        <div class="teknik-label"><h4>Teach Back</h4></div>
                    </div>

                    <div class="teknik-card">
                        <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=600" alt="SQ3R" class="teknik-img">
                        <div class="teknik-overlay"></div>
                        <button class="teknik-info-btn" onclick="openTeknikModal('SQ3R','https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=600','SQ3R adalah metode membaca terstruktur yang terdiri dari 5 langkah: Survey (tinjau sekilas), Question (buat pertanyaan), Read (baca untuk menjawab), Recite (ceritakan kembali), dan Review (ulang keseluruhan). Metode ini sangat efektif untuk memahami teks akademis yang panjang dan padat.')">i</button>
                        <div class="teknik-label"><h4>SQ3R</h4></div>
                    </div>

                </div>

            </div>

        </div>

    </section>

    {{-- ===== MODAL INFO TEKNIK ===== --}}
    <div class="teknik-modal-overlay" id="teknikModalOverlay" onclick="closeTeknikModal(event)">
        <div class="teknik-modal" id="teknikModal">
            <button class="teknik-modal-close" onclick="document.getElementById('teknikModalOverlay').classList.remove('show')">&#x2715;</button>
            <img id="modalImg" src="" alt="">
            <h4 id="modalTitle"></h4>
            <p id="modalDesc"></p>
        </div>
    </div>

    {{-- ================= TUJUAN ================= --}}
    <section class="tujuan">

        <div class="container">

            <div class="tujuan-box">

                <div class="tujuan-title">TUJUAN</div>

                <div class="tujuan-item">
                    <div class="tujuan-icon"><i class="fa-solid fa-brain"></i></div>
                    <p>Mengetahui cara belajar sesuai dengan kondisi dan kebiasaan dari siswa untuk meningkatkan performa akademik</p>
                </div>

                <div class="tujuan-item">
                    <div class="tujuan-icon"><i class="fa-solid fa-briefcase"></i></div>
                    <p>Meningkatkan kebiasaan siswa dari resiko kebiasaan yang dilakukan untuk mengurangi resiko akademik lainnya</p>
                </div>

                <div class="tujuan-item">
                    <div class="tujuan-icon"><i class="fa-solid fa-user-gear"></i></div>
                    <p>Meningkatkan produktivitas pada siswa untuk termotivasi belajar dalam meningkatkan akademik</p>
                </div>

                <div class="tujuan-item">
                    <div class="tujuan-icon"><i class="fa-solid fa-book"></i></div>
                    <p>Mengetahui Teknik belajar yang cocok untuk dilakukan evaluasi pembelajaran</p>
                </div>

            </div>

        </div>

    </section>

    {{-- ================= FAQ ================= --}}
    <section class="faq" id="faq">

        <div class="container">

            <h2>Frequently Asked Questions</h2>

            <div class="faq-wrapper">

                <div class="faq-item">
                    <div class="faq-question">
                        <span>1. Apa itu EduTrace?</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        EduTrace adalah sistem berbasis AI yang dirancang untuk menganalisis kebiasaan belajar siswa, mendeteksi risiko akademik, dan memberikan rekomendasi teknik belajar yang dipersonalisasi.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>2. Bagaimana Jika lupa Password?</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Anda dapat melakukan reset password melalui halaman login dengan menekan tombol "Lupa Password".
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>3. Apakah hasil akan valid dan terjamin?</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Sistem menggunakan analisis AI mutakhir untuk memberikan rekomendasi terbaik berdasarkan data kebiasaan belajar Anda.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>4. Apakah data aman?</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Ya, seluruh data Anda disimpan secara aman dan terenkripsi. Kami tidak membagikan data pribadi kepada pihak ketiga.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>5. EduTech itu ngapain saja?</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        EduTech membantu siswa mengenali pola belajar mereka, mendeteksi risiko akademik, dan memberikan strategi belajar yang paling efektif sesuai kondisi masing-masing.
                    </div>
                </div>

            </div>

        </div>

    </section>

    {{-- ================= FOOTER ================= --}}
    <footer>

        <div class="container">

            <div class="footer-wrapper">

                <div class="footer-brand">
                    <div class="footer-logo">
                        <img src="{{ asset('images/edutrace2.png') }}" alt="">
                        <h2>edu<span>Trace</span></h2>
                    </div>
                    <p>Revolusi digital dalam pengelolaan kebiasaan belajar siswa dengan rekomendasi untuk masa depan pendidikan tinggi.</p>
                </div>

                <div class="footer-contact">
                    <h3>Informasi Kami</h3>
                    <p><i class="fa-solid fa-envelope"></i> EduTech@instansia.ac.id</p>
                    <p><i class="fa-solid fa-globe"></i> www.EduTecha.ac.id</p>
                </div>

                <div class="footer-social">
                    <p><i class="fa-brands fa-facebook-f"></i> Facebook</p>
                    <p><i class="fa-brands fa-instagram"></i> Instagram</p>
                    <p><i class="fa-brands fa-youtube"></i> Youtube</p>
                </div>

            </div>

            <div class="footer-bottom">
                © 2026 EduTech - Sistem Kebiasaan Belajar. All rights reserved.
            </div>

        </div>

    </footer>

    <script>

        // ================= FAQ =================

        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            question.addEventListener('click', () => {
                faqItems.forEach(faq => {
                    if(faq !== item) faq.classList.remove('active');
                });
                item.classList.toggle('active');
            });
        });

        // ================= ACTIVE NAVBAR (SCROLL) =================

        const navLinks = document.querySelectorAll('.nav-link');
        const sections = document.querySelectorAll('section[id]');

        navLinks.forEach(link => {
            link.addEventListener('click', function(){
                navLinks.forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });

        const observerOptions = {
            root: null,
            rootMargin: '-50% 0px -50% 0px',
            threshold: 0
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.getAttribute('id');
                    navLinks.forEach(nav => {
                        nav.classList.remove('active');
                        const href = nav.getAttribute('href');
                        if (href === '#' + id) {
                            nav.classList.add('active');
                        }
                    });
                }
            });
        }, observerOptions);

        sections.forEach(section => observer.observe(section));

        // ================= PROFILE DROPDOWN =================

        const profileTrigger = document.getElementById('profileTrigger');
        const profileDropdown = document.getElementById('profileDropdown');

        if (profileTrigger && profileDropdown) {

            profileTrigger.addEventListener('click', function(e) {
                e.stopPropagation();
                profileTrigger.classList.toggle('open');
                profileDropdown.classList.toggle('show');
            });

            document.addEventListener('click', function() {
                profileTrigger.classList.remove('open');
                profileDropdown.classList.remove('show');
            });

            profileDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
            });

        }

        // ================= TEKNIK MODAL =================

        function openTeknikModal(title, img, desc) {
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalImg').src = img;
            document.getElementById('modalImg').alt = title;
            document.getElementById('modalDesc').textContent = desc;
            document.getElementById('teknikModalOverlay').classList.add('show');
        }

        function closeTeknikModal(e) {
            if (e.target === document.getElementById('teknikModalOverlay')) {
                document.getElementById('teknikModalOverlay').classList.remove('show');
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.getElementById('teknikModalOverlay').classList.remove('show');
            }
        });

    </script>

</body>
</html>