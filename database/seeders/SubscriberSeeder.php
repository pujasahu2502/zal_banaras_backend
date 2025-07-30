<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriberSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $subscriptions = [
            [ 'email' => 'test@gmail.com' ],
            [ 'email' => 'ocean@gmail.com' ],
            [ 'email' => 'hello@gmail.com' ],
            [ 'email' => 'dnz@gmail.com' ],
            [ 'email' => 'product@gmail.com' ],
        ];

        foreach ($subscriptions as $subscription) {
            Subscription::create($subscription);
        }
    }
}