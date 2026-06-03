<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeknikBelajarController;
use App\Http\Controllers\KuisController;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome')->name('welcome');

Route::view('/reAnalisa', 'page.reAnalisa')
    ->name('reAnalisa');


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::view('/login', 'auth.login')
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

    Route::view('/register', 'auth.register')
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.process');

    // Forgot Password
    Route::view('/forgot-password', 'auth.forgot-password')
        ->name('password.request');

    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
        ->name('password.email');

    Route::get('/reset-password/{token}', function ($token) {
        return view('auth.reset-password', compact('token'));
    })->name('password.reset');

    Route::post('/reset-password', [AuthController::class, 'resetPassword'])
        ->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Siswa
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'user'])->group(function () {

    // Kuis
    Route::get('/kuis', function () {
        return redirect()->route('kuis.show', 1);
    });

    Route::view('/kuis', 'kuis')->name('kuis');

    Route::get('/kuis/{step}', [KuisController::class, 'show'])
        ->where('step', '[1-5]')
        ->name('kuis.show');

    Route::post('/kuis/{step}', [KuisController::class, 'store'])
        ->where('step', '[1-5]')
        ->name('kuis.store');

    Route::get('/kuis/hasil', [KuisController::class, 'hasil'])
        ->name('kuis.hasil');

    // Hasil Analisa
    Route::view('/hasil-resiko', 'siswa.hasil-resiko')
        ->name('hasil-resiko.index');

    Route::view('/riwayat', 'siswa.riwayat')
        ->name('riwayat.index');

    Route::view('/hasil', 'page.hasil')
        ->name('hasil');

    // Teknik Belajar
    Route::get('/teknik-belajar', [TeknikBelajarController::class, 'index'])
        ->name('teknik-belajar.index');

    Route::get('/teknik-belajar/detail', [TeknikBelajarController::class, 'teknikBelajar'])
        ->name('teknik-belajar.detail');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');
});


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::view('/dashboard', 'admin.dashboard-admin')
            ->name('dashboard');

        Route::view('/data-pengguna', 'admin.data-pengguna')
            ->name('data-pengguna.index');

        Route::view('/hasil-pengguna', 'admin.hasil-pengguna')
            ->name('hasil-pengguna.index');
    });