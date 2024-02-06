<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class StaffController extends Controller
{
    public function index() : View {
        return view('staff.index', [
            'title' => 'Staff Page',
            'staffs' => Staff::orderBy('created_at', 'DESC')->paginate(10),
        ]);
    }

    public function detail($id) : View {
        return view('staff.detail', [
            'title' => 'Staff Page',
            'staff' => Staff::where('id', $id)->first(),
        ]);
    }

    public function create() : View {
        return view('staff.create', [
            'title' => 'Staff Page',
        ]);
    }

    public function store(Request $request) : RedirectResponse {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required|min:3|max:100',
                'image' => 'required|file|image|mimes:png,jpg,jpeg,gif,svg,webp|max:2000',
                'phone_number' => 'required|max:13',
                'position' => 'required|max:50',
                'date_of_birth' => 'required',
                'place_of_birth' => 'required',
            ]);

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
                'role' => 'staff',
            ]);

            $validatedData['users_id'] = User::latest('id')->value('id');

            Staff::create([
                'users_id' => $validatedData['users_id'],
                'name' => $validatedData['name'],
                'phone_number' => $validatedData['phone_number'],
                'position' => $validatedData['position'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'place_of_birth' => $validatedData['place_of_birth'],
            ]);

            return redirect(route('staff'))->with('success', 'Successfully Add New Staff!');

        } catch (\Throwable $th) {
            return redirect(route('staff.create'))->with('failed', 'Failed Add New Staff!');
        }
    }

    public function edit($id) : View {
        return view('staff.edit', [
            'title' => 'Staff Page',
            'staff' => Staff::where('id', $id)->first(),
        ]);
    }

    public function update(Request $request, $id) : RedirectResponse {
        $staff = Staff::where('id', $id)->first();
        $user = User::where('id', $staff->users_id)->first();

        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone_number' => 'required|max:13',
                'date_of_birth' => 'required',
                'place_of_birth' => 'required',
            ]);

            if ($request->file('image')) {
                $path = "assets/images/profile/" . $staff->user->image;
    
                if (File::exists($path)) {
                    File::delete($path);
                }
    
                $image = $request->file('image');
                $imageName = date("Ymdhis") . "_" . $image->getClientOriginalName();
                $image->move(public_path('assets/images/profile/'), $imageName);
                $validatedData['image'] = $imageName;
            } else {
                $validatedData['image'] = $staff->user->image;
            }

            $staff->update([
                'name' => $validatedData['name'],
                'phone_number' => $validatedData['phone_number'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'place_of_birth' => $validatedData['place_of_birth'],
            ]);

            $user->update([
                'email' => $validatedData['email'],
                'image' => $validatedData['image'],
            ]);

            return redirect(route('staff'))->with('success', 'Successfully Update Staff!');

        } catch (\Throwable $th) {
            return redirect(route('staff.edit', $id))->with('failed', 'Failed Update Staff!');
        }
    }

    public function delete($id) : RedirectResponse {
        $staff = Staff::where('id', $id)->first();
        $user = User::where('id', $staff->users_id)->first();

        try {
            if ($staff->user->image) {
                $path = "assets/images/profile/" . $staff->user->image;
    
                if (File::exists($path)) {
                    File::delete($path);
                }
            }

            $staff->delete();
            $user->delete();

            return redirect(route('staff'))->with('success', 'Successfully Delete Staff!');
        } catch (\Throwable $th) {
            return redirect(route('staff'))->with('failde', 'Failed Delete Staff!');
        }
    }
}
