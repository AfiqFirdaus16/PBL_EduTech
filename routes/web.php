<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    return view('page.landing.index');
})->name('landing');

// Auth Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $request->session()->put('authenticated', true);
    $request->session()->put('name', $request->input('username', 'Siswa'));
    return redirect()->route('dashboard');
})->name('login.submit');

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

// Data Akademik
Route::view('/data-akademik', 'data-akademik.index')->name('data-akademik.index');

// Dummy submit (biar tombol submit tidak error)
Route::post('/data-akademik', function () {
    return redirect()->route('data-akademik.index');
})->name('data-akademik.store');

// Dashboard Routes (untuk nanti)
Route::get('/dashboard', function () {
    if (!session('authenticated')) {
        return redirect()->route('login');
    }
    return view('page.dashboard.index');
})->name('dashboard');