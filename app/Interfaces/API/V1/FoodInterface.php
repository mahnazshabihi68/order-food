<?php

namespace App\Interfaces\API\V1;


interface FoodInterface
{
    public function gets(): object;
    public function getHistoryOrders(): object;
}