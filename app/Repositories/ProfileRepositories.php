<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Admin;
use App\Models\Staff;
use App\Models\TourGuide;
use App\Models\Customer;

class ProfileRepositories
{
  public function __construct(
    protected readonly User $user,
    protected readonly Admin $admin,
    protected readonly Staff $staff,
    protected readonly TourGuide $tourguide,
    protected readonly Customer $customer,
  ) {}

  public function findById(int $user_id): user
  {
    if (auth()->user()->role == 'super_admin') {
        $profile = User::where('id', $user_id)->first();
    } elseif(auth()->user()->role == 'admin') {
        $profile = Admin::with('user')->where('users_id', $user_id)->first();
    } elseif(auth()->user()->role == 'staff') {
        $profile = Staff::with('user')->where('users_id', $user_id)->first();
    } elseif(auth()->user()->role == 'tourguide') {
        $profile = TourGuide::with('user')->where('users_id', $user_id)->first();
    } else {
        $profile = Customer::with('user')->where('users_id', $user_id)->first();
    };
    return $profile;
  }

  public function update($request, $user): bool
  {
    return $user->update($request);
  }
}