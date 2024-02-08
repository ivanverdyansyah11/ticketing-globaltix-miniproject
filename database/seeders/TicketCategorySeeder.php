<?php

namespace Database\Seeders;

use App\Models\TicketCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketCategory::create([
            'name' => 'Standard',
            'description' => 'The Standard Ticket Category offers essential access to our enchanting destinations, providing a gateway to the cultural, natural, and historical wonders that await you.',
        ]);

        TicketCategory::create([
            'name' => 'Package',
            'description' => 'Elevate your journey with the comprehensive Package Ticket Category, designed for travelers who desire a seamless and all-encompassing experience.',
        ]);

        TicketCategory::create([
            'name' => 'VIP',
            'description' => 'Indulge in the epitome of luxury and exclusivity with the VIP Ticket Category, crafted for discerning travelers seeking a premium experience.',
        ]);
    }
}
