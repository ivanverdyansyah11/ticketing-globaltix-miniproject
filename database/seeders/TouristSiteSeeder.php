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
            'region_categories_id' => 1,
            'name' => 'Uluwatu Temple',
            'description' => 'Perched on a clifftop, Uluwatu Temple in Bali Bliss offers stunning ocean views and traditional Kecak dance performances at sunset.',
        ]);

        TouristSite::create([
            'region_categories_id' => 1,
            'name' => 'Tegallalang Rice Terraces',
            'description' => 'Visit the breathtaking Tegallalang Rice Terraces in Bali Bliss, showcasing intricate rice paddy landscapes against the backdrop of lush greenery.',
        ]);

        TouristSite::create([
            'region_categories_id' => 2,
            'name' => 'Komodo National Park',
            'description' => 'Explore the unique biodiversity of Komodo Kingdom, home to the iconic Komodo dragons and pristine coral reefs perfect for diving and snorkeling.',
        ]);

        TouristSite::create([
            'region_categories_id' => 2,
            'name' => 'Pink Beach',
            'description' => 'Marvel at the natural beauty of Pink Beach in Komodo Kingdom, known for its pink-hued sands and crystal-clear waters ideal for relaxation and swimming.',
        ]);

        TouristSite::create([
            'region_categories_id' => 3,
            'name' => 'Borobudur Temple',
            'description' => "Delve into the cultural richness of Java Jungle Trek with a visit to Borobudur Temple, the world's largest Buddhist temple, adorned with intricate carvings.",
        ]);

        TouristSite::create([
            'region_categories_id' => 3,
            'name' => 'Mount Bromo',
            'description' => 'Experience the awe-inspiring landscapes of Java Jungle Trek by trekking Mount Bromo, an active volcano surrounded by a sea of sand and panoramic vistas.',
        ]);

        TouristSite::create([
            'region_categories_id' => 4,
            'name' => 'Raja Ampat Dive Sites',
            'description' => 'Dive into the underwater wonders of Raja Ampat Wonders, exploring vibrant coral gardens and encountering diverse marine life at renowned dive sites.',
        ]);

        TouristSite::create([
            'region_categories_id' => 4,
            'name' => 'Wayag Islands',
            'description' => 'Discover the stunning beauty of Wayag Islands in Raja Ampat Wonders, featuring turquoise lagoons, limestone karsts, and breathtaking viewpoints.',
        ]);

        TouristSite::create([
            'region_categories_id' => 5,
            'name' => 'Prambanan Temple',
            'description' => 'Immerse yourself in Yogyakarta Heritage by visiting Prambanan Temple, a UNESCO World Heritage site renowned for its intricate Hindu architecture.',
        ]);

        TouristSite::create([
            'region_categories_id' => 5,
            'name' => 'Malioboro Street',
            'description' => 'Experience the vibrant atmosphere of Yogyakarta Heritage with a stroll down Malioboro Street, a bustling market street filled with local crafts and cuisine.',
        ]);
    }
}
