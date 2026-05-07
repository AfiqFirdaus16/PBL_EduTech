<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - EduTrace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3D2C6B',
                        secondary: '#5B4A8A'
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-4 rounded-[2rem] border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.24em] text-primary/80">Dashboard</p>
                <h1 class="mt-2 text-3xl font-bold text-slate-900">Selamat datang, {{ session('name', 'Siswa') }}!</h1>
                <p class="mt-2 text-sm text-slate-600">Ini adalah halaman dashboard sederhana untuk melihat ringkasan hasil belajar dan kebiasaan Anda.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('landing') }}" class="rounded-full border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Landing</a>
                <a href="{{ route('logout') }}" class="rounded-full bg-primary px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-primary/20 transition hover:bg-primary/90">Keluar</a>
            </div>
        </div>

        <section class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-[1.75rem] bg-white p-6 shadow-sm border border-slate-200">
                <h2 class="text-lg font-semibold text-slate-900">Data Akademik</h2>
                <p class="mt-3 text-sm text-slate-600">Akses data akademik untuk mengisi informasi dan melihat hasil analisis sistem.</p>
            </div>
            <div class="rounded-[1.75rem] bg-white p-6 shadow-sm border border-slate-200">
                <h2 class="text-lg font-semibold text-slate-900">Risk Monitoring</h2>
                <p class="mt-3 text-sm text-slate-600">Pantau risiko akademik secara cepat dengan rekomendasi yang relevan.</p>
            </div>
            <div class="rounded-[1.75rem] bg-white p-6 shadow-sm border border-slate-200">
                <h2 class="text-lg font-semibold text-slate-900">Rekomendasi</h2>
                <p class="mt-3 text-sm text-slate-600">Dapatkan saran teknik belajar berdasarkan kebiasaan dan tingkat risiko.</p>
            </div>
        </section>
    </div>
</body>
</html>