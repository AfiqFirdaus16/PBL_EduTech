@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group">
        <input type="email" name="email" placeholder="Email" required>
    </div>

    <div class="form-group">
        <input type="password" name="password" placeholder="Password baru" required>
    </div>

    <button class="btn">Reset Password</button>
</form>
@endsection