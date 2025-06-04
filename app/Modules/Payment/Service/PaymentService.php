<?php

namespace App\Modules\Payment\Service;

use App\Models\Payment\Payment;
use App\Models\User\User;
use App\Modules\Payment\Enum\PaymentMethodEnum;
use App\Modules\Payment\Enum\PaymentStatusEnum;

class PaymentService
{
    protected static function resultPayment(): string
    {
        $randomNumber = mt_rand(1, 100);
        if ($randomNumber <= 70) {
            return PaymentStatusEnum::PAID->value;
        }
        return PaymentStatusEnum::FAILED->value;
    }

    public static function process(Payment $payment): void
    {
        $resultarPayment = self::resultPayment();
        $payment->status = $resultarPayment;
        $payment->save();
        $payment->refresh();

        if ($resultarPayment === PaymentStatusEnum::PAID->value) {
            $tax = 0.0;
            $discount = $payment->amount * PaymentMethodEnum::percents($payment->method_payment);
            $tax = $payment->amount - $discount;

            $merchant = User::find($payment->merchant_id);
            $merchant->balance = !empty($merchant->balance) ? ((float)$merchant->balance + $tax) : $tax;
            $merchant->save();
        }
    }
}
