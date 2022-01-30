<?php

namespace App\Interfaces\API\V1;

interface OrderInterface 
{
    public function create(array $request); 
    public function changeStatus(array $request);
}