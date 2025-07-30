<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\ContactUs;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            FaqSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            PermissionSeeder::class,
            PageSeeder::class,
            CouponTableSeeder::class,
            // AttributeSeeder::class,
            // VariationSeeder::class,
            BrandSeeder::class,
            TaxShippingSeeder::class,
            ContactUsSeeder::class,
            // ProductSeeder::class,
            // ReviewSeeder::class,
            TestimonialSeeder::class,
            DealerSeeder::class,
            SettingSeeder::class,
            SubscriberSeeder::class,
            BlogSeeder::class
        ]);
    }
}