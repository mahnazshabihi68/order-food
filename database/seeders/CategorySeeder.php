<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                ['title' => 'ایرانی'],
                ['title' => 'فست فود'],
                ['title' => 'کباب'],
                ['title' => 'پیتزا'],
                ['title' => 'سالاد'],
                ['title' => 'بین الملل'],
                ['title' => 'دریایی'],
                ['title' => 'گیلانی'],
                ['title' => 'پاستا'],
                ['title' => 'سوخاری']
            ]
        );
    }
}
