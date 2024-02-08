<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::create([
            'coupon_code' => 'SAVE10',
            'discount_percentage' => 10,
            'start_date' => '2024-02-01',
            'expired_date' => '2024-02-28',
        ]);

        Coupon::create([
            'coupon_code' => 'SUMMER20',
            'discount_percentage' => 20,
            'start_date' => '2024-02-01',
            'expired_date' => '2024-04-15',
        ]);

        Coupon::create([
            'coupon_code' => 'EXPLORE15',
            'discount_percentage' => 15,
            'start_date' => '2024-02-01',
            'expired_date' => '2024-05-31',
        ]);

        Coupon::create([
            'coupon_code' => 'EARLYBIRD25',
            'discount_percentage' => 25,
            'start_date' => '2024-02-01',
            'expired_date' => '2024-07-10',
        ]);

        Coupon::create([
            'coupon_code' => 'HOLIDAY30',
            'discount_percentage' => 30,
            'start_date' => '2024-02-01',
            'expired_date' => '2024-12-31',
        ]);
    }
}
