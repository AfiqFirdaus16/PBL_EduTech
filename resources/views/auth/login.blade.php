@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<form method="POST" action="{{ route('login.process') }}">
    @csrf

    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" required>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" required>
    </div>

    <div class="form-group" style="display:flex; align-items:center; justify-content:space-between; font-size:12px;">
        <label style="display:inline-flex; align-items:center; gap:6px; margin:0; font-weight:normal;">
            <input type="checkbox" style="margin:0; width:14px; height:14px; flex-shrink:0;"> 
            Ingatkan saya
        </label>
        <a href="{{ route('password.request') }}">Lupa Password?</a>
    </div>

    <button type="submit" class="btn">Masuk</button>

    <div class="link">
        Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
    </div>

</form>

@endsection