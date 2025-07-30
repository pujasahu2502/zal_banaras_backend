<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testimonials = [
            [
                'name' => 'Tim Thomas',
                'description' => 'Great products. Wonderful customer service. In my opinion DNZ makes the best scope mounts on the market. Not to mention it’s Made right here in North Carolina. Here’s a picture of my daughters. I liked hers so much I know have mine.',
                'status' => '1',
            ],
            [
                'name' => 'WJ Lohr',
                'description' => 'Amazing product. I will use them for all of my scope mount needs from now on. Great folks, very knowledgeable, extremely friendly, five stars all the way around!',
                'status' => '1',
            ],
            [
                'name' => 'Jonathan Gonia',
                'description' => 'Great product! These are a great group of people with a great product. Put these mounts on a budget rifle that will make it deliver high dollar accuracy! Couldn’t recommend more.',
                'status' => '1',
            ],
            [
                'name' => 'Zap Christopher',
                'description' => 'One piece, strong, no added weight, sturdy and very reliable. I tried it about 4 years ago. and switched almost all my rifles over to DNZ - won\'t be using anything else.....ever again.',
                'status' => '1',
            ],
            [
                'name' => 'Scott Conley',
                'description' => 'I own over a dozen DNZ mounts. ‘Without a doubt, the best I’ve ever used! Yet another perfect, solid, and level mount!',
                'status' => '1',
            ],
            [
                'name' => 'Bret Davies',
                'description' => 'The absolute best product on the market - - bar none',
                'status' => '1',
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::Create($testimonial);
        } 
    }
}