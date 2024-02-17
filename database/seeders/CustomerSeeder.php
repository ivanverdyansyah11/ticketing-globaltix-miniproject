<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'users_id' => 7,
            'name' => 'Yoga Kusuma',
            'phone_number' => '08234354564',
            'date_of_birth' => '2003-04-23',
            'place_of_birth' => 'Gilimanuk',
            'address' => 'Jl. Ahmad Yani',
            'status' => 1,
        ]);

        Customer::create([
            'users_id' => 8,
            'name' => 'Krisna Hartawan',
            'phone_number' => '085465465675',
            'date_of_birth' => '2001-07-15',
            'place_of_birth' => 'Negara',
            'address' => 'Jl. Monang Maning',
            'status' => 1,
        ]);

        Customer::create([
            'users_id' => 9,
            'name' => 'Alicia Syabana',
            'phone_number' => '0812343546765',
            'date_of_birth' => '2001-10-12',
            'place_of_birth' => 'Denpasar',
            'address' => 'Jl. Dalung Permai',
            'status' => 1,
        ]);
    }
}
