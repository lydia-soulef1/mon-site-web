<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Assuming "User" model is used for both parents and pediatricians
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login request
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        // Log the attempt for debugging
        Log::info('Login attempt', $credentials);

        // Attempt to log in using the default guard (from the 'users' table)
        if (Auth::attempt($credentials)) {
            // Authentication passed, get the logged-in user
            $user = Auth::user();

            // Redirect to the welcome route
            return redirect()->route('welcome');
        }


        // Log failed attempt
        Log::error('Failed login attempt for email: ' . $credentials['email']);

        // Return back with an error if login failed
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session and regenerate the token for security
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
