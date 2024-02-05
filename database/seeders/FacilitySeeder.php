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
            'name' => 'Adventure Gear Rental',
            'description' => 'Rent equipment for outdoor adventures',
        ]);

        Facility::create([
            'name' => 'Water Sports Center',
            'description' => 'Offers water sports activities and rentals',
        ]);

        Facility::create([
            'name' => 'Spa and Wellness Center',
            'description' => 'Relaxation and rejuvenation facilities',
        ]);

        Facility::create([
            'name' => 'Historic Hotel',
            'description' => 'Charming hotel with historical significance',
        ]);

        Facility::create([
            'name' => 'Gourmet Dining Hall',
            'description' => 'Culinary experience with local and global flavors',
        ]);
    }
}
