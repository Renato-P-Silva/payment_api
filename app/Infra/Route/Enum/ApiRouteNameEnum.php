<?php

namespace App\Infra\Route\Enum;

enum ApiRouteNameEnum: string
{
    case ApiAuthLogin = 'api.auth.login';
    case ApiAuthRegister = 'api.auth.register';

    case ApiPaymentCreate = 'api.payment.create';
    case ApiPaymentList = 'api.payment.list';
    case ApiPaymentGet = 'api.payment.get';
}
