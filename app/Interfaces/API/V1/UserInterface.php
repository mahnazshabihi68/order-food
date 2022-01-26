<?php

namespace App\Interfaces\API\V1;

interface UserInterface
{
    public function checkUser(array $requset);
    public function createUser(array $requset);
}
