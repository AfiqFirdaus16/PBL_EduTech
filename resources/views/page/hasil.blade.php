{{-- resources/views/hasil.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTrace - Hasil Analisa</title>

    {{-- GOOGLE FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- FONT AWESOME --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

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

        /* ================= RESPONSIVE ================= */

        @media(max-width:768px){
            .profile-info{ display:none; }
            .profile-trigger .fa-chevron-down{ display:none; }
        }

    </style>
</head>
<body>

    {{-- ================= NAVBAR (hanya untuk user yang sudah login) ================= --}}
    @auth
    <nav class="navbar">

        <div class="container nav-wrapper">

            <div class="logo">
                <img src="{{ asset('images/edutrace.png') }}" alt="logo">
            </div>

            <ul class="nav-menu">
                <li><a href="{{ url('/#beranda') }}" class="nav-link">Beranda</a></li>
                <li><a href="{{ url('/#fitur') }}" class="nav-link">Fitur</a></li>
                <li><a href="{{ url('/#faq') }}" class="nav-link">FAQ</a></li>
                <li><a href="{{ route('hasil') }}" class="nav-link active">Hasil Analisa</a></li>
            </ul>

            <div class="nav-auth">
                <div class="profile-trigger" id="profileTrigger">

                    <div class="profile-avatar">
                        <i class="fa-solid fa-user"></i>
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

        </div>

    </nav>
    @endauth

    {{-- ================= KONTEN HALAMAN HASIL ================= --}}
    {{-- Tambahkan konten halaman hasil analisa di sini --}}

    <script>

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

    </script>

</body>
</html>