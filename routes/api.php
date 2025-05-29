<?php

use App\Infra\Route\Enum\ApiRouteNameEnum;
use App\Modules\Auth\Controller\LoginController;
use App\Modules\Auth\Controller\RegisterController;
use App\Modules\User\Controller\UserListController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', LoginController::class)->name(ApiRouteNameEnum::ApiAuthLogin);
    Route::post('register', RegisterController::class)->name(ApiRouteNameEnum::ApiAuthRegister);
});

Route::middleware(['auth.jwt'])->prefix('v1')->group(function () {

    Route::prefix('user')->group(function () {
        Route::get('', UserListController::class)->name(ApiRouteNameEnum::ApiUserList);
    });

});