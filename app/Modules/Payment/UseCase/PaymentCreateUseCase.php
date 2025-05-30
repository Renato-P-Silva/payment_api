<?php

namespace App\Modules\Payment\UseCase;

use App\Infra\UseCase\Create\ICreateUseCase;
use App\Models\Payment\Payment;
use App\Modules\Payment\Enum\PaymentStatusEnum;

class PaymentCreateUseCase implements ICreateUseCase
{
    public function execute(array $data): array
    {
        return Payment::create([
            'name_client' => trim($data['name_client']),
            'cpf' => $data['cpf'],
            'description' => $data['description'],
            'status' => PaymentStatusEnum::PENDING->value,
            'method_payment' => $data['method_payment'],
            'amount' => $data['amount'],
            'paid_at' => date('Y-m-d H:i:s'),
            'merchant_id' => auth()->user()->id,
        ])->toArray();
    }
}
