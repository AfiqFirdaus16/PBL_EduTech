<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataAkademikController;

Route::get('/login', function () {
    return view('auth.login');
})->name('login');