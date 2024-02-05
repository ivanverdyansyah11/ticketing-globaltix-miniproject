<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index() {
        return view('staff.index', [
            'title' => 'Staff Page',
            'staff' => Staff::orderBy('created_at', 'DESC')->paginate(10),
        ]);
    }

    public function detail($id) {
        return view('staff.detail', [
            'title' => 'Staff Page',
            'staff' => Staff::where('id', $id)->first(),
        ]);
    }

    public function create() {
        return view('staff.create', [
            'title' => 'Staff Page',
        ]);
    }

    public function store(Request $request) {
        return $request;
    }

    public function edit($id) {
        return view('staff.edit', [
            'title' => 'Staff Page',
            'staff' => Staff::where('id', $id)->first(),
        ]);
    }

    public function update(Request $request) {
        return $request;
    }

    public function delete(Request $request) {
        return $request;
    }
}
