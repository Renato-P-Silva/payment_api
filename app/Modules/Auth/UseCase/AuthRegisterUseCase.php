<?php

namespace App\Modules\Auth\UseCase;

use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class AuthRegisterUseCase
{
    public function execute(string $name, string $email, string $password): array
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ])->toArray();
    }

}
