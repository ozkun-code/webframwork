<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT; //panggil library JWT
use Illuminate\Support\Facades\Validator; //panggil library validator
use illuminate\Support\Facades\Auth; //panggil library auth
use Carbon\Carbon; //panggil library carbon
use App\Models\User; //panggil model user

class UserController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->messages())->setStatusCode(422);
        }

        $user = $validator->validated();

        User::create($user);

        $payload = [
            'name' => $user['name'],
            'role' => 'user',
            'iat' => Carbon::now()->timestamp,
            'exp' => Carbon::now()->timestamp + 7200 // 2 jam
        ];

        $token = JWT::encode($payload, env('JWT_SECRET_KEY'), 'HS256');

        return response()->json([
            'msg' => 'Successfully registered!',
            'data' => [
                'name' => $user['name'],
                'email' => $user['email']
            ],
            'token' => 'Bearer '.$token
        ], 200);

    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->messages())->setStatusCode(422);
        }

        $user = $validator->validated();

        if(Auth::attempt($user)) {
            $payload = [
                'name' => Auth::user()->name,
                'role' => Auth::user()->role,
                'iat' => Carbon::now()->timestamp,
                'exp' => Carbon::now()->timestamp + 7200 // 2 jam
            ];

            $token = JWT::encode($payload, env('JWT_SECRET_KEY'), 'HS256');

            return response()->json([
                'msg' => 'Succesfully logged in!',
                'data' => [
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email
                ],
                'token' => 'Bearer '.$token
            ], 200);
        } else {
            return response()->json([
                'msg' => 'Wrong email or password'
            ], 422);
        }
    }
}
