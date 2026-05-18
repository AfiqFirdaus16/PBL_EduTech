<?php

namespace App\Http\Controllers;

class TeknikBelajarController extends Controller
{
    public function index()
    {
        return view('siswa.teknik-belajar.index');
    }
}