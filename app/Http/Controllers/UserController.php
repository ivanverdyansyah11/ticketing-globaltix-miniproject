<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login() {
        return view('auth.login', [
            'title' => 'Login Page'
        ]);
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:3',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        } else {
            return redirect(route('login'))->with('failed', "Email or Password Not Found!");
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'))->with('success', 'Successfully Logout Account!');
    }
}
