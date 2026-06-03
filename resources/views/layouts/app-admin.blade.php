@section('page-title', 'Dashboard')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTrace</title>

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
<aside class="w-[248px] bg-[#ECEAF8] min-h-screen border-r border-[#ddd8f3] flex flex-col">

    <!-- LOGO -->
    <div class="pt-4 pb-5 px-5 border-b border-[#ddd8f3]">
        <div class="flex flex-col items-center text-center">

            <!-- Icon Buku -->
           <img src="{{ asset('images/edutrace2.png') }}" alt="Logo" class="w-28 mb-2">

            <!-- Text Logo -->
            <h1 class="text-[38px] font-extrabold leading-none">
                <span class="text-primary">Edu</span><span class="text-[#F59E0B]">Trace</span>
            </h1>

            <p class="text-[9px] text-gray-500 leading-tight mt-1 max-w-[150px]">
                Transforming Learning Habits, Ensuring Success
            </p>
        </div>
    </div>

    <!-- MENU -->
    <nav class="px-4 py-5 flex-1 text-[14px]">

        <!-- HOME -->
        <div class="mb-6">
            <h3 class="font-bold text-black mb-2">Home</h3>

            <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-full font-semibold transition
            {{ request()->routeIs('admin.dashboard')
                    ? 'bg-primary text-white shadow-sm'
                    : 'text-primary hover:bg-white' }}">

                <!-- icon -->
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M7 2h6v6H7V2zM2 2h4v4H2V2zm12 0h4v4h-4V2zM2 8h4v4H2V8zm12 0h4v4h-4V8z"/>
                </svg>

                Dashboard
            </a>
        </div>

        <!-- DATA -->
        <div class="mb-6">
        <h3 class="font-bold text-black mb-2">Data</h3>

        <a href="{{ route('admin.data-pengguna.index') }}"
        class="flex items-center gap-3 px-4 py-2 rounded-full font-semibold transition
        {{ request()->routeIs('admin.data-pengguna.*')
                ? 'bg-primary text-white shadow-sm'
                : 'text-primary hover:bg-white' }}">

            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M7 2h6v6H7V2zM2 2h4v4H2V2zm12 0h4v4h-4V2zM2 8h4v4H2V8zm12 0h4v4h-4V8z"/>
            </svg>

            Data Pengguna
        </a>
    </div>
        
        <!-- HASIL DATA -->
        <div>
            <h3 class="font-bold text-black mb-2">Hasil Data</h3>

            <a href="{{ route('admin.hasil-pengguna.index') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-full font-semibold transition
            {{ request()->routeIs('admin.hasil-pengguna.index')
                    ? 'bg-primary text-white shadow-sm'
                    : 'text-primary hover:bg-white' }}">

                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M7 2h6v6H7V2zM2 2h4v4H2V2zm12 0h4v4h-4V2zM2 8h4v4H2V8zm12 0h4v4h-4V8z"/>
                </svg>

                Hasil Pengguna
            </a>
        </div>

    </nav>
    
    </aside>



    <!-- CONTENT -->
    <main class="flex-1 flex flex-col">

        <!-- HEADER -->
        <header class="bg-primary h-[56px] px-6 flex items-center justify-between border-b border-[#2f2253] relative">

            <!-- LEFT TITLE -->
        <h2 class="text-white text-[26px] font-bold whitespace-nowrap">
            @yield('page-title', 'Dashboard')
        </h2>

            <!-- SEARCH CENTER -->
            <div class="absolute left-1/2 -translate-x-1/2 w-[320px]">
                <div class="relative">
                    <input
                        type="text"
                        placeholder="Cari"
                        class="w-full h-[38px] rounded-full bg-white pl-11 pr-4 text-[14px] text-gray-700 placeholder-gray-400 focus:outline-none"
                    >

                    <!-- Search Icon -->
                    <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0a7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>

            <!-- RIGHT PROFILE -->
            <div class="relative">

                <!-- BUTTON -->
                <button onclick="toggleDropdown()"
                    class="flex items-center gap-3 text-white hover:bg-white/10 px-3 py-1.5 rounded-xl transition">

                    <!-- Avatar: huruf pertama username -->
                    <div class="w-9 h-9 rounded-full bg-white flex items-center justify-center text-primary font-bold text-sm">
                        {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                    </div>

                    <!-- Name & Role dari database -->
                    <div class="text-left leading-tight">
                        <p class="text-[14px] font-semibold">{{ Auth::user()->username }}</p>
                        <p class="text-[12px] text-gray-200">{{ ucfirst(Auth::user()->role) }}</p>
                    </div>

                    <!-- Arrow -->
                    <svg class="w-4 h-4"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- DROPDOWN -->
                <div id="profileDropdown"
                    class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl overflow-hidden z-50">

                    <a href="{{ route('logout') }}"
                        class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50">

                        <svg class="w-4 h-4"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1"/>
                        </svg>

                        Keluar
                    </a>

                </div>
            </div>
        </header>

        <!-- SCRIPT -->
        <script>
        function toggleDropdown() {
            const menu = document.getElementById('profileDropdown');
            menu.classList.toggle('hidden');
        }

        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdown');
            const button = e.target.closest('button');

            if (!e.target.closest('.relative')) {
                dropdown.classList.add('hidden');
            }
        });
        </script>

        <!-- PAGE -->
        <section class="flex-1 p-8 bg-[#F4F4F4]">
            @yield('content')
        </section>

    </main>

</div>

@stack('scripts')
</body>
</html>