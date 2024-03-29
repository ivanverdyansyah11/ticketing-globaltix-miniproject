<?php

namespace Database\Seeders;

use App\Models\TourGuide;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourGuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TourGuide::create([
            'users_id' => 4,
            'languages_id' => '1,2',
            'name' => 'Agus Pratama',
            'phone_number' => '087567686734',
            'date_of_birth' => '2004-02-17',
            'place_of_birth' => 'Tabanan',
            'status' => 1,
        ]);

        TourGuide::create([
            'users_id' => 5,
            'languages_id' => '2,3',
            'name' => 'Devina Putri',
            'phone_number' => '088765756756',
            'date_of_birth' => '2006-08-28',
            'place_of_birth' => 'Klungkung',
            'status' => 1,
        ]);

        TourGuide::create([
            'users_id' => 6,
            'languages_id' => '1,4',
            'name' => 'Putra Hasan',
            'phone_number' => '0898756y56756',
            'date_of_birth' => '2002-11-12',
            'place_of_birth' => 'Karangasem',
            'status' => 1,
        ]);
    }
}
