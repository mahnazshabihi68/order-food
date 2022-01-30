<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\OrderRequest;
use App\Http\Requests\API\V1\OrderStatusRequest;
use App\Interfaces\API\V1\OrderInterface;

class OrderController extends Controller
{
    protected $orderInterface;
    public function __construct(OrderInterface $orderInterface)
    {
        $this->middleware('auth:api');
        $this->orderInterface = $orderInterface;
    }

    public function store(OrderRequest $request)
    {
        $input = $request->all();
        $result = $this->orderInterface->create($input);
        return response()->json($result);
    }

    public function changeStatus(OrderStatusRequest $request)
    {
        $input = $request->all();
        $result = $this->orderInterface->changeStatus($input);
        return response()->json($result);
    }

    public function getFoodHistory()
    {
        return $this->orderInterface->getFoodHistory();
    }
}
