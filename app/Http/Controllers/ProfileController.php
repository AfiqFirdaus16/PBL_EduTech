<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->load('siswa');

        return view('profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        $user->load('siswa');

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'jenjang'   => 'required|in:SMP,SMA',
            'tingkat'   => 'required|in:1,2,3',
        ]);

        $user = Auth::user();
        $user->load('siswa');

        if ($user->siswa) {

            $user->siswa->update([
                'nama'      => $request->nama,
                'tgl_lahir' => $request->tgl_lahir,
                'jenjang'   => $request->jenjang,
                'tingkat'   => $request->tingkat,
            ]);

        } else {

            $user->siswa()->create([
                'nama'      => $request->nama,
                'tgl_lahir' => $request->tgl_lahir,
                'jenjang'   => $request->jenjang,
                'tingkat'   => $request->tingkat,
            ]);
        }

        return redirect()
            ->route('profile')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}