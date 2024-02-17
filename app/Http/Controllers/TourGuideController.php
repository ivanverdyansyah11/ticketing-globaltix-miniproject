<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\TourGuide;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class TourGuideController extends Controller
{
    public function index() : View {
        return view('tourguide.index', [
            'title' => 'Tour Guide Page',
            'tourguides' => TourGuide::orderBy('created_at', 'DESC')->paginate(10),
            'languages' => Language::all(),
        ]);
    }

    public function detail($id) : View {
        return view('tourguide.detail', [
            'title' => 'Tour Guide Page',
            'tourguide' => TourGuide::where('id', $id)->first(),
            'languages' => Language::all(),
        ]);
    }

    public function create() : View {
        return view('tourguide.create', [
            'title' => 'Tour Guide Page',
            'languages' => Language::all(),
        ]);
    }

    public function store(Request $request) : RedirectResponse {
        try {
            $validatedData = $request->validate([
                'languages_id' => 'required',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required|min:3|max:100',
                'image' => 'required|file|image|mimes:png,jpg,jpeg,gif,svg,webp|max:2000',
                'phone_number' => 'required|max:13',
                'date_of_birth' => 'required',
                'place_of_birth' => 'required',
                'status' => 'required|integer',
            ]);
            $validatedData['languages_id'] = implode(',', $validatedData['languages_id']);

            if (!empty($request->image)) {
                $image = $request->file('image');
                $imageName = date("Ymdhis") . "_" . $image->getClientOriginalName();
                $image->move(public_path('assets/images/profile/'), $imageName);
                $validatedData['image'] = $imageName;
            }

            User::create([
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'image' => $validatedData['image'],
                'role' => 'tourguide',
            ]);

            $validatedData['users_id'] = User::latest('id')->value('id');

            TourGuide::create([
                'languages_id' => $validatedData['languages_id'],
                'users_id' => $validatedData['users_id'],
                'name' => $validatedData['name'],
                'phone_number' => $validatedData['phone_number'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'place_of_birth' => $validatedData['place_of_birth'],
                'status' => $validatedData['status'],
            ]);

            return redirect(route('tourguide'))->with('success', 'Successfully Add New Tour Guide!');

        } catch (\Throwable $th) {
            return redirect(route('tourguide.create'))->with('failed', 'Failed Add New Tour Guide!');
        }
    }

    public function edit($id) : View {
        return view('tourguide.edit', [
            'title' => 'Tour Guide Page',
            'tourguide' => TourGuide::where('id', $id)->first(),
            'languages' => Language::all(),
        ]);
    }

    public function update(Request $request, $id) : RedirectResponse {
        $tourguide = TourGuide::where('id', $id)->first();
        $user = User::where('id', $tourguide->users_id)->first();

        try {
            $validatedData = $request->validate([
                'languages_id' => 'required',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone_number' => 'required|max:13',
                'date_of_birth' => 'required',
                'place_of_birth' => 'required',
                'status' => 'required|integer',
            ]);
            $validatedData['languages_id'] = implode(',', $validatedData['languages_id']);

            if ($request->file('image')) {
                $path = "assets/images/profile/" . $tourguide->user->image;
    
                if (File::exists($path)) {
                    File::delete($path);
                }
    
                $image = $request->file('image');
                $imageName = date("Ymdhis") . "_" . $image->getClientOriginalName();
                $image->move(public_path('assets/images/profile/'), $imageName);
                $validatedData['image'] = $imageName;
            } else {
                $validatedData['image'] = $tourguide->user->image;
            }

            $tourguide->update([
                'languages_id' => $validatedData['languages_id'],
                'name' => $validatedData['name'],
                'phone_number' => $validatedData['phone_number'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'place_of_birth' => $validatedData['place_of_birth'],
                'status' => $validatedData['status'],
            ]);

            $user->update([
                'email' => $validatedData['email'],
                'image' => $validatedData['image'],
            ]);

            return redirect(route('tourguide'))->with('success', 'Successfully Update Tour Guide!');

        } catch (\Throwable $th) {
            return redirect(route('tourguide.edit', $id))->with('failed', 'Failed Update Tour Guide!');
        }
    }

    public function delete($id) : RedirectResponse {
        $tourguide = TourGuide::where('id', $id)->first();
        $user = User::where('id', $tourguide->users_id)->first();

        try {
            if ($tourguide->user->image) {
                $path = "assets/images/profile/" . $tourguide->user->image;
    
                if (File::exists($path)) {
                    File::delete($path);
                }
            }

            $tourguide->delete();
            $user->delete();

            return redirect(route('tourguide'))->with('success', 'Successfully Delete Tour Guide!');
        } catch (\Throwable $th) {
            return redirect(route('tourguide'))->with('failde', 'Failed Delete Tour Guide!');
        }
    }
}
