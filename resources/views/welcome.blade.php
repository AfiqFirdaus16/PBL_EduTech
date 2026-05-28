{{-- resources/views/welcome.blade.php --}}

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

    {{-- SWIPER --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

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

        /* LOGO KIRI MENTOK */
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

        /* MENU TENGAH */
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
            width:90px;
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
        }

        /* ================= FITUR ================= */

        .fitur{
            padding:100px 0;
            background:#F7F7F7;
            overflow:hidden;
        }

        .section-title{
            text-align:center;
            color:#3C3489;
            font-size:34px;
            font-weight:800;
            margin-bottom:60px;
        }

        .fiturSwiper{
            width:100%;
            padding:20px 40px 70px 40px;
        }

        .swiper-slide{
            display:flex;
            justify-content:center;
            opacity:0.5;
            transform:scale(0.88);
            transition:0.4s ease;
        }

        .swiper-slide-active{
            opacity:1;
            transform:scale(1);
        }

        .fitur-card{
            width:280px;
            min-height:260px;

            border-radius:18px;

            background:
            linear-gradient(
                to bottom,
                #F4D29B,
                #B4A5F5
            );

            padding:30px 24px;

            text-align:center;

            box-shadow:
            0 8px 20px rgba(0,0,0,0.08);

            transition:0.4s ease;
        }

        .fitur-card:hover{
            transform:translateY(-8px);
        }

        .fitur-card i{
            font-size:60px;
            color:#3C3489;
            margin-bottom:22px;
        }

        .fitur-card h3{
            font-size:20px;
            font-weight:800;
            margin-bottom:14px;
            line-height:1.5;
            color:#000;
        }

        .fitur-card p{
            font-size:14px;
            line-height:1.8;
            color:#222;
        }

        .swiper-pagination-bullet{
            width:10px;
            height:10px;
            background:#B6AEF8;
            opacity:1;
        }

        .swiper-pagination-bullet-active{
            width:28px;
            border-radius:20px;
            background:#3C3489;
        }

        /* ================= TUJUAN ================= */

        .tujuan{
            padding:90px 0;

            background:linear-gradient(
                180deg,
                #D8D3F4 0%,
                #CEC8F1 45%,
                #C4BDEB 100%
            );
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

        .tujuan-icon{
            width:48px;
            height:48px;
            border-radius:8px;
            background:linear-gradient(to bottom, #B5A8FF, #3C3489);

            display:flex;
            align-items:center;
            justify-content:center;
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

        .fa-facebook-f{
            background:#3461FF;
        }

        .fa-instagram{
            background:#FF5C9D;
        }

        .fa-youtube{
            background:#FF3131;
        }

        .footer-bottom{
            border-top:1px solid rgba(255,255,255,0.2);
            padding-top:18px;
            text-align:center;
            font-size:14px;
        }

    </style>
</head>
<body>

    {{-- ================= NAVBAR ================= --}}
    <nav class="navbar">

        <div class="container nav-wrapper">

            {{-- LOGO --}}
            <div class="logo">
                <img src="{{ asset('images/edutrace.png') }}" alt="logo">
            </div>

            {{-- MENU --}}
            <ul class="nav-menu">

                <li>
                    <a href="#beranda" class="nav-link active">
                        Beranda
                    </a>
                </li>

                <li>
                    <a href="#fitur" class="nav-link">
                        Fitur
                    </a>
                </li>

                <li>
                    <a href="#faq" class="nav-link">
                        FAQ
                    </a>
                </li>

                <li>
                    <a href="{{ url('/reAnalisa') }}" class="nav-link">
                        Hasil Analisa
                    </a>
                </li>

            </ul>

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

            <button class="hero-btn">
                Mulai Test
            </button>

        </div>

    </section>

    {{-- ================= FITUR ================= --}}
    <section class="fitur" id="fitur">

        <div class="container">

            <h2 class="section-title">
                AKSES FITUR SISTEM REKOMENDASI
            </h2>

            <div class="swiper fiturSwiper">

                <div class="swiper-wrapper">

                    {{-- CARD 1 --}}
                    <div class="swiper-slide">

                        <div class="fitur-card">

                            <i class="fa-solid fa-stopwatch"></i>

                            <h3>Teknik Belajar</h3>

                            <p>
                                Teknik Belajar yang cocok
                                sesuai kondisi dari siswa
                            </p>

                        </div>

                    </div>

                    {{-- CARD 2 --}}
                    <div class="swiper-slide">

                        <div class="fitur-card">

                            <i class="fa-regular fa-face-smile"></i>

                            <h3>Hasil Resiko Akademik</h3>

                            <p>
                                Meningkatkan kebiasaan akademik
                                dari kebiasaan akademik yang beresiko
                            </p>

                        </div>

                    </div>

                    {{-- CARD 3 --}}
                    <div class="swiper-slide">

                        <div class="fitur-card">

                            <i class="fa-solid fa-chart-column"></i>

                            <h3>Riwayat</h3>

                            <p>
                                Riwayat untuk mengetahui
                                hasil tes dari terakhir
                            </p>

                        </div>

                    </div>

                    {{-- CARD 4 --}}
                    <div class="swiper-slide">

                        <div class="fitur-card">

                            <i class="fa-solid fa-book"></i>

                            <h3>Evaluasi Belajar</h3>

                            <p>
                                Evaluasi pembelajaran siswa
                                berdasarkan kebiasaan belajar
                            </p>

                        </div>

                    </div>

                </div>

                <div class="swiper-pagination"></div>

            </div>

        </div>

    </section>

    {{-- ================= TUJUAN ================= --}}
    <section class="tujuan">

        <div class="container">

            <div class="tujuan-box">

                <div class="tujuan-title">
                    TUJUAN
                </div>

                <div class="tujuan-item">

                    <div class="tujuan-icon">
                        <i class="fa-solid fa-brain"></i>
                    </div>

                    <p>
                        Mengetahui cara belajar sesuai dengan kondisi dan kebiasaan
                        dari siswa untuk meningkatkan performa akademik
                    </p>

                </div>

                <div class="tujuan-item">

                    <div class="tujuan-icon">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>

                    <p>
                        Meningkatkan kebiasaan siswa dari resiko kebiasaan
                        yang dilakukan untuk mengurangi resiko akademik lainnya
                    </p>

                </div>

                <div class="tujuan-item">

                    <div class="tujuan-icon">
                        <i class="fa-solid fa-user-gear"></i>
                    </div>

                    <p>
                        Meningkatkan produktivitas pada siswa untuk termotivasi
                        belajar dalam meningkatkan akademik
                    </p>

                </div>

                <div class="tujuan-item">

                    <div class="tujuan-icon">
                        <i class="fa-solid fa-book"></i>
                    </div>

                    <p>
                        Mengetahui Teknik belajar yang cocok
                        untuk dilakukan evaluasi pembelajaran
                    </p>

                </div>

            </div>

        </div>

    </section>

    {{-- ================= FAQ ================= --}}
    <section class="faq" id="faq">

        <div class="container">

            <h2>Frequently Asked Questions</h2>

            <div class="faq-wrapper">

                <div class="faq-item active">

                    <div class="faq-question">
                        <span>1. Apa itu EduTrace?</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>

                    <div class="faq-answer">
                        Akreditasi program studi adalah proses penilaian terhadap mutu
                        dan kelayakan suatu program studi oleh lembaga yang berwenang.
                    </div>

                </div>

                <div class="faq-item">

                    <div class="faq-question">
                        <span>2. Bagaimana Jika lupa Password?</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>

                    <div class="faq-answer">
                        Anda dapat melakukan reset password melalui halaman login.
                    </div>

                </div>

                <div class="faq-item">

                    <div class="faq-question">
                        <span>3. Apakah hasil akan valid dan terjamin?</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>

                    <div class="faq-answer">
                        Sistem menggunakan analisis AI untuk rekomendasi terbaik.
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

                        <h2>
                            edu<span>Trace</span>
                        </h2>

                    </div>

                    <p>
                        Revolusi digital dalam pengelolaan kebiasaan belajar siswa
                        dengan rekomendasi untuk masa depan pendidikan tinggi.
                    </p>

                </div>

                <div class="footer-contact">

                    <h3>Informasi Kami</h3>

                    <p>
                        <i class="fa-solid fa-envelope"></i>
                        EduTech@instansia.ac.id
                    </p>

                    <p>
                        <i class="fa-solid fa-globe"></i>
                        www.EduTecha.ac.id
                    </p>

                </div>

                <div class="footer-social">

                    <p>
                        <i class="fa-brands fa-facebook-f"></i>
                        Facebook
                    </p>

                    <p>
                        <i class="fa-brands fa-instagram"></i>
                        Instagram
                    </p>

                    <p>
                        <i class="fa-brands fa-youtube"></i>
                        Youtube
                    </p>

                </div>

            </div>

            <div class="footer-bottom">
                © 2026 EduTech - Sistem Kebiasaan Belajar. All rights reserved.
            </div>

        </div>

    </footer>

    {{-- SWIPER --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>

        // ================= SWIPER =================

        var swiper = new Swiper(".fiturSwiper", {

            loop:true,
            centeredSlides:true,
            grabCursor:true,

            speed:900,

            autoplay:{
                delay:2500,
                disableOnInteraction:false,
            },

            pagination:{
                el:".swiper-pagination",
                clickable:true,
            },

            breakpoints:{

                0:{
                    slidesPerView:1,
                    spaceBetween:20,
                },

                768:{
                    slidesPerView:2,
                    spaceBetween:25,
                },

                1024:{
                    slidesPerView:3,
                    spaceBetween:35,
                }
            }
        });

        // ================= FAQ =================

        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {

            const question = item.querySelector('.faq-question');

            question.addEventListener('click', () => {

                faqItems.forEach(faq => {

                    if(faq !== item){
                        faq.classList.remove('active');
                    }

                });

                item.classList.toggle('active');

            });

        });

        // ================= ACTIVE NAVBAR =================

        const navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(link => {

            link.addEventListener('click', function(){

                navLinks.forEach(nav => {
                    nav.classList.remove('active');
                });

                this.classList.add('active');

            });

        });

    </script>

</body>
</html>