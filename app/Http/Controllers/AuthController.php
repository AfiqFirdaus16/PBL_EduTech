<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Siswa;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('kuis.show', 1);
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'jenjang' => 'required|in:SMP,SMA',
            'tingkat' => 'required|in:1,2,3'
        ]);

        $user = User::create([
        'nama' => $request->nama,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'siswa'
    ]);

        Siswa::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'jenjang' => $request->jenjang,
            'tingkat' => $request->tingkat
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Registrasi berhasil, silakan login');
    }

    // PROSES KIRIM LINK RESET PASSWORD (sementara dummy)
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', 'Link reset password sudah dikirim ke email kamu.');
        }

        return back()->with('error', 'Email tidak ditemukan.');
    }
    
    // PROSES UPDATE PASSWORD
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
    public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('welcome');
        }

}