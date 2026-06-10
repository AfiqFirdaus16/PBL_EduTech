@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<form method="POST" action="{{ route('login.process') }}">
    @csrf

    <div class="form-group">
        <label>Username</label>
        <input
            type="text"
            name="username"
            value="{{ old('username') }}"
            required
        >
    </div>

    <div class="form-group">
        <label>Password</label>
        <div style="position: relative;">
            <input
                type="password"
                name="password"
                id="passwordInput"
                required
                style="padding-right: 40px; width: 100%;"
            >
            <span
                id="togglePassword"
                onclick="togglePass()"
                style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #888;"
            >
                <i class="fa-solid fa-eye" id="eyeIcon"></i>
            </span>
        </div>
    </div>

    <div style="display:flex; align-items:center; justify-content:space-between; font-size:12px; flex-wrap:nowrap; margin-bottom:16px;">
        <label style="display:inline-flex; align-items:center; gap:6px; margin:0; font-weight:normal; white-space:nowrap; cursor:pointer;">
            <input type="checkbox" name="remember" style="width:14px; height:14px; flex-shrink:0; margin:0; display:inline-block; vertical-align:middle;">
            <span style="white-space:nowrap; vertical-align:middle;">Ingatkan saya</span>
        </label>

        <a href="{{ route('password.request') }}">
            Lupa Password?
        </a>
    </div>

    <button type="submit" class="btn">
        Masuk
    </button>

    {{-- <div class="link">
        Belum punya akun?
        <a href="{{ route('register') }}">
            Daftar
        </a>
    </div> --}}

</form>

<script>
    function togglePass() {
        const input = document.getElementById('passwordInput');
        const icon  = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>

@endsection