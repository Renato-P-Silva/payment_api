<?php

namespace Tests\Feature\Modules\Auth\Controller;

use App\Infra\Response\Enum\StatusCodeEnum;
use App\Models\User\User;
use PHPUnit\Framework\Attributes\TestDox;
use Tests\PaymentFeatureTest;

class RegisterControllerFeatureTest extends PaymentFeatureTest
{
    private const string USER_EMAIL = "user-register@email.com";

    protected function setUp(): void
    {
        parent::setUp();
        User::where('email', self::USER_EMAIL)->delete();
    }

    protected function tearDown(): void
    {
        User::where('email', self::USER_EMAIL)->delete();
        parent::tearDown();
    }

    #[TestDox("Testando com dados válidos")]
    public function testRegisterRouteTestOne()
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'Teste PHP Unit',
            'type' => 'merchant',
            'email' => self::USER_EMAIL,
            'password' => '1234',
        ]);

        $response->assertStatus(StatusCodeEnum::HttpCreated->value);
        $response->assertJsonStructure(['status', 'data']);
    }

    #[TestDox("Testando com dados inválidos")]
    public function testRegisterRouteTestTwo()
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'Teste PHP Unit',
            'email' => self::USER_EMAIL,
            'password' => '',
        ]);

        $response->assertStatus(StatusCodeEnum::HttpBadRequest->value);
    }
}
