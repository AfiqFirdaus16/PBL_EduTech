@extends('layouts.app')

@section('title', 'Edit Data Akademik')
@section('page-title', 'Edit Data')

@section('content')

<div class="content-wrapper">

    <h2>Edit Data Akademik</h2>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div style="color:green;margin-bottom:10px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR --}}
    @if ($errors->any())
        <div style="color:red;margin-bottom:10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('data-akademik.update', $data->data_siswa_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">

            <div>
                <label>Jam Belajar</label>
                <input type="number" name="jam_belajar"
                    value="{{ old('jam_belajar', $data->jam_belajar) }}">
            </div>

            <div>
                <label>Gangguan Belajar</label>
                <select name="gangguan_belajar">
                    <option value="ya" {{ $data->gangguan_belajar=='ya' ? 'selected' : '' }}>Ya</option>
                    <option value="tidak" {{ $data->gangguan_belajar=='tidak' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>

            <div>
                <label>Jam Tidur</label>
                <input type="number" name="jam_tidur"
                    value="{{ old('jam_tidur', $data->jam_tidur) }}">
            </div>

            <div>
                <label>Keterlibatan Ortu</label>
                <select name="keterlibatan_ortu">
                    <option value="rendah" {{ $data->keterlibatan_ortu=='rendah' ? 'selected' : '' }}>Rendah</option>
                    <option value="sedang" {{ $data->keterlibatan_ortu=='sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="tinggi" {{ $data->keterlibatan_ortu=='tinggi' ? 'selected' : '' }}>Tinggi</option>
                </select>
            </div>

            <div>
                <label>Motivasi</label>
                <select name="motivasi">
                    <option value="rendah" {{ $data->motivasi=='rendah' ? 'selected' : '' }}>Rendah</option>
                    <option value="sedang" {{ $data->motivasi=='sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="tinggi" {{ $data->motivasi=='tinggi' ? 'selected' : '' }}>Tinggi</option>
                </select>
            </div>

            <div>
                <label>Akses</label>
                <select name="akses_pembelajaran">
                    <option value="baik" {{ $data->akses_pembelajaran=='baik' ? 'selected' : '' }}>Online</option>
                    <option value="cukup" {{ $data->akses_pembelajaran=='cukup' ? 'selected' : '' }}>Offline</option>
                    <option value="kurang" {{ $data->akses_pembelajaran=='kurang' ? 'selected' : '' }}>Keduanya</option>
                </select>
            </div>

            <div>
                <label>Nilai Ujian</label>
                <input type="number" name="nilai_ujian"
                    value="{{ old('nilai_ujian', $data->nilai_ujian) }}">
            </div>

            <div>
                <label>Kelas Tambahan</label>
                <input type="number" name="kelas_tambahan"
                    value="{{ old('kelas_tambahan', $data->kelas_tambahan) }}">
            </div>

        </div>

        <br>
        <button type="submit">Update</button>

    </form>

</div>

@endsection