<?php

namespace Tests\Unit\Modules\Payment\Enum;

use App\Modules\Payment\Enum\PaymentStatusEnum;
use Tests\PaymentUnitTest;

class PaymentStatusEnumUnitTest extends PaymentUnitTest
{
    public function testEnum()
    {
        $this->assertEquals('pending', PaymentStatusEnum::PENDING->value);
        $this->assertEquals('paid', PaymentStatusEnum::PAID->value);
        $this->assertEquals('expired', PaymentStatusEnum::EXPIRED->value);
        $this->assertEquals('failed', PaymentStatusEnum::FAILED->value);
    }
}
