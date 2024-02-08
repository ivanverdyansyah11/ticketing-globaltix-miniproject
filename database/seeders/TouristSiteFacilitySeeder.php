<?php

namespace Database\Seeders;

use App\Models\TouristSiteFacility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TouristSiteFacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TouristSiteFacility::create([
            'tourist_sites_id' => 1,
            'facilities_id' => '1,2',
        ]);

        TouristSiteFacility::create([
            'tourist_sites_id' => 2,
            'facilities_id' => '2,3',
        ]);

        TouristSiteFacility::create([
            'tourist_sites_id' => 3,
            'facilities_id' => '1,3',
        ]);

        TouristSiteFacility::create([
            'tourist_sites_id' => 4,
            'facilities_id' => '2,4',
        ]);

        TouristSiteFacility::create([
            'tourist_sites_id' => 5,
            'facilities_id' => '1,5',
        ]);

        TouristSiteFacility::create([
            'tourist_sites_id' => 6,
            'facilities_id' => '1,3',
        ]);

        TouristSiteFacility::create([
            'tourist_sites_id' => 7,
            'facilities_id' => '4,5',
        ]);

        TouristSiteFacility::create([
            'tourist_sites_id' => 8,
            'facilities_id' => '2,3',
        ]);

        TouristSiteFacility::create([
            'tourist_sites_id' => 9,
            'facilities_id' => '1,5',
        ]);

        TouristSiteFacility::create([
            'tourist_sites_id' => 10,
            'facilities_id' => '1,4',
        ]);
    }
}
