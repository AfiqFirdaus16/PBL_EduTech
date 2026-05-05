<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataSiswa;

class DataAkademikController extends Controller
{
 
    public function store(Request $request)
    {
        $request->validate([
            'jam_belajar' => 'required|integer|min:0|max:24',
            'jam_tidur' => 'required|integer|min:0|max:24',
            'nilai_ujian' => 'required|numeric|min:0|max:100',
            'kelas_tambahan' => 'required|integer|min:0|max:10',
        ], [
            'jam_belajar.max' => 'Jam belajar maksimal 24 jam',
            'jam_tidur.max' => 'Jam tidur maksimal 24 jam',
            'nilai_ujian.max' => 'Nilai maksimal 100',
            'kelas_tambahan.max' => 'Kelas tambahan maksimal 10',
        ]);

        // ambil siswa dari user login
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            return back()->with('error', 'Data siswa tidak ditemukan');
        }

        DataSiswa::create([
            'siswa_id' => $siswa->siswa_id,
            'jam_belajar' => $request->jam_belajar,
            'jam_tidur' => $request->jam_tidur,
            'motivasi' => $request->motivasi,
            'nilai_ujian' => $request->nilai_ujian,
            'gangguan_belajar' => $request->gangguan_belajar,
            'keterlibatan_ortu' => $request->keterlibatan_ortu,
            'akses_pembelajaran' => $request->akses_pembelajaran,
            'kelas_tambahan' => $request->kelas_tambahan,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * FORM EDIT
     */
    public function edit($id)
    {
        $data = DataSiswa::findOrFail($id);

        // OPTIONAL SECURITY: pastikan hanya pemilik data
        if ($data->siswa_id !== Auth::user()->siswa->siswa_id) {
            abort(403, 'Tidak punya akses');
        }

        return view('data-akademik.edit', compact('data'));
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jam_belajar' => 'required|integer|min:0|max:24',
            'jam_tidur' => 'required|integer|min:0|max:24',
            'motivasi' => 'required|in:rendah,sedang,tinggi',
            'nilai_ujian' => 'required|numeric|min:0|max:100',
            'gangguan_belajar' => 'required|in:ya,tidak',
            'keterlibatan_ortu' => 'required|in:rendah,sedang,tinggi',
            'akses_pembelajaran' => 'required|in:baik,cukup,kurang',
            'kelas_tambahan' => 'required|integer|min:0',
        ]);

        $data = DataSiswa::findOrFail($id);

        // OPTIONAL SECURITY
        if ($data->siswa_id !== Auth::user()->siswa->siswa_id) {
            abort(403, 'Tidak punya akses');
        }

        $data->update([
            'jam_belajar' => $request->jam_belajar,
            'jam_tidur' => $request->jam_tidur,
            'motivasi' => $request->motivasi,
            'nilai_ujian' => $request->nilai_ujian,
            'gangguan_belajar' => $request->gangguan_belajar,
            'keterlibatan_ortu' => $request->keterlibatan_ortu,
            'akses_pembelajaran' => $request->akses_pembelajaran,
            'kelas_tambahan' => $request->kelas_tambahan,
        ]);

        return redirect()
            ->route('data-akademik.edit', $id)
            ->with('success', 'Data berhasil diperbarui');
    }
}