<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function login() : View {
        return view('auth.login', [
            'title' => 'Login Page'
        ]);
    }

    public function authenticate(Request $request) : RedirectResponse {
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

    public function logout(Request $request) : RedirectResponse {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'))->with('success', 'Successfully Logout Account!');
    }
}
