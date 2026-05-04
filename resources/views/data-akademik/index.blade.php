@extends('layouts.app')

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

.form-control:focus{
    border-color:#3D2C6B;
    box-shadow:0 0 0 2px rgba(61,44,107,.1);
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

    <form action="{{ route('data-akademik.store') }}" method="POST">
        @csrf

        <div class="form-grid">

            <div class="form-group">
                <label>Jam Belajar</label>
                <input type="number" class="form-control">
            </div>

            <div class="form-group">
                <label>Gangguan Belajar</label>
                <select class="form-control">
                    <option></option>
                    <option>Ya</option>
                    <option>Tidak</option>
                </select>
            </div>

            <div class="form-group">
                <label>Jam Tidur</label>
                <input type="number" class="form-control">
            </div>

            <div class="form-group">
                <label>Keterlibatan Orang Tua</label>
                <select class="form-control">
                    <option></option>
                    <option>Rendah</option>
                    <option>Sedang</option>
                    <option>Tinggi</option>
                </select>
            </div>

            <div class="form-group">
                <label>Motivasi Belajar</label>
                <select class="form-control">
                    <option></option>
                    <option>Rendah</option>
                    <option>Sedang</option>
                    <option>Tinggi</option>
                </select>
            </div>

            <div class="form-group">
                <label>Akses Pembelajaran</label>
                <select class="form-control">
                    <option></option>
                    <option>Online</option>
                    <option>Offline</option>
                    <option>Keduanya</option>
                </select>
            </div>

            <div class="form-group">
                <label>Nilai Ujian Terakhir</label>
                <input type="number" class="form-control">
            </div>

            <div class="form-group">
                <label>Kelas Tambahan</label>
                <input type="number" class="form-control">
            </div>

        </div>

        <div class="btn-area">
            <button type="button" class="btn-cancel">Batal</button>
            <button type="submit" class="btn-save">Simpan</button>
        </div>

    </form>

</div>

@endsection