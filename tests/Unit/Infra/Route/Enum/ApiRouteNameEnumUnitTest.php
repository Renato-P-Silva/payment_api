<?php

namespace Tests\Unit\Infra\Route\Enum;

use App\Infra\Route\Enum\ApiRouteNameEnum;
use Tests\PaymentUnitTest;

class ApiRouteNameEnumUnitTest extends PaymentUnitTest
{
    public function testEnum()
    {
        $this->assertEquals('api.auth.login', ApiRouteNameEnum::ApiAuthLogin->value);
        $this->assertEquals('api.auth.register', ApiRouteNameEnum::ApiAuthRegister->value);

        $this->assertEquals('api.payment.list', ApiRouteNameEnum::ApiPaymentList->value);
        $this->assertEquals('api.payment.get', ApiRouteNameEnum::ApiPaymentGet->value);
        $this->assertEquals('api.payment.create', ApiRouteNameEnum::ApiPaymentCreate->value);
    }
}
