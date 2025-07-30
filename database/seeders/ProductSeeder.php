<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'type' => '1',
                'category_id' => 1,
                'brand_id' => 1,
                'name' => 'Quick Justice',
                'slug' => 'quick-justice',
                'stock_status' => 'In stock',
                'status' => '2',
            ],
            [
                'type' => '1',
                'category_id' => 2,
                'brand_id' => 1,
                'name' => 'Reef Reaper Anchor',
                'slug' => 'reef-reaper-anchor',
                'stock_status' => 'In stock',
                'status' => '2',
            ],
            [
                'type' => '1',
                'brand_id' => 1,
                'category_id' => 3,
                'name' => 'Quiver Keeper',
                'slug' => 'quiver-keeper',
                'stock_status' => 'In stock',
                'status' => '2',
            ],
            [
                'type' => '1',
                'brand_id' => 1,
                'category_id' => 4,
                'name' => 'Electronic and Passive Ear Muffs',
                'slug' => 'electronic-and-passive-ear-muffs',
                'stock_status' => 'In stock',
                'status' => '2',
            ],
            [
                'type' => '1',
                'brand_id' => 1,
                'category_id' => 1,
                'name' => 'Game Reaper',
                'slug' => 'game-reaper',
                'stock_status' => 'In stock',
                'status' => '2',
            ],
            [
                'type' => '1',
                'brand_id' => 1,
                'category_id' => 2,
                'name' => 'Weatherby Magnum',
                'slug' => 'weatherby-magnum',
                'stock_status' => 'In stock',
                'status' => '2',
            ],
        ];

        foreach ($products as $product) {
            Product::Create($product);
        } 
    }
}