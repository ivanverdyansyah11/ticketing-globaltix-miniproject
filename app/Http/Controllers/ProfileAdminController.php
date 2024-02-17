<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfileAdminController extends Controller
{
    public function index() : View {
        if(auth()->user()->role == 'super admin') {
            $profile = User::where('id', auth()->user()->id)->first();
        } elseif (auth()->user()->role == 'admin') {
            $profile = Admin::with('user')->where('users_id', auth()->user()->id)->first();
        }
        return view('profile.index', [
            'title' => 'Profile Page',
            'profile' => $profile,
        ]);
    }

    public function edit() : View {
        if(auth()->user()->role == 'super admin') {
            $profile = User::where('id', auth()->user()->id)->first();
        } elseif (auth()->user()->role == 'admin') {
            $profile = Admin::with('user')->where('users_id', auth()->user()->id)->first();
        };
        return view('profile.edit', [
            'title' => 'Profile Page',
            'profile' => $profile,
        ]);
    }

    public function update(Request $request) : RedirectResponse {
        $profile = Admin::where('users_id', auth()->user()->id)->first();
        dd($profile);
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:100',
                'password' => 'nullable',
                'phone_number' => 'nullable|string',
                'place_of_birth' => 'nullable|string',
                'date_of_birth' => 'nullable',
            ]);

            if ($validatedData['password']) {
                $validatedData['password'] = bcrypt($validatedData['password']);
            }

            if ($request->file('image')) {
                $path = "assets/images/profile/" . $profile->image;
    
                if (File::exists($path)) {
                    File::delete($path);
                }
    
                $image = $request->file('image');
                $imageName = date("Ymdhis") . "_" . $image->getClientOriginalName();
                $image->move(public_path('assets/images/profile/'), $imageName);
                $validatedData['image'] = $imageName;
            } else {
                $validatedData['image'] = $profile->image;
            }

            $profile->update($validatedData);
            return redirect(route('profile'))->with('success', 'Successfully Update Profile!');
        } catch (\Throwable $th) {
            return redirect(route('profile'))->with('failed', 'Failed Update Profile!');
        }
    }
}
