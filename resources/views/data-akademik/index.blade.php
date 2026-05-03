@extends('layouts.app')

@section('title', 'Data Akademik')
@section('header-title', 'Data Akademik')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-semibold text-primary">Daftar Data Akademik</h3>
        <a href="{{ route('data-akademik.create') }}" class="bg-primary hover:bg-secondary text-white px-6 py-2.5 rounded-lg font-medium transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Data
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 text-left">
                    <th class="px-4 py-3 text-sm font-semibold text-gray-600">No</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-600">Jam Belajar</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-600">Jam Tidur</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-600">Motivasi</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-600">Nilai Ujian</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-600">Gangguan</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($dataAkademik as $index => $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm text-gray-700">{{ $index + 1 }}</td>
                    <td class="px-4 py-3 text-sm text-gray-700">{{ $item['jam_belajar'] }} jam</td>
                    <td class="px-4 py-3 text-sm text-gray-700">{{ $item['jam_tidur'] }} jam</td>
                    <td class="px-4 py-3 text-sm text-gray-700">{{ $item['motivasi_belajar'] }}</td>
                    <td class="px-4 py-3 text-sm text-gray-700">{{ $item['nilai_ujian_terakhir'] }}</td>
                    <td class="px-4 py-3 text-sm text-gray-700">{{ $item['gangguan_belajar'] }}</td>
                    <td class="px-4 py-3 text-sm">
                        <div class="flex gap-2">
                            <a href="{{ route('data-akademik.edit', $item['id']) }}" class="text-blue-600 hover:text-blue-800">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('data-akademik.destroy', $item['id']) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">Belum ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
