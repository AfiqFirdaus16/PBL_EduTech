<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataAkademikController;


//AUTH
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');


//DATA AKADEMIK (WAJIB LOGIN)
//Route::middleware(['auth'])->group(function () {
//});
    // halaman input
    Route::view('/data-akademik', 'data-akademik.index')
        ->name('data-akademik.index');

    // simpan data
    Route::post('/data-akademik', [DataAkademikController::class, 'store'])
        ->name('data-akademik.store');

    // edit
    Route::get('/data-akademik/{id}/edit', [DataAkademikController::class, 'edit'])
        ->name('data-akademik.edit');

    // update
    Route::put('/data-akademik/{id}', [DataAkademikController::class, 'update'])
        ->name('data-akademik.update');



//DASHBOARD
Route::view('/dashboard', 'dashboard')->name('dashboard');