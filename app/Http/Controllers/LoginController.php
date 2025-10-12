<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Prevent session fixation
            $request->session()->regenerate();

            $user = Auth::user();
            // If user has an intended URL (tried to access a protected route), redirect there
            $intended = redirect()->intended();

            if ($user->level === 'teacher') {
                return $intended->getTargetUrl() ? $intended : redirect('/teacherDashboard');
            } elseif ($user->level === 'student') {
                return $intended->getTargetUrl() ? $intended : redirect('/studentDashboard');
            } else {
                Auth::logout();
                return redirect()->route('login')->withErrors(['level' => 'Invalid user level.']);
            }
        }

        return redirect()->route('login')->withErrors(['email' => 'Invalid credentials.'])->withInput($request->only('email'));
    }
}
