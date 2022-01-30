<?php

namespace App\Services\API\V1;

use App\Interfaces\API\V1\OrderInterface;
use App\Models\Food;
use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
// use Auth;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderInterface
{
    public function create($request)
    {
        $user_id = Auth::id();
        $food_id = $request['food_id'];
        $vendor_id = $request['vendor_id'];

        $food = Food::where('id', $food_id);

        if (!$food->first())
            return ['message' => __('No food found'), 'status' => 404];
        elseif (!$food->where('stock', '>', 0)->first())
            return ['message' => __('Food is finished'), 'status' => 404];

        $vendor = Vendor::where('id', $vendor_id)->first();

        if (!$vendor) return ['message' => __('Vendor dont exist'), 'status' => 404];

        DB::transaction(function () use ($food_id, $user_id, $vendor_id) {
            DB::table('foods')->where('id', $food_id)->decrement('stock');
            $order = new Order;
            $order->vendor_id = $vendor_id;
            $order->user_id = $user_id;
            $order->status = 'Pending';
            $order->save();

            $order->foods()->attach($food_id);

        });
        
        $drive_time = "00:30:00"; // Set default 30 minute - The time of sending food from the restaurant to the user, which is determined based on the lat and long of the user's address.
        $delivery_time = strtotime($drive_time) + strtotime($vendor->preparation_time);
        $message =  __('Your order has been successfully registered') . '. '. __('Your order to') . ' ' . date("H:i:s", $delivery_time) . ' ' . __('Another will reach you');

        return ['message' => $message, 'status' => 200];
    }

    public function changeStatus($request)
    {
        $order_id = $request['order_id'];
        $order = Order::find($order_id);
        $food = Food::where('id', $order->food_id);

        if (!$food->where('stock', '>', 0)->first())
            return ['message' => __('Food is finished'), 'status' => 404];
        else
            $order->update(['status' => 'confirmed']);
    }
}
