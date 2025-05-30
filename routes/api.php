<?php

use App\Infra\Route\Enum\ApiRouteNameEnum;
use App\Modules\Auth\Controller\LoginController;
use App\Modules\Auth\Controller\RegisterController;
use App\Modules\Payment\Controller\PaymentCreateController;
use App\Modules\Payment\Controller\PaymentGetController;
use App\Modules\Payment\Controller\PaymentListController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', LoginController::class)->name(ApiRouteNameEnum::ApiAuthLogin);
    Route::post('register', RegisterController::class)->name(ApiRouteNameEnum::ApiAuthRegister);
});

Route::middleware(['auth.jwt'])->prefix('v1')->group(function () {

    Route::prefix('payment')->group(function () {
        Route::post('', PaymentCreateController::class)->name(ApiRouteNameEnum::ApiPaymentCreate);
        Route::get('', PaymentListController::class)->name(ApiRouteNameEnum::ApiPaymentCreate);
        Route::get('{id}', PaymentGetController::class)->name(ApiRouteNameEnum::ApiPaymentGet);
    });

});