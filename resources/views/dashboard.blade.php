@extends('layouts.app-siswa')

@section('page-title', 'Dashboard')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-[#CFC7F3] rounded-[24px] p-6 border border-[#8B7FD8]">

        <h1 class="text-[28px] font-bold text-primary mb-6">
            Hasil Resiko Kebiasaan Belajar
        </h1>

        <!-- CARD -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">

            <!-- CARD ITEM -->
            <div class="bg-white rounded-2xl p-4 border border-[#D7D0F5]">
                <p class="text-xs font-semibold text-primary mb-3">
                    Jam Belajar
                </p>

                <div class="flex justify-center mb-3">
                    <div class="w-16 h-16 rounded-full border-4 border-primary flex items-center justify-center">
                        📚
                    </div>
                </div>

                <p class="text-xs text-red-500 font-semibold">High</p>

                <div class="w-full h-2 bg-gray-200 rounded-full mt-2">
                    <div class="w-[85%] h-2 bg-red-500 rounded-full"></div>
                </div>
            </div>

            <!-- CARD ITEM -->
            <div class="bg-white rounded-2xl p-4 border border-[#D7D0F5]">
                <p class="text-xs font-semibold text-primary mb-3">
                    Jam Tidur
                </p>

                <div class="flex justify-center mb-3">
                    <div class="w-16 h-16 rounded-full border-4 border-primary flex items-center justify-center">
                        😴
                    </div>
                </div>

                <p class="text-xs text-green-500 font-semibold">Low</p>

                <div class="w-full h-2 bg-gray-200 rounded-full mt-2">
                    <div class="w-[35%] h-2 bg-green-500 rounded-full"></div>
                </div>
            </div>

            <!-- CARD ITEM -->
            <div class="bg-white rounded-2xl p-4 border border-[#D7D0F5]">
                <p class="text-xs font-semibold text-primary mb-3">
                    Motivasi Belajar
                </p>

                <div class="flex justify-center mb-3">
                    <div class="w-16 h-16 rounded-full border-4 border-primary flex items-center justify-center">
                        💡
                    </div>
                </div>

                <p class="text-xs text-red-500 font-semibold">High</p>

                <div class="w-full h-2 bg-gray-200 rounded-full mt-2">
                    <div class="w-[90%] h-2 bg-red-500 rounded-full"></div>
                </div>
            </div>

            <!-- CARD ITEM -->
            <div class="bg-white rounded-2xl p-4 border border-[#D7D0F5]">
                <p class="text-xs font-semibold text-primary mb-3">
                    Gangguan Belajar
                </p>

                <div class="flex justify-center mb-3">
                    <div class="w-16 h-16 rounded-full border-4 border-primary flex items-center justify-center">
                        ⚠️
                    </div>
                </div>

                <p class="text-xs text-yellow-500 font-semibold">Medium</p>

                <div class="w-full h-2 bg-gray-200 rounded-full mt-2">
                    <div class="w-[55%] h-2 bg-yellow-500 rounded-full"></div>
                </div>
            </div>

            <!-- CARD ITEM -->
            <div class="bg-white rounded-2xl p-4 border border-[#D7D0F5]">
                <p class="text-xs font-semibold text-primary mb-3">
                    Belajar Tambahan
                </p>

                <div class="flex justify-center mb-3">
                    <div class="w-16 h-16 rounded-full border-4 border-primary flex items-center justify-center">
                        📝
                    </div>
                </div>

                <p class="text-xs text-green-500 font-semibold">Low</p>

                <div class="w-full h-2 bg-gray-200 rounded-full mt-2">
                    <div class="w-[30%] h-2 bg-green-500 rounded-full"></div>
                </div>
            </div>

            <!-- CARD ITEM -->
            <div class="bg-white rounded-2xl p-4 border border-[#D7D0F5]">
                <p class="text-xs font-semibold text-primary mb-3">
                    Akses Pembelajaran
                </p>

                <div class="flex justify-center mb-3">
                    <div class="w-16 h-16 rounded-full border-4 border-primary flex items-center justify-center">
                        📖
                    </div>
                </div>

                <p class="text-xs text-yellow-500 font-semibold">Medium</p>

                <div class="w-full h-2 bg-gray-200 rounded-full mt-2">
                    <div class="w-[60%] h-2 bg-yellow-500 rounded-full"></div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection