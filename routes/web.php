<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataAkademikController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeknikBelajarController;
use App\Http\Controllers\AnalisaController;

// // Landing Page
// Route::get('/', function () {
//     return view('page.landing.index');
// })->name('landing');

// AUTH
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

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

    Route::get('/teknik-belajar', [TeknikBelajarController::class, 'index'])->name('teknik-belajar.index');
    Route::get('/teknik-belajar/teknik-belajar', [TeknikBelajarController::class, 'teknikBelajar'])->name('teknik-belajar.teknikBelajar');

    Route::get('/riwayat', function () {
        return view('siswa.riwayat');
    })->name('riwayat.index');

    //Laman Admin
    Route::get('/data-pengguna', function () {
        return view('admin.data-pengguna');
    })->name('data-pengguna.index');

//User Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


Route::get('/', function () {
    return view('welcome');
});

//reAnalisa
Route::get('/reAnalisa', function () {
    return view('page.reAnalisa');
})->name('reAnalisa');

//KUIS
Route::get('/kuis', function () {
    return view('page.kuis');
});

//hasil analisa
Route::get('/hasil', function () {
    return view('page.hasil');
})->name('hasil');