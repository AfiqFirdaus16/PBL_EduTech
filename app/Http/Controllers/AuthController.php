<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Models\Siswa;

class AuthController extends Controller
{
    // =================================================================
    // PROSES LOGIN (LOKAL & CEK SIAKAD)
    // =================================================================
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required', // Bisa NISN atau Username
            'password' => 'required'
        ]);

        // 1. SKENARIO LOKAL: Coba login pakai database EduTrace
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return $this->cekStatusKuis();
        }

        // 2. SKENARIO SIAKAD: Jika di EduTrace belum ada, cek ke SIAKAD
        try {
            $response = Http::post('https://siakad-production-523b.up.railway.app/api/verify-nisn', [
                'nisn'     => $request->username,
                'password' => $request->password
            ]);

            if ($response->successful() && $response->json('status') === 'success') {
                $dataSiakad = $response->json('data');

                // Simpan data dari SIAKAD (NISN dan Nama) ke memori sementara (Session)
                session([
                    'siakad_nisn' => $dataSiakad['nisn'],
                    'siakad_nama' => $dataSiakad['name']
                ]);

                // Arahkan siswa ke form untuk melengkapi data & membuat password baru
                return redirect()->route('register.lanjutan');
            }
        } catch (\Exception $e) {
            // Abaikan jika error server
        }

        // 3. JIKA GAGAL SEMUA
        return back()->with('error', 'Username/NISN atau password salah.');
    }

    // =================================================================
    // PROSES REGISTER LANJUTAN (DARI SIAKAD -> EDUTRACE)
    // =================================================================
    public function registerLanjutan()
    {
        // Pastikan halaman ini hanya bisa dibuka jika ada data dari SIAKAD
        if (!session()->has('siakad_nisn')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('auth.register-lanjutan');
    }

    public function simpanRegisterLanjutan(Request $request)
    {
        // 1. Tambahkan validasi untuk 'nama'
        $request->validate([
            'nama'     => 'required|string|max:255', // <-- TAMBAHAN BARU
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'jenjang'  => 'required|in:SMP,SMA',
            'tingkat'  => 'required|in:1,2,3'
        ]);

        $nisn = session('siakad_nisn');

        // 2. Simpan akun resmi ke database EduTrace
        $user = User::create([
            'username' => $nisn,
            'nisn'    => $nisn,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'siswa'
        ]);

        // 3. Simpan biodata resmi ke tabel siswas
        Siswa::create([
            'user_id' => $user->id,
            'nisn'    => $nisn,
            'nama'    => $request->nama, // <-- SEKARANG MENGAMBIL DARI INPUTAN FORM, BUKAN DARI SESSION
            'jenjang' => $request->jenjang,
            'tingkat' => $request->tingkat
        ]);

        // Hapus session sementara
        session()->forget(['siakad_nisn', 'siakad_nama']);

        // Langsung loginkan dan arahkan ke kuis
        Auth::login($user);
        return redirect()->route('kuis.show', 1)->with('success', 'Akun berhasil dibuat! Silakan mulai tes.');
    }


    // =================================================================
    // PROSES REGISTER MANDIRI (Bukan dari SIAKAD)
    // =================================================================
    public function register(Request $request)
    {
        $request->validate([
            'nama'     => 'required',
            'username' => 'required|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'jenjang'  => 'required|in:SMP,SMA',
            'tingkat'  => 'required|in:1,2,3'
        ]);

        $user = User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'siswa'
        ]);

        Siswa::create([
            'user_id' => $user->id,
            'nama'    => $request->nama,
            'jenjang' => $request->jenjang,
            'tingkat' => $request->tingkat
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }


    // =================================================================
    // FUNGSI HELPER & LAINNYA
    // =================================================================
    private function cekStatusKuis()
    {
        $siswaId = Auth::user()->siswa->id ?? null;
        $sudahIsiKuis = $siswaId
            ? DB::table('sesi_kuis')->where('siswa_id', $siswaId)->exists()
            : false;

        if ($sudahIsiKuis) {
            return redirect()->route('hasil-resiko.index');
        }

        return redirect()->route('kuis.show', 1);
    }

    // =================================================================
    // FUNGSI LAINNYA (Logout & Reset Password)
    // =================================================================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', 'Link reset password sudah dikirim ke email kamu.');
        }
        return back()->with('error', 'Email tidak ditemukan.');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Password berhasil direset! Silakan login.');
        }
        return back()->with('error', 'Token tidak valid atau sudah expired.');
    }
}
