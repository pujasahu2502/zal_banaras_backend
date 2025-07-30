<?php

namespace Database\Seeders;

use App\Models\ContactUs;
use Illuminate\Database\Seeder;

class ContactUsSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactUs::create([
            "name" => "David Penrod",
            "email" => "david@gmail.com",
            "mobile" => "9879534323",
            "subject" => "How to write strong networking email subject lines", 
            "description" => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.'
        ]);
        ContactUs::create([
            "name" => "Michael Peterson",
            "email" => "michael@gmail.com",
            "mobile" => "9879844444",
            "subject" => "How to write strong networking email subject lines", 
            "description" => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.'
        ]);
        ContactUs::create([
            "name" => "Daniel Ward",
            "email" => "daniel@gmail.com",
            "mobile" => "9879855555",
            "subject" => "How to write strong networking email subject lines", 
            "description" => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections.'
        ]);
        ContactUs::create([
            "name" => "John Perry",
            "email" => "john@gmail.com",
            "mobile" => "9879866666",
            "subject" => "How to write strong networking email subject lines", 
            "description" => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage.'
        ]);
    }
}