<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(LoginUserRequest $request): JsonResponse
    {
        $validatedCredentials = $request->validated();

        $remember = $request['remember_me'] === 'on' ? true : false;

        try {
            if (auth()->attempt($validatedCredentials, $remember)) {

                $user = User::where('email', $validatedCredentials['email'])->first();

                $token = $user->createToken('auth_token')->plainTextToken;

                $user->logged_in = true;
                $user->save();

                return response()->json([
                    'status' => 1,
                    'message' => 'Login successful!',
                    'user' => $user,
                    'token' => $token,
                ], 200);

            } else {
                return response()->json([
                    'status' => 0,
                    'message' => 'The provided email/password do not match our records!',
                ]);
            }
        } catch (\Exception $e) {

            logger()->error('Error encountered while logging in: '.$e->getMessage());

            return response()->json([
                'status' => 0,
                'error' => 'Error encountered: '.$e->getMessage(),
            ]);
        }
    }

    public function register(RegisterUserRequest $request): JsonResponse
    {

        $validatedCredentials = $request->validated();

        try {

            $user = User::create([
                'usertype' => $validatedCredentials['usertype'],
                'name' => $validatedCredentials['name'],
                'email' => $validatedCredentials['email'],
                'password' => bcrypt($validatedCredentials['password']),
                'phone_number' => $validatedCredentials['phone_number'],
                'category' => $validatedCredentials['category'],
                'logged_in' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'status' => 1,
                'message' => 'Registration successful!',
                'user' => $user,
            ], 200);

        } catch (\Exception $e) {
            logger()->error('Error encountered while registering: '.$e->getMessage());

            return response()->json([
                'status' => 0,
                'error' => 'Error encountered: '.$e->getMessage(),
            ], 500);
        }

    }

    public function logout(): JsonResponse
    {

        try {
            //
            auth()->user()->tokens()->delete();

            return response()->json([
                'status' => 1,
                'message' => 'User logged out successful!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Error encountered: '.$e->getMessage(),
            ], 500);
        }

    }
}
