@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<form method="POST" action="{{ route('register.process') }}">
    @csrf

    <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" placeholder="Nama lengkap" required>
    </div>

    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" placeholder="Username" required>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" placeholder="Email" required>
    </div>

    <div class="form-group">
        <label>Jenjang</label>
        <select name="jenjang" required>
            <option value="">Pilih Jenjang</option>
            <option value="SMP">SMP</option>
            <option value="SMA">SMA</option>
        </select>
    </div>

    <div class="form-group">
        <label>Tingkat</label>
        <select name="tingkat" required>
            <option value="">Pilih Tingkat</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Password" required>
    </div>

    <button class="btn">Daftar</button>

    <div class="link">
        Sudah punya akun?
        <a href="{{ route('login') }}">Login</a>
    </div>
</form>
@endsection