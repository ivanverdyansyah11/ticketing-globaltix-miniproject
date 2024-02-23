<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Staff;
use App\Models\TourGuide;
use App\Models\User;
use App\Repositories\LanguageRepositories;
use App\Repositories\ProfileRepositories;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(
        protected readonly ProfileRepositories $profile,
        protected readonly LanguageRepositories $language,
    ) {}

    public function index() : View {
        return view('profile.index', [
            'title' => 'Profile Page',
            'profile' => $this->profile->findById(auth()->user()->id),
            'languages' => $this->language->findAll(),
        ]);
    }

    public function edit() : View {
        return view('profile.edit', [
            'title' => 'Profile Page',
            'profile' => $this->profile->findById(auth()->user()->id),
            'languages' => $this->language->findAll(),
        ]);
    }

    public function update(Request $request) {
        try {
            $user = User::where('id', auth()->user()->id)->first();

            if(auth()->user()->role == 'admin') {
                $profile = Admin::with('user')->where('users_id', auth()->user()->id)->first();
            } elseif(auth()->user()->role == 'staff') {
                $profile = Staff::with('user')->where('users_id', auth()->user()->id)->first();
            } elseif(auth()->user()->role == 'tourguide') {
                $profile = TourGuide::with('user')->where('users_id', auth()->user()->id)->first();
            } else {
                $profile = Customer::with('user')->where('users_id', auth()->user()->id)->first();
            };

            $validatedData = $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'nullable|min:3|max:100',
                'image' => 'nullable|file|image|mimes:png,jpg,jpeg,gif,svg,webp|max:2000',
                'phone_number' => 'nullable|max:13',
                'date_of_birth' => 'nullable',
                'place_of_birth' => 'nullable',
                'address' => 'nullable',
                'position' => 'nullable',
                'languages_id' => 'nullable',
            ]);

            if (!empty($request->password)) {
                $validatedData['password'] = bcrypt($validatedData['password']);
            } else {
                $validatedData['password'] = $user->password;
            }

            if (!empty($request->image)) {
                $image = $request->file('image');
                $imageName = date("Ymdhis") . "_" . $image->getClientOriginalName();
                $image->move(public_path('assets/images/profile/'), $imageName);
                $validatedData['image'] = $imageName;
            } else {
                $validatedData['image'] = $user->image;
            }

            $user->update([
                'email' => $validatedData['email'],
                'password' => $validatedData['password'],
                'image' => $validatedData['image'],
            ]);

            if ($user->role != 'super_admin') {
                $profile->update([
                    'name' => $validatedData['name'],
                    'phone_number' => $validatedData['phone_number'],
                    'date_of_birth' => $validatedData['date_of_birth'],
                    'place_of_birth' => $validatedData['place_of_birth'],
                ]);
            }
            
            if ($user->role == 'staff') {
                $profile->update([
                    'position' => $validatedData['position'],
                ]);
            } elseif($user->role == 'tourguide') {
                $validatedData['languages_id'] = implode(',', $validatedData['languages_id']);
                $profile->update([
                    'languages_id' => $validatedData['languages_id'],
                ]);
            } elseif($user->role == 'customer') {
                $profile->update([
                    'address' => $validatedData['address'],
                ]);
            }

            return redirect(route('profile'))->with('success', 'Successfully Add New Profile!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('profile'))->with('failed', 'Failed Add New Profile!');
        }
    }
}
