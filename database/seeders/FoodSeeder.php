<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('foods')->insert(
            [
                ['title' => 'چلو خورشت قورمه سبزی', 'category_id' => 1, 'stock' => 3],
                ['title' => 'دیزی سنگی', 'category_id' => 1, 'stock' => 3],
                ['title' => 'باقالی پلو با گوشت', 'category_id' => 1, 'stock' => 3],
                ['title' => 'چلو گوشت', 'category_id' => 1, 'stock' => 3],
                ['title' => 'چلو ماهی قزل آلا سرخ شده', 'category_id' => 1, 'stock' => 3],
                ['title' => 'زرشک پلو با مرغ ربی (ران)', 'category_id' => 1, 'stock' => 3],
                ['title' => 'چلو اکبر جوجه', 'category_id' => 1, 'stock' => 3],
                ['title' => 'ساندویچ بندری با قارچ (با نان برشته)', 'category_id' => 2, 'stock' => 3],
                ['title' => 'فینگر فود کشک بادمجان', 'category_id' => 2, 'stock' => 3],
                ['title' => 'چلو کباب کوبیده نگین دار زعفرانی', 'category_id' => 3, 'stock' => 3],
                ['ttle' => 'چلو کباب بختیاری', 'category_id' => 3, 'stock' => 3],
            ]
        );
    }
}
