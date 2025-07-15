<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'     => 'required|string|max:255|unique:users',
                'email'    => 'required|string|email|unique:users',
                'password' => 'required|string|min:6',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Bad Request',
                    'status'  => 400,
                    'errors'  => $validator->errors()
                ], 400);
            }

            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => app('hash')->make($request->password),
            ]);
            return response()->json([
                'message' => 'User registered successfully',
                'data'    => $user,
                'status' => 201
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email'    => 'required|string|email',
                'password' => 'required|string|min:6',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Bad Request',
                    'status'  => 400,
                    'errors'  => $validator->errors()
                ], 400);
            }

            $credentials = $request->only('email', 'password');
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Email atau Password yang anda masukan salah', 'error' => 'Unauthorized', 'status' => 401], 401);
            }
            return response()->json([
                'message' => 'Login successful',
                'token'   => $token,
                'status'  => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
    // public function logout()
    // {
    //     try {
    //         JWTAuth::invalidate(JWTAuth::getToken());
    //         return response()->json(['message' => 'Logout successful', 'status' => 200], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Internal Server Error',
    //             'error'   => $e->getMessage()
    //         ], 500);
    //     }
    // }
}
