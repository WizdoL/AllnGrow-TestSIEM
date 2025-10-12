<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/teacherDashboard', function () {
        return view('teacherDashboard');
    });

    Route::get('/studentDashboard', function () {
        return view('studentDashboard');
    });
});

Route::post('/login', [LoginController::class, 'postLogin'])->name('postlogin');