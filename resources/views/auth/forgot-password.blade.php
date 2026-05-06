@extends('layouts.auth')

@section('title', 'Lupa Password')

@section('content')
<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="form-group">
        <input type="email" name="email" placeholder="Masukkan email" required>
    </div>

    <button class="btn">Kirim Link</button>

    <div class="link">
        <a href="{{ route('login') }}">Kembali ke login</a>
    </div>
</form>
@endsection