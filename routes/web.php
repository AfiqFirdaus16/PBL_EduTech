<?php

use Illuminate\Support\Facades\Route;

//auth
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

// Data Akademik
Route::view('/data-akademik', 'data-akademik.index')->name('data-akademik.index');

// Dummy submit (biar tombol submit tidak error)
Route::post('/data-akademik', function () {
    return redirect()->route('data-akademik.index');
})->name('data-akademik.store');

Route::view('/dashboard', 'dashboard')->name('dashboard');