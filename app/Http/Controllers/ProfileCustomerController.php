<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileCustomerController extends Controller
{
    public function index() {
        // if(auth()->user()->role == 'super admin') {
        //     $profile = User::where('id', auth()->user()->id)->first();
        // } elseif (auth()->user()->role == 'admin') {
        //     $profile = Admin::with('user')->where('users_id', auth()->user()->id)->first();
        // }
        // return view('profile.index', [
        //     'title' => 'Profile Page',
        //     'profile' => $profile,
        // ]);

        dd('123');
    }
}
