<?php

namespace Tests\Feature\Modules\Auth\Controller;

use App\Infra\Response\Enum\StatusCodeEnum;
use App\Models\Payment\Payment;
use App\Modules\Payment\Enum\PaymentStatusEnum;
use PHPUnit\Framework\Attributes\TestDox;
use Tests\PaymentFeatureTest;

class PaymentGetControllerFeatureTest extends PaymentFeatureTest
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
    public function testPaymentGetRouteTestOne()
    {
        $payment = Payment::create([
            'name_client' => 'Client Test',
            'cpf' => self::CPF,
            'description' => 'Payment for service',
            'method_payment' => 'boleto',
            'amount' => 150.75,
            'paid_att' => date('Y-m-d H:i:s'),
            'status' => PaymentStatusEnum::PENDING->value,
            'merchant_id' => $this->user->id,
        ]);

        $response = $this->getJson('/api/v1/payment/' . $payment->id, $this->makeHeaders());
        $response->assertStatus(StatusCodeEnum::HttpOk->value);
        $response->assertJsonStructure([
            'status',
            'data' => [
                'id',
                'name_client',
                'cpf',
                'description',
                'amount',
                'status',
                'method_payment',
                'paid_at',
                "merchant" => [
                    'id',
                    'name',
                    'email',
                    'type',
                    'balance',
                    'created_at',
                    'updated_at',
                ]
            ]
        ]);
    }

    #[TestDox("Testando com id inexistente")]
    public function testPaymentGetRouteTestTwo()
    {
        $response = $this->getJson('/api/v1/payment/0000000000', $this->makeHeaders());
        $response->assertStatus(StatusCodeEnum::HttpNotFound->value);
    }
}
