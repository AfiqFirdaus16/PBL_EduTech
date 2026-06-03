<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Siswa;

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
        $request->validate([
            'email' => 'required|email'
        ]);

        $token = Str::random(60);

        return redirect()->route('password.reset', $token);
    }
    
    // PROSES UPDATE PASSWORD
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login')
            ->with('success', 'Password berhasil diubah');
    }
    public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('welcome');
        }

}