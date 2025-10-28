<?php

namespace App\services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthManager extends AuthInterface
{
    public function login(array $data): array|JsonResponse
    {
        $user = User::where('email', $data['email'])->first();
        
        if(!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                "message" => "Invalid credentials."
            ], 422);
        }

        $token = self::generateToken($user);

        return response()->json([
            "success" => true,
            "token" => $token,
            "user" => $user
        ]);
    }

    public function register(array $data): array|JsonResponse
    {
        $user = User::create($data);
        $token = self::generateToken($user);

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function logout($request): array|JsonResponse
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Successfully logout user.'
        ]);
    }
}
