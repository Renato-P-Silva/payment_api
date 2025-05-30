<?php

namespace App\Modules\Payment\Controller;

use App\Infra\Controller\Create\BaseCreateController;
use App\Infra\UseCase\Create\ICreateUseCase;
use App\Models\Payment\Payment;
use App\Modules\Payment\Enum\PaymentMethodEnum;
use App\Modules\Payment\Enum\PaymentStatusEnum;
use App\Modules\Payment\UseCase\PaymentCreateUseCase;

class PaymentCreateController extends BaseCreateController
{
    public function __construct(protected PaymentCreateUseCase $useCase)
    {
    }

    protected function getUseCase(): ICreateUseCase
    {
        return $this->useCase;
    }

    protected function getRules(): array
    {
        return [
            'name_client' => 'required|string|min:3|max:120',
            'cpf' => 'required|string|min:11|max:11',
            'description' => 'nullable|string|min:3|max:255',
            'method_payment' => 'required|in:' . implode(',', PaymentMethodEnum::values()),
            'amount' => 'required|numeric|min:0',
            // 'merchant_id' => 'required|numeric|exists:users,id',
        ];
    }

    protected function getModelName(): string
    {
        return Payment::class;
    }
}
