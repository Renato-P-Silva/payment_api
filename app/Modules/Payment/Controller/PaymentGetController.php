<?php

namespace App\Modules\Payment\Controller;

use App\Infra\Controller\Read\BaseGetController;
use App\Infra\UseCase\Read\IGetUseCase;
use App\Models\Payment\Payment;
use App\Modules\Payment\UseCase\PaymentGetUseCase;

class PaymentGetController extends BaseGetController
{
    public function __construct(protected PaymentGetUseCase $useCase)
    {
    }

    protected function getUseCase(): IGetUseCase
    {
        return $this->useCase;
    }

    protected function getModelName(): string
    {
        return Payment::class;
    }
}
