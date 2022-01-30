<?php

namespace App\Services\API\V1;

use App\Interfaces\API\V1\FoodInterface;
use App\Models\Food;
use App\Models\Vendor;

class FoodService implements FoodInterface
{
    public function gets(): object
    {
        $foods = Food::where('stock', '>', 0)->get();

        $foods->map(function ($food, $key) use ($foods) {
            if ($food->stock > 0)
                return $foods->push($foods->splice($key, 1)[0]);
        })->all();

        return $foods;
    }

    public function getHistoryOrders(): object
    {
        $foods = Food::whereHas('orders')->with('orders')->get();

        // $foods->map(function ($food, $key) use ($foods, $user_id) {
        //     if ($food->order->user_id == $user_id)
        //         return $foods->push($foods->splice($key, 1)[0]);
        // })->all();

        return $foods;
    }
}
