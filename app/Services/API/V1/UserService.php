<?php

namespace APP\Services\API\V1;

use App\Interfaces\API\V1\UserInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserService implements UserInterface
{
    /**
     * check login user service
     * 
     * @return \Illuminate\Http\Response
     */
    public function checkUser($request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $token =  $user->createToken('MyApp')->accessToken;
            return ['token' => $token, "status" => 200];
        } else {
            return ['error' => 'Unauthorised', 'status' => 401];
        }
    }

    /**
     * signUp user service
     * 
     * @return \Illuminate\Http\Response
     */
    public function createUser($request)
    {
        $request['password'] = bcrypt($request['password']);
        $user = User::create($request);
        isset($request['role']) ? $user->attachRole($request['role']) : $user->attachRole('admin');
        return ['email' => $user->email, 'status' => 200];
    }
}
