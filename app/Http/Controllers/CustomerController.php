<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    public function index() {
        return view('customer.index', [
            'title' => 'Customer Page',
            'customers' => Customer::orderBy('created_at', 'DESC')->paginate(10),
        ]);
    }

    public function detail($id) {
        return view('customer.detail', [
            'title' => 'Customer Page',
            'customer' => Customer::where('id', $id)->first(),
        ]);
    }

    public function create() {
        return view('customer.create', [
            'title' => 'Customer Page',
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
                'address' => 'required',
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
                'role' => 'customer',
            ]);

            $validatedData['users_id'] = User::latest('id')->value('id');

            Customer::create([
                'users_id' => $validatedData['users_id'],
                'name' => $validatedData['name'],
                'phone_number' => $validatedData['phone_number'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'place_of_birth' => $validatedData['place_of_birth'],
                'address' => $validatedData['address'],
            ]);

            return redirect(route('customer'))->with('success', 'Successfully Add New Customer!');

        } catch (\Throwable $th) {
            return redirect(route('customer.create'))->with('failed', 'Failed Add New Customer!');
        }
    }

    public function edit($id) {
        return view('customer.edit', [
            'title' => 'Customer Page',
            'customer' => Customer::where('id', $id)->first(),
        ]);
    }

    public function update(Request $request, $id) {
        $customer = Customer::where('id', $id)->first();
        $user = User::where('id', $customer->users_id)->first();

        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone_number' => 'required|max:13',
                'date_of_birth' => 'required',
                'place_of_birth' => 'required',
                'address' => 'required',
            ]);

            if ($request->file('image')) {
                $path = "assets/images/profile/" . $customer->user->image;
    
                if (File::exists($path)) {
                    File::delete($path);
                }
    
                $image = $request->file('image');
                $imageName = date("Ymdhis") . "_" . $image->getClientOriginalName();
                $image->move(public_path('assets/images/profile/'), $imageName);
                $validatedData['image'] = $imageName;
            } else {
                $validatedData['image'] = $customer->user->image;
            }

            $customer->update([
                'name' => $validatedData['name'],
                'phone_number' => $validatedData['phone_number'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'place_of_birth' => $validatedData['place_of_birth'],
                'address' => $validatedData['address'],
            ]);

            $user->update([
                'email' => $validatedData['email'],
                'image' => $validatedData['image'],
            ]);

            return redirect(route('customer'))->with('success', 'Successfully Update Customer!');

        } catch (\Throwable $th) {
            return redirect(route('customer.edit', $id))->with('failed', 'Failed Update Customer!');
        }
    }

    public function delete($id) {
        $customer = Customer::where('id', $id)->first();
        $user = User::where('id', $customer->users_id)->first();

        try {
            if ($customer->user->image) {
                $path = "assets/images/profile/" . $customer->user->image;
    
                if (File::exists($path)) {
                    File::delete($path);
                }
            }

            $customer->delete();
            $user->delete();

            return redirect(route('customer'))->with('success', 'Successfully Delete Customer!');
        } catch (\Throwable $th) {
            return redirect(route('customer'))->with('failde', 'Failed Delete Customer!');
        }
    }
}
