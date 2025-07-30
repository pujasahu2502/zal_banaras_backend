<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            "email" => "certified@windstream.net",
            "mobile" => "919-777-9609",
            "address" => "DNZ Products, LLC 2710 Wilkins Dr Sanford, NC 27330 USA",
            "twitter" =>"https://twitter.com/DNZProducts",
            "facebook" =>"https://www.facebook.com/dnzproducts",
            "instagram" =>"https://www.instagram.com/dnzproducts/"
        ]);
    }
}