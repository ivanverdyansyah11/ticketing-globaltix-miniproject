<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'ivanverdyansyah@gmail.com',
            'password' => bcrypt('ivan123'),
            'image' => 'profile-1.jpg',
            'role' => 'super_admin',
        ]);

        User::create([
            'email' => 'adityaprayatna@gmail.com',
            'password' => bcrypt('aditya123'),
            'image' => 'profile-1.jpg',
            'role' => 'staff',
        ]);

        User::create([
            'email' => 'ayuridiantari@gmail.com',
            'password' => bcrypt('ayu123'),
            'image' => 'profile-1.jpg',
            'role' => 'staff',
        ]);

        User::create([
            'email' => 'aguspratama@gmail.com',
            'password' => bcrypt('agus123'),
            'image' => 'profile-1.jpg',
            'role' => 'tourguide',
        ]);

        User::create([
            'email' => 'devinaputri@gmail.com',
            'password' => bcrypt('devina123'),
            'image' => 'profile-1.jpg',
            'role' => 'tourguide',
        ]);

        User::create([
            'email' => 'putrahasan@gmail.com',
            'password' => bcrypt('putra123'),
            'image' => 'profile-1.jpg',
            'role' => 'tourguide',
        ]);

        User::create([
            'email' => 'yogakusuma@gmail.com',
            'password' => bcrypt('yoga123'),
            'image' => 'profile-1.jpg',
            'role' => 'customer',
        ]);

        User::create([
            'email' => 'krisnahartawan@gmail.com',
            'password' => bcrypt('krisna123'),
            'image' => 'profile-1.jpg',
            'role' => 'customer',
        ]);

        User::create([
            'email' => 'aliciasyabana@gmail.com',
            'password' => bcrypt('alicia123'),
            'image' => 'profile-1.jpg',
            'role' => 'customer',
        ]);

        User::create([
            'email' => 'bastiansteel@gmail.com',
            'password' => bcrypt('bastian123'),
            'image' => 'profile-1.jpg',
            'role' => 'admin',
        ]);
    }
}
