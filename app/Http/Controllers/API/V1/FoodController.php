<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\FoodHistoryRequest;
use App\Http\Resources\API\V1\FoodCollection;
use App\Http\Resources\API\V1\OrderCollection;
use App\Interfaces\API\V1\FoodInterface;

class FoodController extends Controller
{
    protected $foodInterface;

    public function __construct(FoodInterface $foodInterface)
    {
        $this->foodInterface = $foodInterface;
    }
    
    public function menu()
    {
        $foods = $this->foodInterface->gets();
        $foods = new FoodCollection($foods);
        return ['foods' => $foods,];
    }
}
