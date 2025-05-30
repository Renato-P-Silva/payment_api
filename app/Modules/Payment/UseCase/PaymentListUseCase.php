<?php

namespace App\Modules\Payment\UseCase;

use App\Infra\UseCase\Read\IListUseCase;
use App\Models\Payment\Payment;

class PaymentListUseCase implements IListUseCase
{
    public function execute(int $perPage, int $page, ?array $queryParams = null): array
    {
        return Payment::query()->paginate($perPage, ['*'], 'page', $page)->toArray();
    }
}
