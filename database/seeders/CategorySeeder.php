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
            'name' => 'Cultural Excursion',
            'description' => 'Immerse yourself in the rich traditions and heritage of the region through guided tours, performances, and visits to historical sites.',
        ]);

        Category::create([
            'name' => 'Wildlife Adventure',
            'description' => "Embark on thrilling wildlife encounters and eco-tours, exploring the diverse flora and fauna unique to each region's natural landscapes.",
        ]);

        Category::create([
            'name' => 'Jungle Trekking',
            'description' => 'Unleash your adventurous spirit with jungle treks, discovering hidden waterfalls, ancient temples, and breathtaking scenic viewpoints.',
        ]);

        Category::create([
            'name' => 'Marine Discovery',
            'description' => 'Dive into the vibrant underwater world with snorkeling, scuba diving, and boat tours, exploring the diverse marine life and coral reefs.',
        ]);

        Category::create([
            'name' => 'Wellness Retreat',
            'description' => 'Indulge in relaxation and rejuvenation amidst stunning landscapes, with wellness activities, spa treatments, and serene natural surroundings.',
        ]);
    }
}
