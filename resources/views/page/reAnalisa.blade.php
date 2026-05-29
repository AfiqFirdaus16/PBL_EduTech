@extends('layouts.app-siswa')

@section('title', 'Hasil Analisa')

@push('styles')
<style>

    :root{
        --primary:#3C3489;
        --secondary:#EF9F27;
        --soft:#EEEDFE;
        --white:#FFFFFF;
    }

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }

    body{
        font-family:'Poppins', sans-serif;
        background:var(--soft);
        overflow-x:hidden;
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
        height:82px;
        background:#FFFFFF;

        position:fixed;
        top:0;
        left:0;
        z-index:999;

        border-bottom:1px solid #ECECEC;

        display:flex;
        align-items:center;
    }

    .nav-container{
        width:92%;
        max-width:1300px;
        margin:auto;

        display:flex;
        align-items:center;
        justify-content:center;

        position:relative;
    }

    /* LOGO */

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

    /* MENU */

    .nav-menu{
        display:flex;
        align-items:center;
        gap:28px;
    }

    .nav-menu a{

        color:#6A6A6A;

        font-size:15px;
        font-weight:700;

        padding:12px 22px;

        border-radius:10px;

        transition:0.3s ease;
    }

    .nav-menu a:hover{
        color:var(--primary);
    }

    .nav-menu a.active{
        background:var(--secondary);
        color:#FFFFFF;
    }

    /* ================= PAGE ================= */

    .analisa-page{

        min-height:100vh;

        background:
        linear-gradient(
            180deg,
            #F2F1FA 0%,
            #EEEDFE 100%
        );

        padding:
        160px 20px
        80px;

        display:flex;
        justify-content:center;
        align-items:flex-start;
    }

    /* ================= CARD ================= */

    .analisa-card{

        width:100%;
        max-width:760px;

        background:
        linear-gradient(
            180deg,
            #F7DDB0 0%,
            #F5D8A1 100%
        );

        border:1.5px solid #E79A21;

        border-radius:14px;

        padding:
        65px 50px;

        text-align:center;

        box-shadow:
        0 12px 30px rgba(60,52,137,0.08);

    }

    /* ================= LOGO ================= */

    .analisa-logo{
        width:120px;
        margin-bottom:20px;
    }

    /* ================= TITLE ================= */

    .analisa-title{
        font-size:44px;
        font-weight:800;
        color:#000;
        margin-bottom:12px;
        line-height:1.2;
    }

    .analisa-subtitle{
        font-size:18px;
        color:#2E2E2E;
        margin-bottom:40px;
    }

    /* ================= BUTTON ================= */

    .btn-mulai{

        width:100%;
        max-width:370px;
        height:64px;

        border:none;
        border-radius:14px;

        background:#EFE5DC;

        color:var(--primary);

        font-size:20px;
        font-weight:800;

        cursor:pointer;

        transition:0.3s ease;

        box-shadow:
        0 6px 12px rgba(0,0,0,0.15);

    }

    .btn-mulai:hover{

        transform:
        translateY(-4px);

        background:#FFFFFF;

    }

    /* ================= RESPONSIVE ================= */

    @media(max-width:768px){

        .navbar{
            height:auto;
            padding:15px 0;
        }

        .nav-container{
            flex-direction:column;
            gap:18px;
        }

        .logo{
            position:relative;
        }

        .nav-menu{
            gap:10px;
            flex-wrap:wrap;
            justify-content:center;
        }

        .analisa-page{
            padding-top:180px;
        }

        .analisa-card{
            padding:45px 25px;
        }

        .analisa-logo{
            width:95px;
        }

        .analisa-title{
            font-size:32px;
        }

        .analisa-subtitle{
            font-size:15px;
            line-height:1.8;
        }

        .btn-mulai{
            height:58px;
            font-size:18px;
        }

    }

</style>
@endpush

@section('content')

{{-- ================= NAVBAR ================= --}}
<nav class="navbar">

    <div class="nav-container">

        {{-- LOGO --}}
        <div class="logo">

            <img
                src="{{ asset('images/edutrace.png') }}"
                alt="EduTrace"
            >

        </div>

        {{-- MENU --}}
        <ul class="nav-menu">

            <li>
                <a href="{{ url('/') }}">
                    Beranda
                </a>
            </li>

            <li>
                <a href="{{ url('/#fitur') }}">
                    Fitur
                </a>
            </li>

            <li>
                <a href="{{ url('/#faq') }}">
                    FAQ
                </a>
            </li>

            <li>
                <a href="{{ route('reAnalisa') }}" class="active">
                    Hasil Analisa
                </a>
            </li>

        </ul>

    </div>

</nav>

{{-- ================= CONTENT ================= --}}
<div class="analisa-page">

    <div class="analisa-card">

        {{-- LOGO --}}
        <img
            src="{{ asset('images/edutrace2.png') }}"
            alt="Logo"
            class="analisa-logo"
            style="display:block; margin:0 auto 20px;"
        >

        {{-- TITLE --}}
        <h1 class="analisa-title">
            Yuk mulai test!
        </h1>

        {{-- SUBTITLE --}}
        <p class="analisa-subtitle">
            Hasil akan muncul setelah kamu menyelesaikan test.
        </p>

        {{-- BUTTON --}}
        <a href="{{ route('login') }}">

            <button class="btn-mulai">
                Mulai Test
            </button>

        </a>

    </div>

</div>

@endsection