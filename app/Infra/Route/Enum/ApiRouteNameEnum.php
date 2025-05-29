<?php

namespace App\Infra\Route\Enum;

enum ApiRouteNameEnum: string
{
    case ApiAuthLogin = 'api.auth.login';
    case ApiAuthRegister = 'api.auth.register';

    case ApiUserList = 'api.user.list';
    case ApiUserGet = 'api.user.get';
    case ApiUserCreate = 'api.user.create';
    case ApiUserUpdate = 'api.user.update';
    case ApiUserDelete = 'api.user.delete';
}
