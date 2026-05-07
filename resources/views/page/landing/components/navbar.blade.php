<nav class="sticky top-0 z-50 bg-white/95 border-b border-slate-200 backdrop-blur-md">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
        <a href="{{ route('landing') }}" class="flex items-center gap-3 text-lg font-bold text-slate-900">
            <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-primary to-secondary text-white shadow-lg">ET</div>
            eduTrace
        </a>

        <div class="hidden items-center gap-8 md:flex">
            <a href="#fitur" class="text-sm font-medium text-slate-700 hover:text-primary">Beranda</a>
            <a href="#fitur" class="text-sm font-medium text-slate-700 hover:text-primary">Fitur</a>
            <a href="#faq" class="text-sm font-medium text-slate-700 hover:text-primary">FAQ</a>
        </div>

        <div class="flex items-center gap-3">
            @if(session('authenticated'))
                <a href="{{ route('dashboard') }}" class="rounded-full border border-primary px-5 py-2 text-sm font-semibold text-primary transition hover:bg-primary/10">
                    Dashboard
                </a>
                <a href="{{ route('logout') }}" class="rounded-full bg-primary px-5 py-2 text-sm font-semibold text-white shadow-lg shadow-primary/20 transition hover:bg-primary/90">
                    Keluar
                </a>
            @else
                <a href="{{ route('login') }}" class="rounded-full border border-slate-300 bg-white px-5 py-2 text-sm font-semibold text-slate-700 transition hover:border-primary hover:text-primary">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="rounded-full bg-primary px-5 py-2 text-sm font-semibold text-white shadow-lg shadow-primary/20 transition hover:bg-primary/90">
                    Daftar
                </a>
            @endif
        </div>
    </div>
</nav>
