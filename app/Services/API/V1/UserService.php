<?php

namespace App\Services\API\V1;

use App\Interfaces\API\V1\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserService implements UserInterface
{
    public function checkUser(array $request): array
    {
        $validation = Validator::make($request, [
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        if ($validation->fails()) {
            return ['msg' => json_decode($validation->messages())->email[0], 'status' => '422'];
        } elseif (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $token =  $user->createToken('MyApp')->accessToken;
            return ['token' => $token->token, "status" => 200];
        } else {
            return ['error' => 'Unauthorised', 'status' => 401];
        }
    }

    public function createUser(array $request): array
    {
        $validation = Validator::make($request, [
            'name'              => 'required',
            'email'             => 'required|email|unique:users',
            'password'          => 'required'
        ]);

        if ($validation->fails()) {
            $messages = $this->getErrorsMessages($validation);

            return ['msg' => $messages, 'status' => '422'];
        } else {
            $request['password'] = bcrypt($request['password']);
            $user = User::create($request);
            $token =  $user->createToken('MyApp')->accessToken;
            return ['name' => $user->name, 'status' => 200];
        }
    }

    function getErrorsMessages($validation)
    {
        $messages = array();
        foreach (json_decode($validation->messages()) as $msg) {
            array_push($messages, $msg[0]);
        }
        return $messages;
    }
}
