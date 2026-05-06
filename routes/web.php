<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataAkademikController;

// AUTH
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::view('/register', 'auth.register')->name('register');

// DASHBOARD (WAJIB LOGIN)
Route::view('/dashboard', 'dashboard')
    ->name('dashboard')
    ->middleware('auth');

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
    return view('hasil-resiko');
    })->name('hasil-resiko.index');

    Route::get('/teknik-belajar', function () {
        return view('teknik-belajar');
    })->name('teknik-belajar.index');

    Route::get('/riwayat', function () {
        return view('riwayat');
    })->name('riwayat.index');