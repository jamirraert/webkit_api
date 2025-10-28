<?php

namespace App\services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class AuthInterface
{
    abstract public function login(array $data):array|JsonResponse;
    abstract public function register(array $data):array|JsonResponse;
    abstract public function logout(Request $request):array|JsonResponse;

    public static function generateToken(User $user) {
        $token = $user->createToken($user->email)->plainTextToken;
        return $token;
    }
}
