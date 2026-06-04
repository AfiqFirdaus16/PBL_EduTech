@extends('layouts.app-siswa')

@section('page-title', 'Edit Profile')

@section('content')

<div class="min-h-screen flex items-center justify-center px-4 py-10">
    <div class="max-w-5xl mx-auto">

        <div class="bg-white rounded-[28px] shadow-sm overflow-hidden border border-gray-200">

            <!-- HEADER -->
            <div class="h-24 bg-gradient-to-r from-orange-300 to-primary"></div>

            <div class="px-8 pb-8 relative">

                <!-- PROFILE -->
                <div class="-mt-14 flex flex-col items-center">

                    <!-- FOTO -->
                    <div class="flex flex-col items-center gap-3">

                            <div class="relative">

                                <img
                                    id="preview-foto"
                                    src="{{ $user->siswa && $user->siswa->foto
                                        ? asset('storage/' . $user->siswa->foto)
                                        : 'https://ui-avatars.com/api/?name=' . urlencode($user->siswa->nama ?? 'User') }}"
                                    alt="Profile"
                                    class="w-28 h-28 rounded-full border-4 border-white object-cover shadow-md cursor-pointer hover:opacity-90 transition"
                                    onclick="openPhotoMenu()">

                            </div>

                            <div class="text-center">
                                <h2 class="text-2xl font-bold text-gray-900">
                                    {{ $user->siswa->nama ?? '-' }}
                                </h2>

                                <span class="inline-block mt-2 px-4 py-1 rounded-full bg-primary text-white text-sm font-semibold shadow">
                                    {{ $user->siswa->jenjang ?? '-' }}
                                </span>
                            </div>

                        </div>
                    </div>


                <!-- FORM -->
                <form
                    action="{{ route('profile.update') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="mt-12">

                    @csrf
                    @method('PUT')

                    <input
                        type="file"
                        id="foto"
                        name="foto"
                        accept="image/*"
                        class="hidden">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- NAMA -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                name="nama"
                                value="{{ old('nama', $user->siswa->nama ?? '') }}"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-primary">

                            @error('nama')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
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
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-gray-100 text-gray-500">
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
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-gray-100 text-gray-500">
                        </div>

                        <!-- PASSWORD -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Password
                            </label>

                            <input
                                type="password"
                                value="********"
                                disabled
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-gray-100 text-gray-500">
                        </div>

                        <!-- TANGGAL LAHIR -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Lahir
                            </label>

                            <input
                                type="date"
                                name="tgl_lahir"
                                value="{{ old('tgl_lahir', $user->siswa->tgl_lahir ?? '') }}"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-primary">

                            @error('tgl_lahir')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- JENJANG -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Jenjang
                            </label>

                            <select
                                name="jenjang"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-primary">

                                <option value="SMP"
                                    {{ old('jenjang', $user->siswa->jenjang ?? '') == 'SMP' ? 'selected' : '' }}>
                                    SMP
                                </option>

                                <option value="SMA"
                                    {{ old('jenjang', $user->siswa->jenjang ?? '') == 'SMA' ? 'selected' : '' }}>
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

                                <option value="1"
                                    {{ old('tingkat', $user->siswa->tingkat ?? '') == '1' ? 'selected' : '' }}>
                                    1
                                </option>

                                <option value="2"
                                    {{ old('tingkat', $user->siswa->tingkat ?? '') == '2' ? 'selected' : '' }}>
                                    2
                                </option>

                                <option value="3"
                                    {{ old('tingkat', $user->siswa->tingkat ?? '') == '3' ? 'selected' : '' }}>
                                    3
                                </option>

                            </select>
                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="flex justify-end gap-3 mt-8">

                        <a
                            href="{{ route('profile') }}"
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
</div>

<!-- MENU FOTO -->
<div
    id="photoMenu"
    class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">

    <div class="bg-white rounded-2xl w-80 overflow-hidden shadow-xl">

        <button
            type="button"
            onclick="showPhotoPreview()"
            class="w-full py-4 border-b hover:bg-gray-50 font-medium">

            👀 Lihat Foto Profil
        </button>

        <button
            type="button"
            onclick="changePhoto()"
            class="w-full py-4 border-b hover:bg-gray-50 text-primary font-medium">

            📷 Ganti Foto
        </button>

        <button
            type="button"
            onclick="closePhotoMenu()"
            class="w-full py-4 hover:bg-gray-50 text-red-500">

            Batal
        </button>

    </div>

</div>

<!-- PREVIEW -->
<div
    id="previewModal"
    class="hidden fixed inset-0 bg-black/90 z-[60] flex items-center justify-center">

    <button
        type="button"
        onclick="closePreview()"
        class="absolute top-5 right-8 text-white text-4xl">

        ×
    </button>

    <img
        id="previewModalImage"
        src=""
        class="max-w-[90vw] max-h-[90vh] rounded-xl shadow-2xl">

</div>

<script>
function openPhotoMenu() {
    document.getElementById('photoMenu').classList.remove('hidden');
}

function closePhotoMenu() {
    document.getElementById('photoMenu').classList.add('hidden');
}

function showPhotoPreview() {
    document.getElementById('previewModalImage').src =
        document.getElementById('preview-foto').src;

    document.getElementById('previewModal').classList.remove('hidden');

    closePhotoMenu();
}

function closePreview() {
    document.getElementById('previewModal').classList.add('hidden');
}

function changePhoto() {
    closePhotoMenu();
    document.getElementById('foto').click();
}

document.getElementById('foto').addEventListener('change', function(e) {

    const file = e.target.files[0];

    if (!file) return;

    const reader = new FileReader();

    reader.onload = function(event) {
        document.getElementById('preview-foto').src = event.target.result;
    };

    reader.readAsDataURL(file);
});
</script>

@endsection