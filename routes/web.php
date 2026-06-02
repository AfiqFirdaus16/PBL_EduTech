<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataAkademikController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeknikBelajarController;
use App\Http\Controllers\AnalisaController;
use App\Http\Controllers\KuisController;

// AUTH (tidak perlu login)
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::get('/logout', function (Request $request) {
    $request->session()->flush();
    return redirect()->route('login'); // ← diperbaiki, sebelumnya 'landing' tidak ada
})->name('logout');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// FORGOT & RESET PASSWORD
Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');


//landing page 
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/reAnalisa', function () {
    return view('page.reAnalisa');  
    })->name('reAnalisa');


// ROUTE SISWA (wajib login + role siswa)
Route::middleware(['auth', 'user'])->group(function () {

    // Dashboard
    //Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Data Akademik
    // Route::view('/data-akademik', 'data-akademik.index')->name('data-akademik.index');
    // Route::post('/data-akademik', [DataAkademikController::class, 'store'])->name('data-akademik.store');
    // Route::get('/data-akademik/{id}/edit', [DataAkademikController::class, 'edit'])->name('data-akademik.edit');
    // Route::put('/data-akademik/{id}', [DataAkademikController::class, 'update'])->name('data-akademik.update');
});
    // Halaman Siswa
    Route::get('/hasil-resiko', fn() => view('siswa.hasil-resiko'))->name('hasil-resiko.index');
    Route::get('/riwayat', fn() => view('siswa.riwayat'))->name('riwayat.index');
    Route::get('/kuis', fn() => view('page.kuis'))->name('kuis');
    Route::get('/hasil', fn() => view('page.hasil'))->name('hasil');
    
    // Teknik Belajar
    Route::get('/teknik-belajar', [TeknikBelajarController::class, 'index'])->name('teknik-belajar.index');
    Route::get('/teknik-belajar/teknik-belajar', [TeknikBelajarController::class, 'teknikBelajar'])->name('teknik-belajar.teknikBelajar');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::view('/dashboard', 'admin.dashboard-admin')->name('dashboard');
        Route::view('/data-pengguna', 'admin.data-pengguna')->name('data-pengguna.index');
        Route::view('/hasil-pengguna', 'admin.hasil-pengguna')->name('hasil-pengguna.index');
    });

// ── Kuis ─────────────────────────────────────────────────────────
// Redirect root ke step 1
Route::get('/kuis', fn() => redirect()->route('kuis.show', 1));
 
// Tampilkan halaman kuis per step (1–5)
Route::get('/kuis/{step}', [KuisController::class, 'show'])
    ->name('kuis.show')
    ->where('step', '[1-5]');
 
// Simpan jawaban per step
Route::post('/kuis/{step}', [KuisController::class, 'store'])
    ->name('kuis.store')
    ->where('step', '[1-5]');
 
// Halaman hasil akhir
Route::get('/kuis/hasil', [KuisController::class, 'hasil'])
    ->name('kuis.hasil');