<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required|min:5'
        ]);

        $name = $request->input('name');
        $password = $request->input('password');

        $user = new User([
            'name' => $name,
            'password' => bcrypt($password)
        ]);

        if ($user->save()) {

            $user->signin = [
                'href' => 'api/v1/user/signin',
                'method' => 'POST',
                'params' => 'name, password'
            ];
            $response = [
                'message' => 'User created',
                'user' => $user,
            ];
            return response()->json($response, 201);
        }

        $response = [
            'message' => 'An error occurred'
        ];

        return response()->json($response, 404);

    }

    public function signin(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required|min:5'
        ]);

        $name = $request->input('name');
        $password = $request->input('password');

        if ($user = User::where('name', $name)->first()){

            $response = [
                'message' => 'User signin',
                'user' => $user,
            ];
            return response()->json($response, 201);

        }

        $response = [
            'message' => 'An error occurred'
        ];

        return response()->json($response, 404);


    }
}