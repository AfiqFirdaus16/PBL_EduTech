<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DataPenggunaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::with('user');

        if ($request->filled('jenjang')) {
            $query->where('jenjang', $request->jenjang);
        }

        if ($request->filled('tingkat')) {
            $query->where('tingkat', $request->tingkat);
        }

        $siswas = $query->latest()->paginate(10);

        return view('admin.data-pengguna', compact('siswas'));
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->user->delete(); // cascade delete siswa juga
        return back()->with('success', 'Data pengguna berhasil dihapus.');
    }

    public function export()
        {
            $siswas = Siswa::with('user')->get();

            $csvData = "No,Nama,Username,Email,Tgl Lahir,Jenjang,Tingkat\n";

            foreach ($siswas as $index => $siswa) {
                $csvData .= implode(',', [
                    $index + 1,
                    $siswa->nama,
                    $siswa->user->username,
                    $siswa->user->email ?? '-',
                    $siswa->tgl_lahir ?? '-',
                    $siswa->jenjang,
                    $siswa->tingkat,
                ]) . "\n";
            }

            return response($csvData, 200, [
                'Content-Type'        => 'text/csv',
                'Content-Disposition' => 'attachment; filename="data-pengguna.csv"',
            ]);
        }
}