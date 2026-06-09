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
        <input
            type="password"
            name="password"
            required
        >
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

@endsection