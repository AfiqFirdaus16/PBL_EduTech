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
            'username' => 'required',
            'password' => 'required'
        ]);

        // 1. SKENARIO LOKAL: Cari user berdasarkan username, lalu cek password
        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return $this->cekStatusKuis();
        }

        // 2. SKENARIO SIAKAD: Jika di EduTrace gagal, cek ke SIAKAD
        try {
            $response = Http::post('https://siakad-production-523b.up.railway.app/api/verify-nisn', [
                'nisn'     => $request->username,
                'password' => $request->password
            ]);

            if ($response->successful() && $response->json('status') === 'success') {
                $dataSiakad = $response->json('data');

                // Cek apakah NISN ini sudah pernah melakukan Register Lanjutan
                $userSudahAda = User::where('username', $dataSiakad['nisn'])->first();

                if ($userSudahAda) {
                    return back()->with('error', 'Akun Anda sudah terdaftar di EduTrace. Silakan login menggunakan Password EduTrace yang telah Anda buat.');
                }

                // Jika benar-benar baru, simpan ke Session
                session([
                    'siakad_nisn' => $dataSiakad['nisn'],
                    'siakad_nama' => $dataSiakad['name']
                ]);

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
        if (!session()->has('siakad_nisn')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('auth.register-lanjutan');
    }

    public function simpanRegisterLanjutan(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'jenjang'  => 'required|in:SMP,SMA',
            'tingkat'  => 'required|in:1,2,3'
        ]);

        $nisn = session('siakad_nisn');

        $user = User::create([
            'username' => $nisn,
            'nisn'     => $nisn,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'siswa'
        ]);

        Siswa::create([
            'user_id' => $user->id,
            'nisn'    => $nisn,
            'nama'    => $request->nama,
            'jenjang' => $request->jenjang,
            'tingkat' => $request->tingkat
        ]);

        session()->forget(['siakad_nisn', 'siakad_nama']);

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

        if (!$siswaId) {
            return redirect()->route('kuis.show', 1);
        }

        $sudahSelesaiKuis = DB::table('hasil_analisa')
            ->join('sesi_kuis', 'hasil_analisa.sesi_id', '=', 'sesi_kuis.id')
            ->where('sesi_kuis.siswa_id', $siswaId)
            ->exists();

        if ($sudahSelesaiKuis) {
            return redirect()->route('kuis.hasil')->with('success', 'Selamat datang kembali!');
        }

        return redirect()->route('kuis.show', 1)->with('info', 'Silakan selesaikan kuis ini.');
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