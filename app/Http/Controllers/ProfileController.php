<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'nama'       => 'required|string|max:255',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png,jfif|max:2048',
            'tgl_lahir'  => 'nullable|date',
            'jenjang'    => 'required|string',
            'tingkat'    => 'required|string',
        ]);

        $user = Auth::user();
        $user->load('siswa');

        if (!$user->siswa) {
            return back()->with('error', 'Data siswa tidak ditemukan.');
        }

        $data = [
            'nama'      => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'jenjang'   => $request->jenjang,
            'tingkat'   => $request->tingkat,
        ];

        // Upload foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if (
                $user->siswa->foto &&
                Storage::disk('public')->exists($user->siswa->foto)
            ) {
                Storage::disk('public')->delete($user->siswa->foto);
            }

            // Simpan foto baru
            $data['foto'] = $request->file('foto')
                ->store('foto-profil', 'public');
        }

        $user->siswa->update($data);

        return redirect()
            ->route('profile')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}