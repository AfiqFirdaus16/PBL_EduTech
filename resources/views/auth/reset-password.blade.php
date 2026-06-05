@extends('layouts.auth')
@section('title', 'Reset Password')
@section('content')

@if(session('error'))
    <div style="color: red; margin-bottom: 12px; text-align: center;">
        {{ session('error') }}
    </div>
@endif

<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group">
        <input type="email" name="email" placeholder="Email" required>
    </div>
    <div class="form-group">
        <input type="password" name="password" placeholder="Password baru" required>
    </div>
    <div class="form-group">
        <input type="password" name="password_confirmation" placeholder="Konfirmasi password baru" required>
    </div>
    <button class="btn">Reset Password</button>
</form>
@endsection