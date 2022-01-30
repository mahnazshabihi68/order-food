<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Interfaces\API\V1\FoodInterface;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    protected $foodInterface;

    public function __construct(FoodInterface $foodInterface)
    {
        $this->middleware('auth:api');
        $this->foodInterface = $foodInterface;
    }
    
    
    public function menu()
    {
        dd(auth()->user());
        $foods = $this->foodInterface->gets();
        $history_orders = $this->foodInterface->getHistoryOrders();
        return ['foods' => $foods, 'history_orders' => $history_orders];
    }
}
