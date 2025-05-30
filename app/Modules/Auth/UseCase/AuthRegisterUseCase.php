<?php

namespace App\Modules\Auth\UseCase;

use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

class AuthRegisterUseCase
{
    public function execute(array $data): array
    {
        return User::create([
            'name' => $data['name'],
            'type' => $data['type'] ?? 'merchant',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ])->toArray();
    }

}
