<?php

namespace Database\Seeders;

use App\Models\TouristSite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TouristSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TouristSite::create([
            'region_categories' => 1,
            'name' => 'City Museum',
            'description' => 'Iconic museum showcasing city history',
        ]);

        TouristSite::create([
            'region_categories' => 2,
            'name' => 'Sunset Bay',
            'description' => 'Scenic beach with breathtaking sunset views',
        ]);

        TouristSite::create([
            'region_categories' => 3,
            'name' => 'Pine Peak Trail',
            'description' => 'Picturesque mountain trail for hiking',
        ]);

        TouristSite::create([
            'region_categories' => 4,
            'name' => 'Old Town Square',
            'description' => 'Historic town square with charming architecture',
        ]);

        TouristSite::create([
            'region_categories' => 5,
            'name' => 'Sunflower Fields',
            'description' => 'Countryside fields filled with vibrant sunflowers',
        ]);
    }
}
