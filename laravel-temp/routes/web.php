<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('mahasiswa.dashboard');
});

Route::get('/admin/dashboard', [
    AdminController::class,
    'dashboard'
]);

Route::resource('users', UserController::class);