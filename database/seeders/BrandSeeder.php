<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands= [
            [
                'name' => 'Browning',
                'slug' => 'browning',
                'status' => '1',
            ],
            [
                'name' => 'CVA',
                'slug' => 'cva',
                'status' => '1',
            ],
            [
                'name' => 'Harring & Richardson',
                'slug' => 'harring&richardson',
                'status' => '1',
            ],
            [
                'name' => 'Henry',
                'slug' => 'henry',
                'status' => '1',
            ],
            [
                'name' => 'Kimber',
                'slug' => 'kimber',
                'status' => '1',
            ],
            [
                'name' => 'Howa',
                'slug' => 'howa',
                'status' => '1',
            ],
            [
                'name' => 'Mossberg',
                'slug' => 'mossberg',
                'status' => '1',
            ],
            [
                'name' => 'Knight',
                'slug' => 'knight',
                'status' => '1',
            ],
            [
                'name' => 'Marlin',
                'slug' => 'marlin',
                'status' => '1',
            ],
            [
                'name' => 'Ruger',
                'slug' => 'ruger',
                'status' => '1',
            ],
            [
                'name' => 'Savage',
                'slug' => 'savage',
                'status' => '1',
            ],
            [
                'name' => 'Sako',
                'slug' => 'sako',
                'status' => '1',
            ],
            [
                'name' => 'Thompson Center',
                'slug' => 'thompson-center',
                'status' => '1',
            ],
            [
                'name' => 'Traditions',
                'slug' => 'traditions',
                'status' => '1',
            ],
            [
                'name' => 'Tikka',
                'slug' => 'tikka',
                'status' => '1',
            ],
            [
                'name' => 'Winchester',
                'slug' => 'winchester',
                'status' => '1',
            ],
            [
                'name' => 'Weatherby',
                'slug' => 'weatherby',
                'status' => '1',
            ],
            [
                'name' => 'Remington',
                'slug' => 'remington',
                'status' => '1',
            ],    
        ];
        foreach ($brands as $brand) {
            Brand::Create($brand);
        } 
    }
}