<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class LoginController extends Controller
{
    // Method to show the login form
    public function showLoginForm()
    {
        return view('login');
    }

    // Method to handle the login process
    public function login(Request $request)
    {
        // Validate the input data
        $credentials = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate with email
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            // Authentication passed
            return redirect()->intended('master'); // Change 'master' to the desired route after successful login
        }

        // Attempt to authenticate with username
        if (Auth::attempt(['name' => $credentials['email'], 'password' => $credentials['password']])) {
            // Authentication passed
            return redirect()->intended('master'); // Change 'master' to the desired route after successful login
        }

        // Authentication failed
        return redirect()->back()->withErrors(['email' => 'Email/username or password is incorrect']);
    }
}
