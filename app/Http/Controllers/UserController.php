<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        try {
            $users = User::all();

            return response()->json([
                'message' => 'success retrieved users',
                'users' => $users,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
            ], 500);
        }
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|min:11|unique:users',
        ]);

        try {
            $userData = $request->only(['name', 'email', 'phone_number']);

            $newUser = User::create($userData);

            return response()->json([
                'message' => 'success register new user',
                'data' => $newUser,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
            ], 500);
        }

    }
}
