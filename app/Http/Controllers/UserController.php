<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticationRequest;
use App\Http\Requests\StoreRegisterRequest;
use App\Models\Customer;
use App\Models\TourGuide;
use App\Models\User;
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

    public function authenticate(AuthenticationRequest $request) : RedirectResponse {
        try {
            if (Auth::attempt($request->except(['_token']))) {
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard'));
            }
            return redirect(route('login'))->with('failed', "Email or Password Not Found!");
        } catch (\Throwable $th) {
            return redirect(route('login'))->with('failed', "Email or Password Not Found!");
        }
    }

    public function register() : View {
        return view('auth.register', [
            'title' => 'Register Page'
        ]);
    }

    public function store(StoreRegisterRequest $request) : RedirectResponse {
        try {
            User::create($request->except(['name']));
            $request['users_id'] = User::latest('id')->value('id');
            if ($request->role == 'tourguide') {
                TourGuide::create($request->only('users_id', 'name'));
            } else {
                Customer::create($request->only('users_id', 'name'));
            }
            
            return redirect(route('login'))->with('success', "Successfully Create New Account!");
        } catch (\Throwable $th) {
            return redirect(route('register'))->with('failed', "Email or Password Not Found!");
        }
    }

    public function logout(Request $request) : RedirectResponse {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'))->with('success', 'Successfully Logout Account!');
    }
}
