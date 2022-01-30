<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodVendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('food_vendor')->insert(
            [
                ['food_id' => '1', 'vendor_id' => 1],
                ['food_id' => '2', 'vendor_id' => 1],
                ['food_id' => '3', 'vendor_id' => 1],
                ['food_id' => '4', 'vendor_id' => 1],
                ['food_id' => '5', 'vendor_id' => 1],
                ['food_id' => '6', 'vendor_id' => 1],
                ['food_id' => '7', 'vendor_id' => 2],
                ['food_id' => '8', 'vendor_id' => 2],
                ['food_id' => '9', 'vendor_id' => 2],
                ['food_id' => '10', 'vendor_id' => 3],
                ['food_id' => '11', 'vendor_id' => 3],
            ]
        );
    }
}
