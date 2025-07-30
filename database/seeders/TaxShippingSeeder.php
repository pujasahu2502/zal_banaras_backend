<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Tax,Shipping};

class TaxShippingSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tax::create([
            "name" => "TAX",
            "tax" => "7",
            "state" => "North Carolina"
        ]);

        Shipping::create([
            "zone_name" => "USPS shipping rate",
            "fixed_amount" => 6.99,
            "state" => "North Carolina"
        ]);
    }
}