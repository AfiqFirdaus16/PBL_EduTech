<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - EduTrace</title>
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
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-800 to-[#f59e0b] text-slate-900">
    <div class="mx-auto flex min-h-screen max-w-5xl items-center justify-center px-4 py-10">
        <div class="w-full rounded-[2rem] bg-white/95 p-8 shadow-2xl shadow-slate-900/10 sm:p-10">
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-extrabold text-slate-900">Masuk ke EduTrace</h1>
                <p class="mt-3 text-sm text-slate-600">Masukkan username dan password untuk melanjutkan ke dashboard.</p>
            </div>

            <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Username</label>
                    <input type="text" name="username" required class="mt-2 w-full rounded-3xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="Username" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Password</label>
                    <input type="password" name="password" required class="mt-2 w-full rounded-3xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="Password" />
                </div>
                <div class="flex items-center justify-between text-sm text-slate-600">
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-primary focus:ring-primary" />
                        Ingatkan saya
                    </label>
                    <a href="#" class="font-semibold text-primary hover:text-primary/80">Lupa Password?</a>
                </div>
                <button type="submit" class="w-full rounded-3xl bg-primary px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-primary/30 transition hover:bg-primary/90">Masuk</button>
            </form>

            <p class="mt-6 text-center text-sm text-slate-600">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-primary hover:text-primary/80">Daftar sekarang</a></p>
        </div>
    </div>
</body>
</html>