<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::middleware('web')->group(function () {
    Route::get('/', function () {
        return view('landing');
    })->name('home');

    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::get('/about', function () {
        return view('about');
    })->name('about');
    
    Route::get('/register', function () {
        return view('register');
    });
    
    // Authentication form handlers
    Route::post('/login', [LoginController::class, 'postLogin'])->name('postlogin');
    Route::post('/logout', function (\Illuminate\Http\Request $request) {
        \Illuminate\Support\Facades\Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/teacherDashboard', function () {
        return view('teacherDashboard');
    });

    Route::get('/studentDashboard', function () {
        return view('studentDashboard');
    });
});
