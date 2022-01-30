<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vendors')->insert(
            [
                ['title' => 'همایونی', 'preparation_time' => Carbon::now()->format('00:i:s')],
                ['title' => 'تهران سوخاری', 'preparation_time' => Carbon::now()->format('00:i:s')],
                ['title' => 'رفتاری', 'preparation_time' =>  Carbon::now()->format('00:i:s')],
            ]
        );
    }
}
