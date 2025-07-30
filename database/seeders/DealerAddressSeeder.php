<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DealerAddress;

class DealerAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DealerAddress::factory()->count(50)->create();
    }
}
