@extends('layouts.app-admin')
@section('page-title', 'Data Pengguna')

@section('content')

<!-- HEADER BAR -->
<div class="bg-primary rounded-xl px-5 py-3 flex items-center gap-2 mb-5">
    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
    </svg>
    <h2 class="text-white font-bold text-[15px]">Data Pengguna</h2>
</div>

<!-- FILTER & EXPORT -->
<div class="flex items-center justify-between mb-4">
    <div class="flex items-center gap-3">

        <!-- Filter Jenjang -->
        <div class="relative">
            <select id="filterJenjang"
                class="appearance-none h-[38px] pl-4 pr-9 rounded-lg border border-gray-300 bg-white text-[13px] text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary">
                <option value="">Filter Jenjang</option>
                <option value="SMP">SMP</option>
                <option value="SMA">SMA</option>
            </select>
            <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>

        <!-- Filter Tingkat -->
        <div class="relative">
            <select id="filterTingkat"
                class="appearance-none h-[38px] pl-4 pr-9 rounded-lg border border-gray-300 bg-white text-[13px] text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary">
                <option value="">Filter Tingkat</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
            <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>

        <!-- Search -->
        <div class="relative">
            <input
                type="text"
                id="searchPengguna"
                placeholder="Cari nama, username, email..."
                oninput="handleSearch(this.value)"
                autocomplete="off"
                class="h-[38px] pl-9 pr-4 w-[220px] rounded-lg border border-gray-300 bg-white text-[13px] text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary"
            >
            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0a7 7 0 0114 0z"/>
            </svg>
        </div>

    </div>

    <!-- Export -->
    <a href="{{ route('admin.data-pengguna.export') }}"
        class="flex items-center gap-2 bg-accent hover:bg-yellow-500 text-white font-semibold text-[13px] px-4 py-2 rounded-lg transition">
        Export All Data
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V3"/>
        </svg>
    </a>
</div>

<!-- TABLE -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-[13px] text-gray-700">
        <thead>
            <tr class="border-b border-gray-200 text-center text-[13px] font-semibold text-gray-600">
                <th class="px-4 py-3">No</th>
                <th class="px-4 py-3">Nama</th>
                <th class="px-4 py-3">Username</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Tgl Lahir</th>
                <th class="px-4 py-3">Jenjang</th>
                <th class="px-4 py-3">Tingkat</th>
                <th class="px-4 py-3">Password</th>
                <th class="px-4 py-3">Update Data</th>
                <th class="px-4 py-3">Tindakan</th>
            </tr>
        </thead>
        <tbody id="tablePengguna">
            @forelse($siswas as $index => $siswa)
            <tr class="border-b border-gray-100 text-center hover:bg-gray-50 transition">
                <td class="px-4 py-3">{{ $siswas->firstItem() + $index }}</td>
                <td class="px-4 py-3">{{ $siswa->nama }}</td>
                <td class="px-4 py-3">{{ $siswa->user->username }}</td>
                <td class="px-4 py-3">{{ $siswa->user->email ?? '-' }}</td>
                <td class="px-4 py-3">{{ $siswa->tgl_lahir ? \Carbon\Carbon::parse($siswa->tgl_lahir)->format('d/m/Y') : '-' }}</td>
                <td class="px-4 py-3">{{ $siswa->jenjang }}</td>
                <td class="px-4 py-3">{{ $siswa->tingkat }}</td>
                <td class="px-4 py-3">{{ $siswa->user->password ? '••••••••' : '-' }}</td>

                <!-- Update Data (dari user) -->
                <td class="px-4 py-3">
                    @if($siswa->updated_at > $siswa->created_at)
                        <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-[11px] font-semibold px-2 py-1 rounded-full">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            {{ \Carbon\Carbon::parse($siswa->updated_at)->format('d/m/Y H:i') }}
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-400 text-[11px] font-semibold px-2 py-1 rounded-full">
                            Belum diupdate
                        </span>
                    @endif
                </td>

                <!-- Tindakan: Hapus -->
                <td class="px-4 py-3">
                    <form action="{{ route('admin.data-pengguna.destroy', $siswa->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center py-8 text-gray-400">Tidak ada data pengguna.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pesan tidak ditemukan (muncul saat search kosong hasil) -->
    <p id="searchEmptyMsg" class="hidden text-center text-gray-400 text-sm py-6">
        Data tidak ditemukan.
    </p>
</div>

<!-- PAGINATION -->
<div class="flex justify-end mt-4">
    {{ $siswas->links() }}
</div>

@endsection

@push('scripts')
<script>
    // ── FILTER JENJANG & TINGKAT ──────────────────────────────────
    const filterJenjang = document.getElementById('filterJenjang');
    const filterTingkat = document.getElementById('filterTingkat');

    function applyFilter() {
        const jenjang = filterJenjang.value;
        const tingkat = filterTingkat.value;
        const url = new URL(window.location.href);

        jenjang ? url.searchParams.set('jenjang', jenjang) : url.searchParams.delete('jenjang');
        tingkat ? url.searchParams.set('tingkat', tingkat) : url.searchParams.delete('tingkat');

        window.location.href = url.toString();
    }

    filterJenjang.addEventListener('change', applyFilter);
    filterTingkat.addEventListener('change', applyFilter);

    // Set nilai filter dari URL
    const params = new URLSearchParams(window.location.search);
    if (params.get('jenjang')) filterJenjang.value = params.get('jenjang');
    if (params.get('tingkat')) filterTingkat.value = params.get('tingkat');

    // ── SEARCH REAL-TIME ──────────────────────────────────────────
    function handleSearch(query) {
        const rows     = document.querySelectorAll('#tablePengguna tr');
        const emptyMsg = document.getElementById('searchEmptyMsg');
        const q        = query.trim().toLowerCase();

        rows.forEach(function(row) {
            if (q === '') {
                row.style.display = '';
                return;
            }
            row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
        });

        const allHidden = Array.from(rows).every(function(r) {
            return r.style.display === 'none';
        });

        emptyMsg.classList.toggle('hidden', !(allHidden && q !== ''));
    }
</script>
@endpush