<?php

namespace App\Infra\Route\Enum;

enum ApiRouteNameEnum: string
{
    case ApiAuthLogin = 'api.auth.login';
    case ApiAuthRegister = 'api.auth.register';

    case ApiPaymentCreate = 'api.user.create';
    case ApiPaymentList = 'api.user.list';
    case ApiPaymentGet = 'api.user.get';
}
