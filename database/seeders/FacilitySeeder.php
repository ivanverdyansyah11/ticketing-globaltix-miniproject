<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Facility::create([
            'name' => 'Guided Tours',
            'description' => 'Knowledgeable guides provide insightful tours, sharing the cultural and historical significance of the region.',
        ]);

        Facility::create([
            'name' => 'Wildlife Viewing',
            'description' => 'Purpose-built platforms and tours offer close encounters with unique wildlife species in their natural habitats.',
        ]);

        Facility::create([
            'name' => 'Adventure Gear Rental',
            'description' => 'Equip yourself for jungle treks or marine adventures with rental services offering gear like snorkeling and hiking equipment.',
        ]);

        Facility::create([
            'name' => 'Scenic Boat Cruises',
            'description' => 'Relax and enjoy the picturesque landscapes on guided boat cruises, exploring coastal wonders and hidden gems.',
        ]);

        Facility::create([
            'name' => 'Spa and Wellness Center',
            'description' => 'Unwind in luxurious spa facilities, offering massages, yoga sessions, and wellness treatments amidst serene surroundings.',
        ]);
    }
}
