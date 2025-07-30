<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributes = [
            [
                'name' => 'Action',
                'slug' => 'action',
                'status' => '1',
            ],
            [
                'name' => 'Color',
                'slug' => 'color',
                'status' => '1',
            ],
            [
                'name' => 'Hardware Type',
                'slug' => 'hardware-type',
                'status' => '1',
            ],
            [
                'name' => 'Height',
                'slug' => 'height',
                'status' => '1',
            ],
            [
                'name' => 'Make',
                'slug' => 'make',
                'status' => '1',
            ],
            [
                'name' => 'Model',
                'slug' => 'model',
                'status' => '1',
            ],
            [
                'name' => 'Number of Screws per Ring',
                'slug' => 'number-of-screws-per-ring',
                'status' => '1',
            ],
        ];

        foreach ($attributes as $attribute) {
            Attribute::Create($attribute);
        } 
    }
}