<?php

namespace App\Services\API\V1;

use App\Interfaces\API\V1\FoodInterface;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

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

    public function getFoodHistory($request): object
    {
        $id = $request['food_id'];

        $orders = Order::where('status', 'confirmed')->get();

        $orders->map(function ($order) {
            $foodIds = $order->foods()->pluck('foods.id')->toArray();
            if ($order->foods) {
                $order->status = 'unconfirmed';
                $order->save();
            }
        });
        $foods = Food::where('id', $id)->whereHas('orders', function ($query) {
            $query->where('status', 'confirmed');
        })->with(['orders' => function ($q) {
            $q->where('status', 'confirmed');
        }])->get();

        return $foods;
    }

    public function getUserFoodOrderHistory(): object
    {
        $user_id = Auth::id();
        $orders = Order::whereHas('foods')->with('foods')->where('status', 'confirmed')->where('user_id', $user_id)->get();

        return $orders;
    }
}
