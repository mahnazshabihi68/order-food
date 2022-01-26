<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Interfaces\API\V1\UserInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $result = $this->userInterface->checkUser($input);
        return response()->json($result);
    }


    public function register(Request $request)
    {
        $input = $request->all();
        $result = $this->userInterface->createUser($input);
        return response()->json($result);
    }
}
