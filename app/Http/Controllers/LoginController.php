<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function postLogin(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Attempt to authenticate the user
        if (auth()->attempt($request->only('email', 'password'))) {
            // Authentication passed, redirect based on user level
            $user = auth()->user();
            if ($user->level === 'teacher') {
                return redirect('/teacherDashboard');
            } elseif ($user->level === 'student') {
                return redirect('/studentDashboard');
            } else {
                auth()->logout();
                return redirect('/login')->withErrors(['level' => 'Invalid user level.']);
            }
        }

        // Authentication failed, redirect back with error
        return redirect('/login')->withErrors(['email' => 'Invalid credentials.'])->withInput();

    }
}
