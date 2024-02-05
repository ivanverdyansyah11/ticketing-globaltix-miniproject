<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'users_id' => 1,
            'name' => 'Ivan Verdyansyah',
            'email' => 'ivanverdyansyah@gmail.com',
            'password' => bcrypt('ivan123'),
            'image' => 'profile-3.jpg',
            'phone_number' => '081238484005',
            'date_of_birth' => '2005-03-09',
            'place_of_birth' => 'Denpasar',
        ]);
    }
}
