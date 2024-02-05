<?php

namespace Database\Seeders;

use App\Models\RegionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RegionCategory::create([
            'regions_id' => 1,
            'categories_id' => '[1, 2]',
        ]);

        RegionCategory::create([
            'regions_id' => 2,
            'categories_id' => '[2, 3]',
        ]);

        RegionCategory::create([
            'regions_id' => 3,
            'categories_id' => '[3, 4]',
        ]);

        RegionCategory::create([
            'regions_id' => 4,
            'categories_id' => '[4, 5]',
        ]);

        RegionCategory::create([
            'regions_id' => 5,
            'categories_id' => '[1, 5]',
        ]);
    }
}
