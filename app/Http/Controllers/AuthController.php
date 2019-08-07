<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        try {
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
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        try {
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
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
            ], 500);
        }
    }
}
