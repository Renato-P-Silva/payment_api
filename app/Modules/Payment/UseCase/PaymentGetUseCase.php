<?php

namespace App\Modules\Payment\UseCase;

use App\Infra\UseCase\Read\IGetUseCase;
use App\Models\Payment\Payment;

class PaymentGetUseCase implements IGetUseCase
{
    public function execute(int|string $id): array
    {
        return Payment::with('merchant')->findOrFail($id)->toArray();
    }
}
