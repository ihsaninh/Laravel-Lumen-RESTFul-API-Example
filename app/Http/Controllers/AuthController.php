<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password= Hash::make($request->input('password'));

        $register = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        if ($register) {
            return response()->json([
                'message' => 'Successed Register New User',
                'data' => $register,
            ], 201);
        } else {
            return response()->json([
                'message' => 'Failed Register New User',
            ], 400);
        }
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if (Hash::check($password, $user->password)) {
            $token = base64_encode(str_random(128));

            $user->update([
                'token' => $token
            ]);
            return response()->json([
                'message' => 'Login Successed',
                'data' => [
                    'user' => $user,
                    'token' => $token
                ],
            ], 200);
        } else {
            return response()->json([
                'message' => 'Login Failed',
            ], 400);
        }
    }
}
