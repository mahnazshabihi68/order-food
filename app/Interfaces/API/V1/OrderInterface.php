<?php

namespace App\Interfaces\API\V1;

use Illuminate\Support\Arr;

interface OrderInterface 
{
    public function create(array $request); 
    public function changeStatus(array $request);
}