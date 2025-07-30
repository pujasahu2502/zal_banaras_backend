<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories= [
            // [
            //     'type' => '1',
            //     'name' => 'Game Reaper',
            //     'slug' => 'game-reaper',
            //     'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            //     'status' => '1',
            // ],
            [
                'type' => 'Sarees',
                'name' => '',
                'slug' => 'zari-vasket',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'status' => '1',
            ],
            [
                'type' => '1',
                'name' => 'Tanchoi Art',
                'slug' => 'tanchoi-art',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'status' => '1',
            ],
            [
                'type' => '1',
                'name' => 'Summer with Chiffon',
                'slug' => 'summer-with-chiffon',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'status' => '1',
            ],
            // [
            //     'type' => '1',
            //     'name' => '215 Tactical',
            //     'slug' => '215-tactical',
            //     'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            //     'status' => '1',
            // ],

            [
                'type' => '2',
                'name' => 'Sarees',
                'slug' => 'sarees',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'status' => '1',
            ],
            [
                'type' => '2',
                'name' => 'Kora Silks',
                'slug' => 'kora-silks',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'status' => '1',
            ],
            [
                'type' => '2',
                'name' => 'Kadwa Weave',
                'slug' => 'kadwa-weave ',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'status' => '1',
            ]
        ];
        foreach ($categories as $category) {
            Category::Create($category);
        } 
    }
}