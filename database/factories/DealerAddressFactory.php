<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Dealer;
use Faker\Provider\en_IN\Address;

class DealerAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $dealer_id=Dealer::inRandomOrder()->first();
        return [
            'dealer_id' => $dealer_id->id,
            'address' => $this->faker->address(),
            'city'=> $this->faker->city(),
            'state'=> $this->faker->state(),
            'country'=> 'India',
            'zip'=> $this->faker->postcode(),
            'longitude'=> $this->faker->longitude(68.7,97.25),
            'latitude'=> $this->faker->latitude(8.4,37.6)
        ];
    }
}
