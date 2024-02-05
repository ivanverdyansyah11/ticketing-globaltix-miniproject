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
            'name' => 'Cityville',
            'description' => 'Bustling urban center known for its culture',
        ]);

        Region::create([
            'name' => 'Coastal Haven',
            'description' => 'Serene coastal area with beautiful beaches',
        ]);

        Region::create([
            'name' => 'Mountain Retreat',
            'description' => 'Scenic mountainous region perfect for hiking',
        ]);

        Region::create([
            'name' => 'Historical Hamlet',
            'description' => 'Quaint town rich in history and charm',
        ]);

        Region::create([
            'name' => 'Countryside Oasis',
            'description' => 'Tranquil countryside with rolling landscapes',
        ]);
    }
}
