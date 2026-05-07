<?php

use Illuminate\Http\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataAkademikController;

// Landing Page
Route::get('/', function () {
    return view('page.landing.index');
})->name('landing');

// AUTH
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    $request->session()->put('authenticated', true);
    $request->session()->put('name', $request->input('nama', 'Siswa'));
    return redirect()->route('dashboard');
})->name('register.submit');

Route::get('/logout', function (Request $request) {
    $request->session()->flush();
    return redirect()->route('landing');
})->name('logout');

// form input email
Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');

// proses kirim email (sementara dummy dulu)
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
    ->name('password.email');

// form reset password
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');

// proses update password
Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->name('password.update');

// DASHBOARD USER (WAJIB LOGIN)
Route::view('/dashboard', 'dashboard')
    ->name('dashboard')
    ->middleware('auth');

//DASHBOARD ADMIN
Route::get('/dashboard-admin', function () {
    return view('admin.dashboard-admin');
})->name('admin.dashboard-admin');

// DATA AKADEMIK (WAJIB LOGIN)
//Route::middleware(['auth'])->group(function () {
//});
    // halaman input
    Route::view('/data-akademik', 'data-akademik.index')
        ->name('data-akademik.index');

    //simpan data
    Route::post('/data-akademik', [DataAkademikController::class, 'store'])
        ->name('data-akademik.store');
        
    //edit
    Route::get('/data-akademik/{id}/edit', [DataAkademikController::class, 'edit'])
        ->name('data-akademik.edit');

    //update
    Route::put('/data-akademik/{id}', [DataAkademikController::class, 'update'])
        ->name('data-akademik.update');

    Route::get('/hasil-resiko', function () {
    return view('siswa.hasil-resiko');
    })->name('hasil-resiko.index');

    Route::get('/teknik-belajar', function () {
        return view('siswa.teknik-belajar');
    })->name('teknik-belajar.index');

    Route::get('/riwayat', function () {
        return view('siswa.riwayat');
    })->name('riwayat.index');

    //Laman Admin
    Route::get('/data-pengguna', function () {
        return view('admin.data-pengguna');
    })->name('data-pengguna.index');