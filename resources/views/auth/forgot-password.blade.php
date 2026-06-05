@extends('layouts.auth')
@section('title', 'Lupa Password')
@section('content')

@if(session('success'))
    <div style="color: green; margin-bottom: 12px; text-align: center;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="color: red; margin-bottom: 12px; text-align: center;">
        {{ session('error') }}
    </div>
@endif

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