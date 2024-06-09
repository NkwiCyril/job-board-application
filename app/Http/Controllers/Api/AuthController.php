<?php

namespace App\Http\Controllers\Api;

use App\Models\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\ErrorResource;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthController extends Controller
{
    public function login(LoginUserRequest $request): JsonResource
    {
        $validatedCredentials = $request->validated();

        $remember = $request['remember_me'] === 'on' ? true : false;

        try {
            if (auth()->attempt($validatedCredentials, $remember)) {

                $user = User::where('email', $validatedCredentials['email'])->first();

                $token = $user->createToken('auth_token')->plainTextToken;

                $user->logged_in = true;
                $user->save();

                return new AuthResource($user);

            } else {
                return new ErrorResource('The provided email/password do not match our records!');
            }
        } catch (\Exception $e) {

            logger()->error('Error encountered while logging in: '.$e->getMessage());

            return new ErrorResource('Error encountered: '.$e->getMessage());
        }
    }

    public function register(RegisterUserRequest $request): JsonResource
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

            return new AuthResource($user);

        } catch (\Exception $e) {
            logger()->error('Error encountered while registering: '.$e->getMessage());

            return response()->json([
                'status' => 0,
                'error' => 'Error encountered: '.$e->getMessage(),
            ], 500);
        }

    }

    public function logout(): JsonResource
    {

        try {

            auth()->user()->tokens()->delete();

            return new AuthResource('User logged out successful!');

        } catch (\Exception $e) {
            return new ErrorResource('Error encountered: '.$e->getMessage());
        }

    }
}
