<?php

namespace App\Modules\Payment\Controller;

use App\Infra\Controller\Read\BaseListController;
use App\Infra\UseCase\Read\IListUseCase;
use App\Models\Payment\Payment;
use App\Modules\Payment\UseCase\PaymentListUseCase;

class PaymentListController extends BaseListController
{
    public function __construct(protected PaymentListUseCase $useCase)
    {
    }

    protected function getUseCase(): IListUseCase
    {
        return $this->useCase;
    }

    protected function getModelName(): string
    {
        return Payment::class;
    }
}
