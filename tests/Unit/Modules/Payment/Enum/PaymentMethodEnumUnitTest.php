<?php

namespace Tests\Unit\Modules\Payment\Enum;

use App\Modules\Payment\Enum\PaymentMethodEnum;
use Tests\PaymentUnitTest;

class PaymentMethodEnumUnitTest extends PaymentUnitTest
{
    public function testEnum()
    {
        $this->assertEquals('pix', PaymentMethodEnum::PIX->value);
        $this->assertEquals('boleto', PaymentMethodEnum::BOLETO->value);
        $this->assertEquals('bank_transfer', PaymentMethodEnum::BANK_TRANSFER->value);
    }
}
