@extends('layouts.app-siswa')

@section('page-title', 'Edit Profil')

@section('content')

<div class="max-w-5xl mx-auto">

    <!-- CARD -->
    <div class="bg-white rounded-[28px] shadow-sm overflow-hidden border border-gray-200">

        <!-- HEADER -->
        <div class="h-24 bg-gradient-to-r from-orange-300 to-primary relative">
        </div>

        <!-- CONTENT -->
        <div class="px-8 pb-8 relative">

            <!-- PROFILE -->
            <div class="-mt-10 flex items-center gap-5">

                <!-- FOTO -->
                <div class="w-28 h-28 rounded-full border-4 border-white overflow-hidden shadow-md bg-gray-200">

                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}"
                        alt="Profile"
                        class="w-full h-full object-cover">
                </div>

                <!-- NAMA -->
                <div class="mt-8">

                    <div class="flex items-center gap-3">

                        <h2 class="text-2xl font-bold text-gray-900">
                            {{ $user->nama }}
                        </h2>

                        <!-- BADGE -->
                        <span class="px-4 py-1 rounded-full bg-primary text-white text-sm font-semibold shadow">
                            {{ $user->siswa->jenjang ?? '-' }}
                        </span>

                    </div>
                </div>
            </div>

            <!-- FORM -->
            <form action="{{ route('profile.update') }}" method="POST" class="mt-10">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- NAMA -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="nama"
                            value="{{ old('nama', $user->nama) }}"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>

                    <!-- USERNAME -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Username
                        </label>

                        <input
                            type="text"
                            value="{{ $user->username }}"
                            disabled
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-gray-100 text-gray-500 cursor-not-allowed">
                    </div>

                    <!-- EMAIL -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Email Aktif
                        </label>

                        <input
                            type="email"
                            value="{{ $user->email }}"
                            disabled
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-gray-100 text-gray-500 cursor-not-allowed">
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Password
                        </label>

                        <input
                            type="password"
                            value="password"
                            disabled
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-gray-100 text-gray-500 cursor-not-allowed">
                    </div>

                    <!-- TGL LAHIR -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Lahir
                        </label>

                        <input
                            type="date"
                            name="tgl_lahir"
                            value="{{ old('tgl_lahir', $user->siswa->tgl_lahir ?? '') }}"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>

                    <!-- JENJANG -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Jenjang
                        </label>

                        <select
                            name="jenjang"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-primary">

                            <option value="SD" {{ ($user->siswa->jenjang ?? '') == 'SD' ? 'selected' : '' }}>
                                SD
                            </option>

                            <option value="SMP" {{ ($user->siswa->jenjang ?? '') == 'SMP' ? 'selected' : '' }}>
                                SMP
                            </option>

                            <option value="SMA" {{ ($user->siswa->jenjang ?? '') == 'SMA' ? 'selected' : '' }}>
                                SMA
                            </option>

                        </select>
                    </div>

                    <!-- TINGKAT -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tingkat
                        </label>

                        <select
                            name="tingkat"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-primary">

                            <option value="1" {{ ($user->siswa->tingkat ?? '') == '1' ? 'selected' : '' }}>
                                1
                            </option>

                            <option value="2" {{ ($user->siswa->tingkat ?? '') == '2' ? 'selected' : '' }}>
                                2
                            </option>

                            <option value="3" {{ ($user->siswa->tingkat ?? '') == '3' ? 'selected' : '' }}>
                                3
                            </option>

                        </select>
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="flex justify-end gap-3 mt-8">

                    <a href="{{ route('profile') }}"
                        class="px-5 py-3 rounded-xl bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition">

                        Batal
                    </a>

                    <button
                        type="submit"
                        class="px-5 py-3 rounded-xl bg-primary text-white font-semibold hover:bg-secondary transition">

                        Simpan Perubahan
                    </button>

                </div>
            </form>

        </div>
    </div>
</div>

@endsection