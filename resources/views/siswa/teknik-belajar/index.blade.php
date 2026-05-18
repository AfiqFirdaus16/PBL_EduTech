@extends('layouts.app-siswa')

@section('page-title', 'Teknik Belajar')

@section('content')

<div class="space-y-6">

    <!-- TITLE -->
    <h1 class="text-[28px] font-bold text-primary">
        Urutan Teknik yang Paling Cocok Untukmu!
    </h1>

    <!-- CARD TEKNIK -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- CARD 1 -->
        <div class="bg-[#BDB2EA] rounded-[22px] p-4 relative shadow-sm">

            <!-- NUMBER -->
            <div class="absolute top-3 left-3 w-9 h-9 rounded-full bg-[#F5B544] flex items-center justify-center font-bold text-primary">
                1
            </div>

            <!-- IMAGE -->
            <div class="mt-10 rounded-xl overflow-hidden">
                <img
                    src="https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=1200&auto=format&fit=crop"
                    alt="Pomodoro"
                    class="w-full h-40 object-cover rounded-xl">
            </div>

            <!-- TITLE -->
            <h2 class="mt-4 text-center text-[20px] font-bold text-primary underline">
                Pomodoro
            </h2>
        </div>

        <!-- CARD 2 -->
        <div class="bg-[#7E6ED3] rounded-[22px] p-4 relative shadow-sm">

            <!-- NUMBER -->
            <div class="absolute top-3 left-3 w-9 h-9 rounded-full bg-[#F5B544] flex items-center justify-center font-bold text-primary">
                2
            </div>

            <!-- IMAGE -->
            <div class="mt-10 rounded-xl overflow-hidden">
                <img
                    src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=1200&auto=format&fit=crop"
                    alt="Feynman"
                    class="w-full h-40 object-cover rounded-xl">
            </div>

            <!-- TITLE -->
            <h2 class="mt-4 text-center text-[20px] font-bold text-white underline">
                Feynman
            </h2>
        </div>

        <!-- CARD 3 -->
        <div class="bg-[#7E6ED3] rounded-[22px] p-4 relative shadow-sm">

            <!-- NUMBER -->
            <div class="absolute top-3 left-3 w-9 h-9 rounded-full bg-[#F5B544] flex items-center justify-center font-bold text-primary">
                3
            </div>

            <!-- IMAGE -->
            <div class="mt-10 rounded-xl overflow-hidden">
                <img
                    src="https://images.unsplash.com/photo-1513258496099-48168024aec0?q=80&w=1200&auto=format&fit=crop"
                    alt="Active Recall"
                    class="w-full h-40 object-cover rounded-xl">
            </div>

            <!-- TITLE -->
            <h2 class="mt-4 text-center text-[20px] font-bold text-white underline">
                Active Recall
            </h2>
        </div>

    </div>

    <!-- DETAIL -->
    <div class="bg-[#F5F0E3] rounded-[22px] p-6 shadow-sm">

        <!-- TITLE -->
        <h2 class="text-[28px] font-bold text-primary mb-4">
            Pomodoro
        </h2>

        <!-- PENGERTIAN -->
        <div class="bg-[#F0DFC2] rounded-2xl p-4 mb-4">
            <h3 class="font-bold text-primary mb-2">
                Pengertian
            </h3>

            <p class="text-[14px] text-gray-700 leading-relaxed">
                Teknik Pomodoro adalah metode belajar atau bekerja dengan membagi waktu menjadi sesi fokus singkat yang diselingi istirahat.
            </p>
        </div>

        <!-- CARA -->
        <div class="bg-[#F0DFC2] rounded-2xl p-4 mb-4">

            <h3 class="font-bold text-primary mb-2">
                Cara
            </h3>

            <ul class="list-disc pl-5 text-[14px] text-gray-700 space-y-1">
                <li>Belajar 25 menit (fokus penuh)</li>
                <li>Istirahat 5 menit</li>
                <li>Ulangi 4 kali, lalu istirahat lebih lama (15–30 menit)</li>
            </ul>
        </div>

        <!-- TUJUAN -->
        <div class="bg-[#F0DFC2] rounded-2xl p-4 mb-4">

            <h3 class="font-bold text-primary mb-2">
                Tujuan
            </h3>

            <p class="text-[14px] text-gray-700 leading-relaxed">
                Tujuannya supaya kamu tetap fokus, tidak cepat lelah, dan mengurangi kebiasaan menunda.
                Teknik ini cocok untuk kamu yang sering terdistraksi atau sulit belajar lama dalam satu waktu.
            </p>
        </div>

        <!-- REFERENSI -->
        <div class="bg-[#F0DFC2] rounded-2xl p-4">

            <h3 class="font-bold text-primary mb-2">
                Referensi Lainnya
            </h3>

            <div class="space-y-1 text-[14px]">

                <a href="#"
                    class="block text-blue-600 hover:underline">
                    https://youtube.com/shorts/example1
                </a>

                <a href="#"
                    class="block text-blue-600 hover:underline">
                    https://youtube.com/shorts/example2
                </a>

            </div>
        </div>

    </div>

</div>

@endsection