<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DataPenggunaController;

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

// Rute untuk registrasi dari SIAKAD
Route::get('/register-lanjutan', [App\Http\Controllers\AuthController::class, 'registerLanjutan'])->name('register.lanjutan');
Route::post('/register-lanjutan', [App\Http\Controllers\AuthController::class, 'simpanRegisterLanjutan'])->name('register.lanjutan.simpan');

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

    //Kuis
    Route::get('/kuis', function () {
        return redirect()->route('kuis.show', 1);
    })->name('kuis');

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
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Route::view('/data-pengguna', 'admin.data-pengguna')
        //     ->name('data-pengguna.index');

        Route::view('/hasil-pengguna', 'admin.hasil-pengguna')
            ->name('hasil-pengguna.index');

        Route::get('/data-pengguna/export', [DataPenggunaController::class, 'export'])
            ->name('data-pengguna.export');

        Route::resource('data-pengguna', DataPenggunaController::class)
            ->names('data-pengguna');
    });
