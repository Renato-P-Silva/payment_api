<?php

namespace Tests\Feature\Modules\Auth\Controller;

use App\Infra\Response\Enum\StatusCodeEnum;
use App\Models\Payment\Payment;
use App\Modules\Payment\Enum\PaymentMethodEnum;
use PHPUnit\Framework\Attributes\TestDox;
use Tests\PaymentFeatureTest;

class PaymentCreateControllerFeatureTest extends PaymentFeatureTest
{
    private const string CPF = "12345678901";

    protected function setUp(): void
    {
        parent::setUp();
        Payment::where('cpf', self::CPF)->delete();
    }

    protected function tearDown(): void
    {
        Payment::where('cpf', self::CPF)->delete();
        parent::tearDown();
    }

    #[TestDox("Testando com dados válidos")]
    public function testPaymentCreateRouteTestOne()
    {
        $response = $this->postJson(
            '/api/v1/payment',
            [
            'name_client' => 'Client Test',
            'cpf' => self::CPF,
            'description' => 'Payment for service',
            'method_payment' => PaymentMethodEnum::BOLETO->value,
            'amount' => 100.00,
        ],
            $this->makeHeaders()
        );

        $response->assertStatus(StatusCodeEnum::HttpCreated->value);
        $this->assertDatabaseHas('payment', [
            'cpf' => self::CPF,
            'name_client' => 'Client Test'
        ]);
    }

    #[TestDox("Testando com dados inválidos")]
    public function testPaymentCreateRouteTestTwo()
    {
        $response = $this->postJson(
            '/api/v1/payment',
            [
            'name_client' => 'Client Test',
            'cpf' => self::CPF,
            'description' => 'Payment for service',
            'method_payment' => 'invalid_method',
            'amount' => '',
        ],
            $this->makeHeaders()
        );

        $response->assertStatus(StatusCodeEnum::HttpBadRequest->value);
    }
}
