@extends('layouts.auth')

@section('title', 'Lengkapi Pendaftaran')

@section('content')
    <form method="POST" action="{{ route('register.lanjutan.simpan') }}">
        @csrf

        <div style="text-align: center; margin-bottom: 20px;">
            {{-- Jika nama ada, sapa namanya. Jika kosong, sapa selamat datang --}}
            @if (session('siakad_nama'))
                <h3 style="color: #3C3489; font-weight: 800;">Halo, {{ session('siakad_nama') }}!</h3>
            @else
                <h3 style="color: #3C3489; font-weight: 800;">Halo, Selamat Datang!</h3>
            @endif

            <p style="font-size: 13px; color: #666; line-height: 1.6; margin-top: 5px;">
                NISN Anda telah terverifikasi. Silakan lengkapi data di bawah ini untuk mengaktifkan akun EduTrace Anda.
            </p>
        </div>

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

        {{-- TAMBAHAN: Kolom Nama Lengkap --}}
        <div class="form-group">
            <label>Nama Lengkap</label>
            {{-- Value otomatis terisi dari session SIAKAD jika ada --}}
            <input type="text" name="nama" value="{{ old('nama', session('siakad_nama')) }}"
                placeholder="Masukkan nama lengkap Anda" required>
        </div>

        <div class="form-group">
            <label>Email Asli Anda</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Contoh: budi@gmail.com" required>
        </div>

        <div class="form-group">
            <label>Jenjang Saat Ini</label>
            <select name="jenjang" required>
                <option value="">Pilih Jenjang</option>
                <option value="SMP" {{ old('jenjang') == 'SMP' ? 'selected' : '' }}>SMP</option>
                <option value="SMA" {{ old('jenjang') == 'SMA' ? 'selected' : '' }}>SMA</option>
            </select>
        </div>

        <div class="form-group">
            <label>Tingkat (Kelas)</label>
            <select name="tingkat" required>
                <option value="">Pilih Tingkat</option>
                <option value="1" {{ old('tingkat') == '1' ? 'selected' : '' }}>1 (Kelas 7 SMP / 10 SMA)</option>
                <option value="2" {{ old('tingkat') == '2' ? 'selected' : '' }}>2 (Kelas 8 SMP / 11 SMA)</option>
                <option value="3" {{ old('tingkat') == '3' ? 'selected' : '' }}>3 (Kelas 9 SMP / 12 SMA)</option>
            </select>
        </div>

        <div class="form-group">
            <label>Buat Password EduTrace</label>
            <div style="position: relative;">
                <input
                    type="password"
                    name="password"
                    id="passwordInput"
                    placeholder="Minimal 6 karakter"
                    required
                    style="padding-right: 40px; width: 100%;"
                >
                <span
                    onclick="togglePass()"
                    style="position: absolute; right: 12px; top: 30%; transform: translateY(0%); cursor: pointer; color: #888;"
                >
                    <i class="fa-solid fa-eye" id="eyeIcon"></i>
                </span>
            </div>
            <small style="color: #888; font-size: 11px;">Ini akan menjadi password permanen Anda untuk login ke EduTrace selanjutnya.</small>
        </div>

        <button type="submit" class="btn">Simpan & Mulai Tes</button>

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
