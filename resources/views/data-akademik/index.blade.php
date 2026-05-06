@extends('layouts.app-siswa')

@section('title', 'Input Data Akademik')
@section('page-title', 'Input Data')

@push('styles')
<style>
.content-wrapper{
    padding:30px 45px;
}

.page-title-custom{
    font-size:30px;
    font-weight:800;
    color:#3D2C6B;
    margin-bottom:35px;
}

.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:24px 40px;
}

.form-group label{
    display:block;
    font-size:18px;
    font-weight:700;
    margin-bottom:8px;
    color:#111;
}

.form-control{
    width:100%;
    height:46px;
    border:1.5px solid #8b84ff;
    border-radius:12px;
    padding:0 15px;
    font-size:15px;
    background:white;
    outline:none;
}

.form-control.error{
    border-color:red;
}

small.error-text{
    color:red;
    display:none;
    font-size:13px;
    margin-top:5px;
}

.btn-area{
    display:flex;
    justify-content:flex-end;
    gap:14px;
    margin-top:45px;
}

.btn-cancel{
    width:125px;
    height:45px;
    border:none;
    border-radius:12px;
    background:#e5e5e5;
    color:#666;
    font-size:17px;
    font-weight:700;
}

.btn-save{
    width:130px;
    height:45px;
    border:none;
    border-radius:12px;
    background:#3D2C6B;
    color:white;
    font-size:17px;
    font-weight:700;
}

.btn-save:hover{
    background:#2e2058;
}

@media(max-width:1200px){
    .form-grid{
        grid-template-columns:1fr;
    }
}
</style>
@endpush

@section('content')

<div class="content-wrapper">

    <div class="page-title-custom">
        Input Data sesuai dengan kondisi
    </div>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div style="margin-bottom:15px;padding:10px;background:#d4edda;color:#155724;border-radius:8px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR --}}
    @if ($errors->any())
        <div style="margin-bottom:15px;padding:10px;background:#f8d7da;color:#721c24;border-radius:8px;">
            <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('data-akademik.store') }}" method="POST">
        @csrf

        <div class="form-grid">

            {{-- Jam Belajar --}}
            <div class="form-group">
                <label>Jam Belajar</label>
                <input type="number" id="jam_belajar" name="jam_belajar" class="form-control" max="24">
                <small id="error_jam_belajar" class="error-text">*maksimal 24 jam</small>
            </div>

            {{-- Gangguan --}}
            <div class="form-group">
                <label>Gangguan Belajar</label>
                <select name="gangguan_belajar" class="form-control">
                    <option value="">-- Pilih --</option>
                    <option value="ya">Ya</option>
                    <option value="tidak">Tidak</option>
                </select>
            </div>

            {{-- Jam Tidur --}}
            <div class="form-group">
                <label>Jam Tidur</label>
                <input type="number" id="jam_tidur" name="jam_tidur" class="form-control" max="24">
                <small id="error_jam_tidur" class="error-text">*maksimal 24 jam</small>
            </div>

            {{-- Keterlibatan --}}
            <div class="form-group">
                <label>Keterlibatan Orang Tua</label>
                <select name="keterlibatan_ortu" class="form-control">
                    <option value="">-- Pilih --</option>
                    <option value="rendah">Rendah</option>
                    <option value="sedang">Sedang</option>
                    <option value="tinggi">Tinggi</option>
                </select>
            </div>

            {{-- Motivasi --}}
            <div class="form-group">
                <label>Motivasi</label>
                <select name="motivasi" class="form-control">
                    <option value="">-- Pilih --</option>
                    <option value="rendah">Rendah</option>
                    <option value="sedang">Sedang</option>
                    <option value="tinggi">Tinggi</option>
                </select>
            </div>

            {{-- Akses --}}
            <div class="form-group">
                <label>Akses Pembelajaran</label>
                <select name="akses_pembelajaran" class="form-control">
                    <option value="">-- Pilih --</option>
                    <option value="baik">Online</option>
                    <option value="cukup">Offline</option>
                    <option value="kurang">Keduanya</option>
                </select>
            </div>

            {{-- Nilai --}}
            <div class="form-group">
                <label>Nilai</label>
                <input type="number" id="nilai_ujian" name="nilai_ujian" class="form-control" max="100">
                <small id="error_nilai" class="error-text">*maksimal 100</small>
            </div>

            {{-- Kelas --}}
            <div class="form-group">
                <label>Kelas Tambahan</label>
                <input type="number" id="kelas_tambahan" name="kelas_tambahan" class="form-control" max="10">
                <small id="error_kelas" class="error-text">*maksimal 10</small>
            </div>

        </div>

        <div class="btn-area">
            <button type="reset" class="btn-cancel">Batal</button>
            <button type="submit" class="btn-save">Simpan</button>
        </div>

    </form>

</div>

@endsection

@push('scripts')
<script>

function validate(inputId, errorId, max) {
    let input = document.getElementById(inputId);
    let error = document.getElementById(errorId);

    input.addEventListener('input', function() {
        if (parseFloat(input.value) > max) {
            error.style.display = 'block';
            input.classList.add('error');
        } else {
            error.style.display = 'none';
            input.classList.remove('error');
        }
    });
}

validate('jam_belajar', 'error_jam_belajar', 24);
validate('jam_tidur', 'error_jam_tidur', 24);
validate('nilai_ujian', 'error_nilai', 100);
validate('kelas_tambahan', 'error_kelas', 10);

</script>
@endpush