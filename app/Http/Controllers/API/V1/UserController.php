<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\UserLoginRequest;
use App\Http\Requests\API\V1\UserRegisterRequest;
use App\Interfaces\API\V1\UserInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function login(UserLoginRequest $request)
    {
        $input = $request->all();
        $result = $this->userInterface->checkUser($input);
        return response()->json($result);
    }


    public function register(UserRegisterRequest $request)
    {
        $input = $request->all();
        $result = $this->userInterface->createUser($input);
        return response()->json($result);
    }
}
