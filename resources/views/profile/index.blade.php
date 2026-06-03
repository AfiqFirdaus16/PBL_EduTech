@extends('layouts.app-siswa')

@section('page-title', 'Profil Saya')

@section('content')

<div class="min-h-screen flex items-center justify-center px-4 py-10">

    <div class="max-w-5xl mx-auto">

        <div class="bg-white rounded-[28px] shadow-sm overflow-hidden border border-gray-200">

            <!-- HEADER -->
            <div class="h-24 bg-gradient-to-r from-orange-300 to-primary relative"></div>

            <!-- CONTENT -->
            <div class="px-8 pb-8 relative">

                <!-- PROFILE -->
                <div class="-mt-10 flex items-center gap-5">

                    <!-- FOTO -->
                    <div class="w-28 h-28 rounded-full border-4 border-white overflow-hidden shadow-md bg-gray-200">
                        <img
                            src="https://ui-avatars.com/api/?name={{ urlencode($user->siswa->nama ?? $user->username) }}"
                            alt="Profile"
                            class="w-full h-full object-cover">
                    </div>

                    <!-- NAMA -->
                    <div class="mt-8">
                        <div class="flex items-center gap-3">

                            <h2 class="text-2xl font-bold text-gray-900">
                                {{ $user->siswa->nama ?? '-' }}
                            </h2>

                            <span class="px-4 py-1 rounded-full bg-primary text-white text-sm font-semibold shadow">
                                {{ $user->siswa->jenjang ?? '-' }}
                            </span>

                        </div>
                    </div>
                </div>

                <!-- INFORMASI -->
                <div class="mt-10">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- NAMA -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                value="{{ $user->siswa->nama ?? '-' }}"
                                readonly
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-gray-100">
                        </div>

                        <!-- USERNAME -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Username
                            </label>

                            <input
                                type="text"
                                value="{{ $user->username }}"
                                readonly
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-gray-100">
                        </div>

                        <!-- EMAIL -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Email Aktif
                            </label>

                            <input
                                type="email"
                                value="{{ $user->email }}"
                                readonly
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-gray-100">
                        </div>

                        <!-- PASSWORD -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Password
                            </label>

                            <input
                                type="password"
                                value="password"
                                readonly
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-gray-100">
                        </div>

                        <!-- TGL LAHIR -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Lahir
                            </label>

                            <input
                                type="date"
                                value="{{ $user->siswa->tgl_lahir ?? '' }}"
                                readonly
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-gray-100">
                        </div>

                        <!-- JENJANG -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Jenjang
                            </label>

                            <input
                                type="text"
                                value="{{ $user->siswa->jenjang ?? '-' }}"
                                readonly
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-gray-100">
                        </div>

                        <!-- TINGKAT -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tingkat
                            </label>

                            <input
                                type="text"
                                value="{{ $user->siswa->tingkat ?? '-' }}"
                                readonly
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-gray-100">
                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="flex justify-end gap-3 mt-8">

                        <a href="{{ route('welcome') }}"
                            class="px-5 py-3 rounded-xl bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition">
                            Kembali
                        </a>

                        <a href="{{ route('profile.edit') }}"
                            class="px-5 py-3 rounded-xl bg-primary text-white font-semibold hover:bg-secondary transition inline-block">
                            Edit Profil
                        </a>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection