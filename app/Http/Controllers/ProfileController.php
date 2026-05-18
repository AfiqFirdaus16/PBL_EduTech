<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::with('siswa')
            ->where('user_id', Auth::id())
            ->first();
        return view('profile.index', compact('user'));
    }

    public function edit()
    {
        $user = User::with('siswa')
            ->where('user_id', Auth::id())
            ->first();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'jenjang' => 'required|string',
            'tingkat' => 'required|string',
        ]);

        $user = User::with('siswa')
            ->where('user_id', Auth::id())
            ->first();

        // update user
        $user->update([
            'nama' => $request->nama,
        ]);

        // update siswa
        if ($user->siswa) {

            $user->siswa->update([
                'tgl_lahir' => $request->tgl_lahir,
                'jenjang' => $request->jenjang,
                'tingkat' => $request->tingkat,
            ]);
        }

        return redirect()
            ->route('profile')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}