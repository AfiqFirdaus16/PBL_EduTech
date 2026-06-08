@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <form method="POST" action="{{ route('register.process') }}">
        @csrf

        @if (session('success'))
            <div
                style="color: green; background: #e6ffe6; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 13px;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div
                style="color: red; background: #ffe6e6; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 13px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama lengkap" required>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
        </div>

        <div class="form-group">
            <label>Jenjang</label>
            <select name="jenjang" required>
                <option value="">Pilih Jenjang</option>
                <option value="SMP" {{ old('jenjang') == 'SMP' ? 'selected' : '' }}>SMP</option>
                <option value="SMA" {{ old('jenjang') == 'SMA' ? 'selected' : '' }}>SMA</option>
            </select>
        </div>

        <div class="form-group">
            <label>Tingkat</label>
            <select name="tingkat" required>
                <option value="">Pilih Tingkat</option>
                <option value="1" {{ old('tingkat') == '1' ? 'selected' : '' }}>1</option>
                <option value="2" {{ old('tingkat') == '2' ? 'selected' : '' }}>2</option>
                <option value="3" {{ old('tingkat') == '3' ? 'selected' : '' }}>3</option>
            </select>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Minimal 6 Karakter" required>
        </div>

        <button type="submit" class="btn">Daftar</button>

        <div class="link">
            Sudah punya akun?
            <a href="{{ route('login') }}">Login</a>
        </div>
    </form>
@endsection
