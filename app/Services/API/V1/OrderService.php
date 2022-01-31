<?php

namespace App\Services\API\V1;

use App\Interfaces\API\V1\OrderInterface;
use App\Models\Food;
use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class OrderService implements OrderInterface
{
    public function create($request)
    {
        $user_id = Auth::id();
        $foodIds = $request['food_ids'];
        $vendor_id = $request['vendor_id'];

        if (Auth::user()->hasRole('admin')) return ['message' => __('It is not possible to place an order by the admin'), 'status' => 404];

        foreach ($foodIds as $food_id) {
            $food = Food::with('vendors')->where('id', $food_id);

            if (!$food->first()) return ['message' => __('No food found'), 'status' => 404];
            elseif (!$food->where('stock', '>', 0)->first()) return ['message' => __('Food is finished'), 'status' => 404];

            $vendor = Vendor::where('id', $vendor_id)->first();
            $vendorIds = $food->first()->vendors->pluck('id')->toArray();

            if (!$vendor) return ['message' => __('Vendor dont exist'), 'status' => 404];
            elseif (!in_array($vendor_id, $vendorIds)) return ['message' => __('The supplier does not match the food'), 'status' => 404];
        }

        $order = new Order;
        $order->vendor_id = $vendor_id;
        $order->user_id = $user_id;
        $order->status = 'Pending';
        $order->save();
        $order->foods()->attach($foodIds);

        $drive_time = "00:30:00"; // Set default 30 minute - The time of sending food from the restaurant to the user, which is determined based on the lat and long of the user's address.
        $delivery_time = strtotime($drive_time) + strtotime($vendor->preparation_time);
        $message =  __('Your order has been successfully registered') . '. ' . __('Your order to') . ' ' . date("H:i:s", $delivery_time) . ' ' . __('Another will reach you');

        return ['message' => $message, 'status' => 200];
    }

    public function changeStatus($request)
    {
        $order_id = $request['order_id'];
        $status = $request['status'];

        $order = Order::find($order_id);
        if (!$order) return ['message' => __('No order found'), 'status' => 404];

        if (!Auth::user()->hasRole('admin')) return ['message' => __('Only the admin user can change the status of the order.'), 'status' => 404];

        if ($order->status == 'pending') {
            if ($status == 'unconfirmed') {
                $order->status = 'unconfirmed';
                $order->save();
                return ['message' => __('Order status changed to unconfirmed'), 'status' => 404];
            } else {
                $foods = $order->foods;
                $foods->map(function ($food) use ($order) {
                    if ($food->stock <= 0) {
                        $order->status = 'unconfirmed';
                        $order->save();
                    }
                });

                if ($order->status == 'unconfirmed') return ['message' => __('The food is over'), 'status' => 404];
                else {
                    $foods->map(function ($food) use ($order) {
                        $food_id = $food->id;

                        DB::transaction(function () use ($food_id, $order) {
                            DB::table('foods')->where('id', $food_id)->decrement('stock');
                            DB::table('orders')->where('id', $order->id)->update(array('status' => 'confirmed', 'updated_at' => now()));
                        });
                    });

                    return ['message' => __('Order confirmed'), 'status' => 200];
                }
            }
        } else return ['message' => __('Order change status before'), 'status' => 200];
    }

    public function getFoodHistory(): object
    {
        $user_id = Auth::id();
        $orders = Order::whereHas('foods')->with('foods')->where('status', 'confirmed')->where('user_id', $user_id)->get();

        return $orders;
    }
}
