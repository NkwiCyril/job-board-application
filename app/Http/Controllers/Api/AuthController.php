<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
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
                    'message' => 'You have logged in successfully!',
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
}
