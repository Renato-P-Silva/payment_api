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

        $this->assertEquals('api.user.list', ApiRouteNameEnum::ApiPaymentList->value);
        $this->assertEquals('api.user.get', ApiRouteNameEnum::ApiPaymentGet->value);
        $this->assertEquals('api.user.create', ApiRouteNameEnum::ApiPaymentCreate->value);
    }
}
