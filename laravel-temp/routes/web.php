<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('mahasiswa.dashboard');
});

Route::get('/admin/dashboard', [
    AdminController::class,
    'dashboard'
]);