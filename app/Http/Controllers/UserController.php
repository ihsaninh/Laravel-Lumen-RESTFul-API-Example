<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{

    public function index()
    {
        try {
            $users = User::all();
            return response()->json([
                'message' => 'Success Retrieved Users',
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

    public function show($id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                return response()->json([
                    'message' => 'Success Retrieved User',
                    'data' => $user,
                ], 200);
            } else {
                return response()->json([
                    'message' => 'User Not Found',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone_number' => 'required|min:11',
        ]);
        try {
            $user = User::find($id);
            if ($user) {
                $userData = $request->only(['name', 'email', 'phone_number']);
                $userUpdate = $user->update($userData);
                return response()->json([
                    'message' => 'Success Updated Data',
                    'data' => $user,
                ], 200);
            } else {
                return response()->json([
                    'message' => 'User Not Found',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                $user->delete();
                return response()->json([
                    'message' => 'Success Deleted User',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'User Not Found',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
            ], 500);
        }
    }
}
