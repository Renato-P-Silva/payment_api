<?php

namespace Tests\Feature\Modules\Auth\Controller;

use App\Infra\Response\Enum\StatusCodeEnum;
use App\Models\Payment\Payment;
use App\Modules\Payment\Enum\PaymentStatusEnum;
use Tests\PaymentFeatureTest;

class PaymentListControllerFeatureTest extends PaymentFeatureTest
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

    public function testPaymentListRouteTestOne()
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

        $response = $this->getJson('/api/v1/payment', $this->makeHeaders());
        $response->assertStatus(StatusCodeEnum::HttpOk->value);
        $response->assertJsonStructure([
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'name_client',
                    'cpf',
                    'description',
                    'amount',
                    'status',
                    'method_payment',
                    'paid_at',
                ]
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links' => [
                '*' => [
                    'url',
                    'label',
                    'active',
                ]
            ],
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total',
            'status',
        ]);
    }
}
