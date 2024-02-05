<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'City Exploration',
            'description' => 'Explore urban centers and cultural landmarks',
        ]);

        Category::create([
            'name' => 'Nature Adventure',
            'description' => 'Discover natural landscapes and outdoor activities',
        ]);

        Category::create([
            'name' => 'Cultural Heritage',
            'description' => 'Immerse in local history and traditions',
        ]);

        Category::create([
            'name' => 'Relaxation & Leisure',
            'description' => 'Unwind in scenic locations with leisurely activities',
        ]);

        Category::create([
            'name' => 'Thrilling Expeditions',
            'description' => 'Embark on adventurous and adrenaline-pumping experiences',
        ]);
    }
}
