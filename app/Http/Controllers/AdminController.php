<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index', [
            'title' => 'Admin Page',
            'admins' => Admin::orderBy('created_at', 'DESC')->paginate(10),
        ]);
    }

    public function detail($id) {
        return view('admin.detail', [
            'title' => 'Admin Page',
            'admin' => Admin::where('id', $id)->first(),
        ]);
    }

    public function create() {
        return view('admin.create', [
            'title' => 'Admin Page',
        ]);
    }

    public function store(Request $request) {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required|min:3|max:100',
                'image' => 'required|file|image|mimes:png,jpg,jpeg,gif,svg,webp|max:2000',
                'phone_number' => 'required|max:13',
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
                'role' => 'admin',
            ]);

            $validatedData['users_id'] = User::latest('id')->value('id');

            Admin::create([
                'users_id' => $validatedData['users_id'],
                'name' => $validatedData['name'],
                'phone_number' => $validatedData['phone_number'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'place_of_birth' => $validatedData['place_of_birth'],
            ]);

            return redirect(route('admin'))->with('success', 'Successfully Add New Admin!');

        } catch (\Throwable $th) {
            return redirect(route('admin.create'))->with('failed', 'Failed Add New Admin!');
        }
    }

    public function edit($id) {
        return view('admin.edit', [
            'title' => 'Admin Page',
            'admin' => Admin::where('id', $id)->first(),
        ]);
    }

    public function update(Request $request, $id) {
        $admin = Admin::where('id', $id)->first();
        $user = User::where('id', $admin->users_id)->first();

        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone_number' => 'required|max:13',
                'date_of_birth' => 'required',
                'place_of_birth' => 'required',
            ]);

            if ($request->file('image')) {
                $path = "assets/images/profile/" . $admin->user->image;
    
                if (File::exists($path)) {
                    File::delete($path);
                }
    
                $image = $request->file('image');
                $imageName = date("Ymdhis") . "_" . $image->getClientOriginalName();
                $image->move(public_path('assets/images/profile/'), $imageName);
                $validatedData['image'] = $imageName;
            } else {
                $validatedData['image'] = $admin->user->image;
            }

            $admin->update([
                'name' => $validatedData['name'],
                'phone_number' => $validatedData['phone_number'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'place_of_birth' => $validatedData['place_of_birth'],
            ]);

            $user->update([
                'email' => $validatedData['email'],
                'image' => $validatedData['image'],
            ]);

            return redirect(route('admin'))->with('success', 'Successfully Update Admin!');

        } catch (\Throwable $th) {
            return redirect(route('admin.edit', $id))->with('failed', 'Failed Update Admin!');
        }
    }

    public function delete($id) {
        $admin = Admin::where('id', $id)->first();
        $user = User::where('id', $admin->users_id)->first();

        try {
            if ($admin->user->image) {
                $path = "assets/images/profile/" . $admin->user->image;
    
                if (File::exists($path)) {
                    File::delete($path);
                }
            }

            $admin->delete();
            $user->delete();

            return redirect(route('admin'))->with('success', 'Successfully Delete Admin!');
        } catch (\Throwable $th) {
            return redirect(route('admin'))->with('failde', 'Failed Delete Admin!');
        }
    }
}
