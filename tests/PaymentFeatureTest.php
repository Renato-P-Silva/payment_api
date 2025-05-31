<?php

namespace Tests;

use App\Models\User\User;
use App\Modules\Auth\UseCase\AuthLoginUseCase;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

abstract class PaymentFeatureTest extends TestCase
{
    use WithFaker;

    protected string $userEmail = 'teste_php_unit@email.com';
    protected string $userPassword = 'admin';
    protected User $user;
    protected string $token = '';

    protected function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();
        User::where('email', $this->userEmail)->delete();
        $this->user = User::create([
            'name' => 'teste_php_unit',
            'type' => 'merchant',
            'email' => $this->userEmail,
            'password' => Hash::make($this->userPassword),
        ]);
    }

    protected function tearDown(): void
    {
        User::where('email', $this->userEmail)->delete();
        DB::rollBack();
        parent::tearDown();
    }

    protected function makeHeaders(): array
    {
        $token = $this->getAuthToken();
        return [
            'Authorization' => "Bearer {$token}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    protected function getAuthToken(): string
    {
        if (empty($this->token)) {
            $useCase = new AuthLoginUseCase();
            $this->token = $useCase->execute($this->userEmail, $this->userPassword);
        }
        return $this->token;
    }
}
