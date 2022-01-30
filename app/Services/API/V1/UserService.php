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
        $validation = Validator::make($request, [
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        if ($validation->fails()) {
            return ['msg' => json_decode($validation->messages())->email[0], 'status' => '422'];
        } elseif (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
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
        $validation = Validator::make($request, [
            'name'              => 'required',
            'email'             => 'required|email|unique:users',
            'password'          => 'required',
            'cn_password'       => 'required|same:password'
        ]);

        if ($validation->fails()) {
            $messages = $this->getErrorsMessages($validation);

            return ['msg' => $messages, 'status' => '422'];
        } else {
            $request['password'] = bcrypt($request['password']);
            $user = User::create($request);
            return ['email' => $user->email, 'status' => 200];
        }
    }

    /**
     * return Errors Messages
     * 
     * @return \Illuminate\Http\Response
     */
    function getErrorsMessages($validation)
    {
        $messages = array();
        foreach (json_decode($validation->messages()) as $msg) {
            array_push($messages, $msg[0]);
        }
        return $messages;
    }
}
