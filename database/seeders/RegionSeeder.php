<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Region::create([
            'languages_id' => 1,
            'name' => 'Bali Bliss',
            'description' => 'Discover the enchanting beauty of Bali Bliss, a tropical paradise known for its vibrant culture, stunning beaches, and lush rice terraces.',
        ]);

        Region::create([
            'languages_id' => 3,
            'name' => 'Komodo Kingdom',
            'description' => 'Embark on a journey to Komodo Kingdom, home of the legendary Komodo dragons, where pristine beaches and diverse marine life await.',
        ]);

        Region::create([
            'languages_id' => 2,
            'name' => 'Java Jungle Trek',
            'description' => "Explore the wild side of Java Jungle Trek, an adventure-filled destination boasting ancient temples, dense rainforests, and active volcanoes.",
        ]);

        Region::create([
            'languages_id' => 4,
            'name' => 'Raja Ampat Wonders',
            'description' => 'Dive into the underwater wonders of Raja Ampat, a marine paradise with crystal-clear waters, vibrant coral reefs, and exotic marine species.',
        ]);

        Region::create([
            'languages_id' => 2,
            'name' => 'Yogyakarta Heritage',
            'description' => 'Immerse yourself in the rich heritage of Yogyakarta, a city of ancient temples, royal palaces, and traditional arts, nestled in the heart of Java.',
        ]);
    }
}
