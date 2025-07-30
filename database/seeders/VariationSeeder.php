<?php

namespace Database\Seeders;

use App\Models\Variation;
use Illuminate\Database\Seeder;

class VariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $variations = [
            [
                'attribute_id' => '1',
                'name' => 'Demo',
                'slug' => 'demo',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],
            [
                'attribute_id' => '1',
                'name' => 'Any Action',
                'slug' => 'any-action',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],
            [
                'attribute_id' => '1',
                'name' => 'Bar & Long Action',
                'slug' => 'bar-long-action',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],

            [
                'attribute_id' => '2',
                'name' => 'Red',
                'slug' => 'red',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],
            [
                'attribute_id' => '2',
                'name' => 'Gray',
                'slug' => 'gray',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],
            [
                'attribute_id' => '2',
                'name' => 'Orange Crush',
                'slug' => 'orange-crush',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],

            [
                'attribute_id' => '3',
                'name' => '.80 wide 4 screw ring – 30MM – Black',
                'slug' => '80-wide-4-screw-ring-30mm-black',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],
            [
                'attribute_id' => '3',
                'name' => '.80 wide 4 screw ring – 30MM – Silver',
                'slug' => '80-wide-4-screw-ring-30mm-silver',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],
            [
                'attribute_id' => '3',
                'name' => '9/64 x 6″ T-Handle Hex',
                'slug' => '9-64-x-6-t-handle-hex',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],

            [
                'attribute_id' => '4',
                'name' => 'High-1.19″',
                'slug' => 'high-1-19',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],
            [
                'attribute_id' => '4',
                'name' => 'Medium-1.00″',
                'slug' => 'medium-1-00',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],
            [
                'attribute_id' => '4',
                'name' => 'X-High',
                'slug' => 'x-high',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],

            [
                'attribute_id' => '5',
                'name' => 'Savage All Round Rec. with 8-40 screw holes',
                'slug' => 'savage-all-round-rec-with-8-40-screw-holes',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],
            [
                'attribute_id' => '5',
                'name' => 'Savage All Round RECEIVER',
                'slug' => 'savage-all-round-receiver',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],
            [
                'attribute_id' => '5',
                'name' => 'Tikka T3 -T3X',
                'slug' => 'tikka-t3-t3x',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],

            [
                'attribute_id' => '6',
                'name' => '1.4 Forward Picatinny Rail',
                'slug' => '1-4-forward-picatinny-rail',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],
            [
                'attribute_id' => '6',
                'name' => ' 2-Piece Picatinny Rail',
                'slug' => '2-piece-picatinny-rail',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],
            [
                'attribute_id' => '6',
                'name' => '3.8 Forward Picatinny Rail-20MOA',
                'slug' => '3-8-forward-picatinny-rail-20moa',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],

            [
                'attribute_id' => '7',
                'name' => '2',
                'slug' => '2',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],
            [
                'attribute_id' => '7',
                'name' => '4',
                'slug' => '4',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],
            [
                'attribute_id' => '7',
                'name' => '6',
                'slug' => '6',
                'description' => 'Test Desc for the test',
                'status' => '1',
            ],

        ];

        foreach ($variations as $variation) {
            Variation::Create($variation);
        } 
    }
}