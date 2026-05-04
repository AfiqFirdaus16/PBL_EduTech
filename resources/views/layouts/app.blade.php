<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTrace - @yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3D2C6B',
                        secondary: '#5B4A8A',
                        accent: '#F5A623',
                    }
                }
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body{
            font-family:'Inter',sans-serif;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-100 min-h-screen">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#ECEAF8] flex flex-col">

        <!-- LOGO -->
        <div class="p-6">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold">
                    <span class="text-primary">edu</span><span class="text-orange-400">Trace</span>
                </h1>
                <p class="text-[10px] text-gray-500 mt-1">
                    Transforming Learning Habits, Ensuring Success
                </p>
            </div>
        </div>

        <!-- MENU -->
        <nav class="px-4 pb-8 flex-1">

            <!-- HOME -->
            <div class="mb-7">
                <h3 class="font-bold text-black mb-3">Home</h3>

                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-full text-primary font-semibold hover:bg-white">
                    <span>⬛</span>
                    Dashboard
                </a>
            </div>

            <!-- DATA -->
            <div class="mb-7">
                <h3 class="font-bold text-black mb-3">Data</h3>

                <!-- FIXED ERROR HERE -->
                <a href="{{ route('data-akademik.index') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-full bg-primary text-white font-semibold">
                    <span>⬛</span>
                    Input Data Akademik
                </a>
            </div>

            <!-- REKOMENDASI -->
            <div class="mb-7">
                <h3 class="font-bold text-black mb-3">Rekomendasi</h3>

                <a href="#"
                   class="flex items-center gap-3 px-4 py-2 rounded-full text-primary font-semibold hover:bg-white mb-2">
                    <span>⬛</span>
                    Hasil Resiko Belajar
                </a>

                <a href="#"
                   class="flex items-center gap-3 px-4 py-2 rounded-full text-primary font-semibold hover:bg-white">
                    <span>⬛</span>
                    Teknik Belajar
                </a>
            </div>

            <!-- LAINNYA -->
            <div>
                <h3 class="font-bold text-black mb-3">Lainnya</h3>

                <a href="#"
                   class="flex items-center gap-3 px-4 py-2 rounded-full text-primary font-semibold hover:bg-white">
                    <span>⬛</span>
                    Riwayat
                </a>
            </div>

        </nav>
    </aside>


    <!-- CONTENT -->
    <main class="flex-1 flex flex-col">

        <!-- HEADER -->
        <header class="bg-primary text-white px-8 py-4 flex items-center justify-between">

            <h2 class="text-4xl font-bold">
                @yield('page-title','Input Data')
            </h2>

            <!-- SEARCH -->
            <div class="w-[430px] mx-8">
                <input type="text"
                       placeholder="Cari"
                       class="w-full px-5 py-3 rounded-full text-gray-700 outline-none">
            </div>

            <!-- USER -->
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-white"></div>

                <div class="leading-tight">
                    <p class="font-bold text-xl">Kartika Tri Juliana</p>
                    <p class="text-sm text-gray-200">Tingkat SMA</p>
                </div>

                <span>⌄</span>
            </div>

        </header>

        <!-- PAGE -->
        <section class="flex-1 p-8 bg-[#F4F4F4]">
            @yield('content')
        </section>

    </main>

</div>

@stack('scripts')
</body>
</html>