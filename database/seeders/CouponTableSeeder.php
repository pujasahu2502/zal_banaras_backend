<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Coupon::create([
            'code' => 'Month1',
            'amount' => 20.6,
            'description' => 'This is the test description for this month',
            'usage_limit' => 2,
            'start_date' => '2023-05-01 00:00:00',
            'end_date' => '2023-06-30 00:00:00',
            'status' => '1',
            'type' => '1',
            'apply_on' => '1',
        ]);

        Coupon::create([
            'code' => 'Month2',
            'amount' => 10.9,
            'description' => 'This is the test description for this month',
            'usage_limit' => 9,
            'start_date' => '2023-05-01 00:00:00',
            'end_date' => '2023-06-30 00:00:00',
            'status' => '0',
            'type' => '1',
            'apply_on' => '1',
        ]);
    }
}