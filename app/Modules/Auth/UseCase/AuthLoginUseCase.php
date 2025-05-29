<?php

namespace App\Modules\Auth\UseCase;

use Tymon\JWTAuth\Facades\JWTAuth;

class AuthLoginUseCase
{
    public function execute(string $email, string $password): string
    {
        $credentials = ['email' => $email, 'password' => $password];
        auth()->attempt($credentials);
        if (!auth()->check()) {
            return '';
        }

        $user = auth()->user();
        $token = JWTAuth::fromUser($user);
        return $token;
    }

}
