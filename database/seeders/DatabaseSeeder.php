<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\Reseller;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(TourGuideSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(RegionCategorySeeder::class);
        $this->call(FacilitySeeder::class);
        $this->call(TouristSiteSeeder::class);
        $this->call(TouristSiteFacilitySeeder::class);
        $this->call(TicketCategorySeeder::class);
        $this->call(TicketSeeder::class);
        $this->call(CouponSeeder::class);
    }
}
