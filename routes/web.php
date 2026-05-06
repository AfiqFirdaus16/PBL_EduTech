<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataAkademikController;

// AUTH
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

// DASHBOARD (WAJIB LOGIN)
Route::view('/dashboard', 'dashboard')
    ->name('dashboard')
    ->middleware('auth');

// DATA AKADEMIK (WAJIB LOGIN)
Route::middleware(['auth'])->group(function () {

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

});