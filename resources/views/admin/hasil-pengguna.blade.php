@extends('layouts.app-admin')
@section('page-title', 'Hasil Analisa Pengguna')

@section('content')

    <div class="bg-primary rounded-xl px-5 py-3 flex items-center gap-2 mb-5">
        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
        </svg>
        <h2 class="text-white font-bold text-[15px]">Hasil Analisa Pengguna</h2>
    </div>

    <div class="flex flex-wrap items-end justify-between gap-3 mb-4">
        <div class="flex flex-wrap items-end gap-3">

            <div class="flex flex-col gap-1">
                <label class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide">Filter Variabel</label>
                <div class="relative">
                    <select id="filterVar"
                        class="appearance-none h-[38px] pl-4 pr-9 rounded-lg border border-gray-300 bg-white text-[13px] text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">Pilih Variabel</option>
                        <option value="attendance" {{ request('sort_by') == 'attendance' ? 'selected' : '' }}>
                            Kehadiran</option>
                        <option value="sleep_hours" {{ request('sort_by') == 'sleep_hours' ? 'selected' : '' }}>Jam
                            Tidur</option>
                        <option value="hours_studied" {{ request('sort_by') == 'hours_studied' ? 'selected' : '' }}>
                            Jam Belajar</option>
                        <option value="access_to_resources"
                            {{ request('sort_by') == 'access_to_resources' ? 'selected' : '' }}>Akses Belajar</option>
                        <option value="motivation_level"
                            {{ request('sort_by') == 'motivation_level' ? 'selected' : '' }}>Motivasi</option>
                        <option value="tutoring_sessions"
                            {{ request('sort_by') == 'tutoring_sessions' ? 'selected' : '' }}>Sesi Les</option>
                        <option value="previous_scores" {{ request('sort_by') == 'previous_scores' ? 'selected' : '' }}>
                            Nilai Sebelumnya</option>
                        <option value="kesulitan_belajar"
                            {{ request('sort_by') == 'kesulitan_belajar' ? 'selected' : '' }}>Kesulitan Belajar</option>
                    </select>
                    <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            <div class="flex flex-col gap-1">
                <label class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide">Tingkat Risiko</label>
                <div class="relative">
                    <select id="filterRisk"
                        class="appearance-none h-[38px] pl-4 pr-9 rounded-lg border border-gray-300 bg-white text-[13px] text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">Semua Risiko</option>
                        <option value="Low" {{ request('risk_level') == 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Medium" {{ request('risk_level') == 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="High" {{ request('risk_level') == 'High' ? 'selected' : '' }}>High</option>
                    </select>
                    <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            <div class="flex flex-col gap-1">
                <label class="text-[11px] font-semibold text-transparent uppercase tracking-wide select-none">-</label>
                <button onclick="applyFilters()"
                    class="h-[38px] px-4 bg-primary hover:bg-indigo-700 text-white text-[13px] font-semibold rounded-lg transition">
                    Terapkan
                </button>
            </div>

            @if (request()->hasAny(['risk_level', 'sort_by', 'search']))
                <div class="flex flex-col gap-1">
                    <label class="text-[11px] font-semibold text-transparent uppercase tracking-wide select-none">-</label>
                    <a href="{{ route('admin.hasil-pengguna.index') }}"
                        class="h-[38px] px-4 flex items-center bg-gray-100 hover:bg-gray-200 text-gray-600 text-[13px] font-semibold rounded-lg transition">
                        Reset
                    </a>
                </div>
            @endif

            <div class="flex flex-col gap-1">
                <label class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide">Cari</label>
                <div class="relative">
                    <input type="text" id="searchHasil" value="{{ request('search') }}" placeholder="Nama, username..."
                        oninput="handleSearch(this.value)" autocomplete="off"
                        class="h-[38px] pl-9 pr-4 w-[200px] rounded-lg border border-gray-300 bg-white text-[13px] text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0a7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

        </div>

        <a href="{{ route('admin.hasil-pengguna.export', request()->only(['risk_level', 'sort_by', 'search'])) }}"
            class="flex items-center gap-2 bg-accent hover:bg-yellow-500 text-white font-semibold text-[13px] px-4 py-2 rounded-lg transition h-[38px]">
            Export CSV
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V3" />
            </svg>
        </a>
    </div>

    @if (request('sort_by') || request('risk_level') || request('search'))
        <div class="mb-3 flex items-center gap-2 flex-wrap">
            <span class="text-[12px] text-gray-500">Filter aktif:</span>
            @if (request('sort_by'))
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-[12px] font-semibold">
                    Urut:
                    {{ collect([
                        'attendance' => 'Kehadiran',
                        'sleep_hours' => 'Jam Tidur',
                        'hours_studied' => 'Jam Belajar',
                        'access_to_resources' => 'Akses Belajar',
                        'motivation_level' => 'Motivasi',
                        'tutoring_sessions' => 'Sesi Les',
                        'previous_scores' => 'Nilai Sebelumnya',
                        'kesulitan_belajar' => 'Kesulitan Belajar',
                    ])->get(request('sort_by'), request('sort_by')) }}
                </span>
            @endif
            @if (request('risk_level'))
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full
        {{ request('risk_level') == 'High' ? 'bg-red-100 text-red-700' : (request('risk_level') == 'Medium' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}
        text-[12px] font-semibold">
                    Risiko: {{ request('risk_level') }}
                </span>
            @endif
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm">
        <div class="hasil-table-wrapper" style="overflow-x:auto; position:relative;">
            <table class="hasil-table w-full text-[12px] text-gray-700"
                style="border-collapse:separate; border-spacing:0; min-width:1300px;">
                <thead>
                    <tr class="border-b border-gray-200 text-center text-[12px] font-semibold text-gray-600 bg-white">
                        <th class="col-fixed-left px-3 py-3 text-center" style="left:0; min-width:48px;">No</th>
                        <th class="col-fixed-left px-3 py-3 text-left" style="left:48px; min-width:140px;">Nama</th>
                        <th class="col-fixed-left px-3 py-3 text-center"
                            style="left:188px; min-width:110px; border-right:2px solid #e5e7eb;">Username</th>

                        <th
                            class="px-3 py-3 {{ request('sort_by') == 'attendance' ? 'bg-indigo-50 text-indigo-700' : '' }}">
                            Kehadiran</th>
                        <th
                            class="px-3 py-3 {{ request('sort_by') == 'sleep_hours' ? 'bg-indigo-50 text-indigo-700' : '' }}">
                            Jam Tidur</th>
                        <th
                            class="px-3 py-3 {{ request('sort_by') == 'hours_studied' ? 'bg-indigo-50 text-indigo-700' : '' }}">
                            Jam Belajar</th>
                        <th
                            class="px-3 py-3 {{ request('sort_by') == 'access_to_resources' ? 'bg-indigo-50 text-indigo-700' : '' }}">
                            Akses Belajar</th>
                        <th
                            class="px-3 py-3 {{ request('sort_by') == 'motivation_level' ? 'bg-indigo-50 text-indigo-700' : '' }}">
                            Motivasi</th>
                        <th
                            class="px-3 py-3 {{ request('sort_by') == 'tutoring_sessions' ? 'bg-indigo-50 text-indigo-700' : '' }}">
                            Sesi Les</th>
                        <th
                            class="px-3 py-3 {{ request('sort_by') == 'previous_scores' ? 'bg-indigo-50 text-indigo-700' : '' }}">
                            Nilai Sebelumnya</th>
                        <th
                            class="px-3 py-3 {{ request('sort_by') == 'kesulitan_belajar' ? 'bg-indigo-50 text-indigo-700' : '' }}">
                            Kesulitan Belajar</th>

                        <th class="col-fixed-right px-3 py-3"
                            style="right:360px; min-width:110px; border-left:2px solid #e5e7eb;">Tingkat Risiko</th>
                        <th class="col-fixed-right px-3 py-3 text-left bg-purple-50"
                            style="right:240px; min-width:120px;">Rekomendasi 1</th>
                        <th class="col-fixed-right px-3 py-3 text-left bg-purple-50"
                            style="right:120px; min-width:120px;">Rekomendasi 2</th>
                        <th class="col-fixed-right px-3 py-3 text-left bg-purple-50" style="right:0;    min-width:120px;">
                            Rekomendasi 3</th>
                    </tr>
                </thead>
                <tbody id="tableHasil">
                    @forelse($hasilAnalisa as $index => $item)
                        @php
                            $rawRec = $item->rekomendasi;
                            $decoded = json_decode($rawRec, true);

                            if (is_array($decoded)) {
                                $rekomendasi = collect($decoded);
                            } elseif (!empty($rawRec)) {
                                $rekomendasi = collect(explode(',', $rawRec));
                            } else {
                                $rekomendasi = collect([]);
                            }

                            $rek1 = trim($rekomendasi->get(0, '-'));
                            $rek2 = trim($rekomendasi->get(1, '-'));
                            $rek3 = trim($rekomendasi->get(2, '-'));

                            $riskStyle = match ($item->risk_level) {
                                'High', 'HIGH' => 'bg-red-100 text-red-700',
                                'Medium', 'MEDIUM' => 'bg-yellow-100 text-yellow-700',
                                'Low', 'LOW' => 'bg-green-100 text-green-700',
                                default => 'bg-gray-100 text-gray-500',
                            };

                            // Proteksi fallback nama siswa dari integrasi SIAKAD
                            $namaSiswa = $item->sesiKuis->siswa->nama ?? ($item->sesiKuis->siswa->name ?? '-');
                        @endphp
                        <tr class="border-b border-gray-100 text-center hover:bg-gray-50 transition">
                            <td class="col-fixed-left px-3 py-3 bg-white" style="left:0;">
                                {{ $hasilAnalisa->firstItem() + $index }}</td>
                            <td class="col-fixed-left px-3 py-3 text-left font-medium bg-white" style="left:48px;">
                                {{ $namaSiswa }}</td>
                            <td class="col-fixed-left px-3 py-3 bg-white"
                                style="left:188px; border-right:2px solid #e5e7eb;">
                                {{ $item->sesiKuis->siswa->user->username ?? '-' }}</td>

                            <td
                                class="px-3 py-3 {{ request('sort_by') == 'attendance' ? 'bg-indigo-50 font-semibold' : '' }}">
                                {{ $item->attendance ?? '0' }}</td>
                            <td
                                class="px-3 py-3 {{ request('sort_by') == 'sleep_hours' ? 'bg-indigo-50 font-semibold' : '' }}">
                                {{ $item->sleep_hours ?? '-' }}</td>
                            <td
                                class="px-3 py-3 {{ request('sort_by') == 'hours_studied' ? 'bg-indigo-50 font-semibold' : '' }}">
                                {{ $item->hours_studied ?? '0' }}</td>
                            <td
                                class="px-3 py-3 {{ request('sort_by') == 'access_to_resources' ? 'bg-indigo-50 font-semibold' : '' }}">
                                {{ $item->access_to_resources ?? '-' }}</td>
                            <td
                                class="px-3 py-3 {{ request('sort_by') == 'motivation_level' ? 'bg-indigo-50 font-semibold' : '' }}">
                                {{ $item->motivation_level ?? '-' }}</td>
                            <td
                                class="px-3 py-3 {{ request('sort_by') == 'tutoring_sessions' ? 'bg-indigo-50 font-semibold' : '' }}">
                                {{ $item->tutoring_sessions ?? '-' }}</td>
                            <td
                                class="px-3 py-3 {{ request('sort_by') == 'previous_scores' ? 'bg-indigo-50 font-semibold' : '' }}">
                                {{ $item->previous_scores ?? '0' }}</td>
                            <td
                                class="px-3 py-3 {{ request('sort_by') == 'kesulitan_belajar' ? 'bg-indigo-50 font-semibold' : '' }}">
                                {{ $item->kesulitan_belajar ?? '-' }}</td>

                            <td class="col-fixed-right px-3 py-3 bg-white"
                                style="right:360px; border-left:2px solid #e5e7eb;">
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-[11px] font-semibold {{ $riskStyle }}">
                                    {{ ucfirst(strtolower($item->risk_level)) }}
                                </span>
                            </td>
                            <td class="col-fixed-right px-3 py-3 text-left bg-purple-50" style="right:240px;">
                                {{ $rek1 }}</td>
                            <td class="col-fixed-right px-3 py-3 text-left bg-purple-50" style="right:120px;">
                                {{ $rek2 }}</td>
                            <td class="col-fixed-right px-3 py-3 text-left bg-purple-50" style="right:0;">
                                {{ $rek3 }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="15" class="text-center py-8 text-gray-400">Belum ada data hasil analisis.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <p id="searchEmptyMsg" class="hidden text-center text-gray-400 text-sm py-6">
                Data tidak ditemukan.
            </p>
        </div>
    </div>

    <div class="flex justify-end mt-4">
        {{ $hasilAnalisa->withQueryString()->links() }}
    </div>

    <style>
        .col-fixed-left,
        .col-fixed-right {
            position: sticky;
            z-index: 2;
        }

        thead .col-fixed-left,
        thead .col-fixed-right {
            z-index: 3;
            background: white;
        }

        tbody tr:hover .col-fixed-left,
        tbody tr:hover .col-fixed-right {
            background: #f9fafb !important;
        }

        tbody tr:hover .col-fixed-right.bg-purple-50 {
            background: #f3f0ff !important;
        }

        .hasil-table-wrapper::-webkit-scrollbar {
            height: 6px;
        }

        .hasil-table-wrapper::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 99px;
        }

        .hasil-table-wrapper::-webkit-scrollbar-thumb {
            background: #c7c7c7;
            border-radius: 99px;
        }

        .hasil-table-wrapper::-webkit-scrollbar-thumb:hover {
            background: #a0a0a0;
        }
    </style>

@endsection

@push('scripts')
    <script>
        function applyFilters() {
            const url = new URL(window.location.href);

            const risk = document.getElementById('filterRisk').value;
            risk ? url.searchParams.set('risk_level', risk) : url.searchParams.delete('risk_level');

            const sortBy = document.getElementById('filterVar').value;
            sortBy ? url.searchParams.set('sort_by', sortBy) : url.searchParams.delete('sort_by');

            const search = document.getElementById('searchHasil').value.trim();
            search ? url.searchParams.set('search', search) : url.searchParams.delete('search');

            url.searchParams.delete('page');
            window.location.href = url.toString();
        }

        function handleSearch(query) {
            const rows = document.querySelectorAll('#tableHasil tr');
            const emptyMsg = document.getElementById('searchEmptyMsg');
            const q = query.trim().toLowerCase();

            // Proteksi jika table kosong
            if (rows.length === 1 && rows[0].textContent.includes('Belum ada data')) return;

            rows.forEach(row => {
                row.style.display = (q === '' || row.textContent.toLowerCase().includes(q)) ? '' : 'none';
            });

            const allHidden = Array.from(rows).every(r => r.style.display === 'none');
            emptyMsg.classList.toggle('hidden', !(allHidden && q !== ''));
        }
    </script>
@endpush
