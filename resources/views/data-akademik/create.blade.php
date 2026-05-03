@extends('layouts.app')

@section('title', 'Input Data Akademik')
@section('header-title', 'Input Data')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-8">
    <h3 class="text-xl font-semibold text-primary mb-8">Input Data sesuai dengan kondisi</h3>

    <form action="{{ route('data-akademik.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
            <!-- Jam Belajar -->
            <div>
                <label for="jam_belajar" class="block text-sm font-medium text-gray-700 mb-2">Jam Belajar</label>
                <input type="number" name="jam_belajar" id="jam_belajar" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition"
                    placeholder="Masukkan jam belajar per hari">
                @error('jam_belajar')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gangguan Belajar -->
            <div>
                <label for="gangguan_belajar" class="block text-sm font-medium text-gray-700 mb-2">Gangguan Belajar</label>
                <div class="relative">
                    <select name="gangguan_belajar" id="gangguan_belajar" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition appearance-none bg-white">
                        <option value="">Pilih tingkat gangguan</option>
                        <option value="Rendah">Rendah</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Tinggi">Tinggi</option>
                    </select>
                    <svg class="w-5 h-5 text-gray-400 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
                @error('gangguan_belajar')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jam Tidur -->
            <div>
                <label for="jam_tidur" class="block text-sm font-medium text-gray-700 mb-2">Jam Tidur</label>
                <input type="number" name="jam_tidur" id="jam_tidur" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition"
                    placeholder="Masukkan jam tidur per hari">
                @error('jam_tidur')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Keterlibatan Orang Tua -->
            <div>
                <label for="keterlibatan_orang_tua" class="block text-sm font-medium text-gray-700 mb-2">Keterlibatan Orang Tua</label>
                <div class="relative">
                    <select name="keterlibatan_orang_tua" id="keterlibatan_orang_tua" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition appearance-none bg-white">
                        <option value="">Pilih tingkat keterlibatan</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                        <option value="Kurang Aktif">Kurang Aktif</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Sangat Aktif">Sangat Aktif</option>
                    </select>
                    <svg class="w-5 h-5 text-gray-400 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
                @error('keterlibatan_orang_tua')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Motivasi Belajar -->
            <div>
                <label for="motivasi_belajar" class="block text-sm font-medium text-gray-700 mb-2">Motivasi Belajar</label>
                <div class="relative">
                    <select name="motivasi_belajar" id="motivasi_belajar" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition appearance-none bg-white">
                        <option value="">Pilih tingkat motivasi</option>
                        <option value="Rendah">Rendah</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Tinggi">Tinggi</option>
                    </select>
                    <svg class="w-5 h-5 text-gray-400 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
                @error('motivasi_belajar')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Akses Pembelajaran -->
            <div>
                <label for="akses_pembelajaran" class="block text-sm font-medium text-gray-700 mb-2">Akses Pembelajaran</label>
                <div class="relative">
                    <select name="akses_pembelajaran" id="akses_pembelajaran" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition appearance-none bg-white">
                        <option value="">Pilih kualitas akses</option>
                        <option value="Buruk">Buruk</option>
                        <option value="Cukup">Cukup</option>
                        <option value="Baik">Baik</option>
                        <option value="Sangat Baik">Sangat Baik</option>
                    </select>
                    <svg class="w-5 h-5 text-gray-400 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
                @error('akses_pembelajaran')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nilai Ujian Terakhir -->
            <div>
                <label for="nilai_ujian_terakhir" class="block text-sm font-medium text-gray-700 mb-2">Nilai Ujian Terakhir</label>
                <input type="number" name="nilai_ujian_terakhir" id="nilai_ujian_terakhir" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition"
                    placeholder="Masukkan nilai (0-100)" min="0" max="100">
                @error('nilai_ujian_terakhir')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kelas Tambahan -->
            <div>
                <label for="kelas_tambahan" class="block text-sm font-medium text-gray-700 mb-2">Kelas Tambahan</label>
                <input type="text" name="kelas_tambahan" id="kelas_tambahan" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition"
                    placeholder="Masukkan kelas tambahan">
                @error('kelas_tambahan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-4 mt-10">
            <a href="{{ route('data-akademik.index') }}" 
                class="px-8 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">
                Batal
            </a>
            <button type="submit" 
                class="px-8 py-2.5 bg-primary text-white rounded-lg hover:bg-secondary transition font-medium">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
