<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::create([
            'tourist_site_facilities_id' => 1,
            'ticket_categories_id' => 1,
            'price' => 50000,
            'stock_per_day' => 100,
        ]);

        Ticket::create([
            'tourist_site_facilities_id' => 1,
            'ticket_categories_id' => 2,
            'price' => 120000,
            'stock_per_day' => 50,
        ]);

        Ticket::create([
            'tourist_site_facilities_id' => 1,
            'ticket_categories_id' => 3,
            'price' => 200000,
            'stock_per_day' => 20,
        ]);

        Ticket::create([
            'tourist_site_facilities_id' => 2,
            'ticket_categories_id' => 2,
            'price' => 100000,
            'stock_per_day' => 80,
        ]);

        Ticket::create([
            'tourist_site_facilities_id' => 2,
            'ticket_categories_id' => 3,
            'price' => 180000,
            'stock_per_day' => 40,
        ]);

        Ticket::create([
            'tourist_site_facilities_id' => 3,
            'ticket_categories_id' => 1,
            'price' => 200000,
            'stock_per_day' => 50,
        ]);

        Ticket::create([
            'tourist_site_facilities_id' => 3,
            'ticket_categories_id' => 3,
            'price' => 250000,
            'stock_per_day' => 30,
        ]);

        Ticket::create([
            'tourist_site_facilities_id' => 4,
            'ticket_categories_id' => 1,
            'price' => 200000,
            'stock_per_day' => 50,
        ]);

        Ticket::create([
            'tourist_site_facilities_id' => 4,
            'ticket_categories_id' => 2,
            'price' => 300000,
            'stock_per_day' => 15,
        ]);
        
        Ticket::create([
            'tourist_site_facilities_id' => 5,
            'ticket_categories_id' => 1,
            'price' => 40000,
            'stock_per_day' => 120,
        ]);

        Ticket::create([
            'tourist_site_facilities_id' => 5,
            'ticket_categories_id' => 3,
            'price' => 160000,
            'stock_per_day' => 45,
        ]);
    }
}