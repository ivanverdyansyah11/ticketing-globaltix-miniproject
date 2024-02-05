<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Staff::create([
            'users_id' => 2,
            'name' => 'Aditya Prayatna',
            'email' => 'adityaprayatna@gmail.com',
            'password' => bcrypt('aditya123'),
            'image' => 'profile-1.jpg',
            'phone_number' => '08123456789',
            'position' => 'Operations Manager',
            'date_of_birth' => '1990-03-07',
            'place_of_birth' => 'Denpasar',
        ]);

        Staff::create([
            'users_id' => 3,
            'name' => 'Ayu Ridiantari',
            'email' => 'ayuridiantari@gmail.com',
            'password' => bcrypt('ayu123'),
            'image' => 'profile-2.jpg',
            'phone_number' => '08987654321',
            'position' => 'Customer Support Specialist',
            'date_of_birth' => '2005-10-21',
            'place_of_birth' => 'Badung',
        ]);
    }
}
