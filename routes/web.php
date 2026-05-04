<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataAkademikController;

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');