<?php

namespace App\Models\Payment;

use App\Models\User\User;
use App\Modules\Payment\Enum\PaymentMethodEnum;
use App\Modules\Payment\Enum\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int id
 * @property string name_client
 * @property string cpf
 * @property string description
 * @property float amount
 * @property int merchant_id
 * @property string status
 * @property string method_payment
 * @property string paid_at
 * @property string $created_at
 * @property string $updated_at
 *
 * @property-read User $merchant
 *
 * @mixin Builder<Payment>
 */
class Payment extends Model
{
    use HasUuids;

    protected $table = 'payment';
    protected $keyType = 'uuid';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name_client',
        'cpf',
        'description',
        'amount',
        'status',
        'method_payment',
        'paid_at',
        'merchant_id',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'merchant_id',
    ];

    protected function casts(): array
    {
        return [
            'paid_at' => 'datetime:Y-m-d H:i:s',
            'created_at' => 'datetime:Y-m-d H:i:s',
            'updated_at' => 'datetime:Y-m-d H:i:s',
        ];
    }

    protected function resultProcessPaymentStatus(): string
    {
        $randomNumber = mt_rand(1, 100);
        if ($randomNumber <= 70) {
            return PaymentStatusEnum::PAID->value;
        }
        return PaymentStatusEnum::FAILED->value;
    }

    protected static function boot(): void
    {
        parent::boot();
        static::created(function (Payment $payment) {
            $resultProcessPaymentStatus = $payment->resultProcessPaymentStatus();
            $payment->status = $resultProcessPaymentStatus;
            $payment->save();
            $payment->refresh();

            if ($resultProcessPaymentStatus === PaymentStatusEnum::PAID->value) {
                $tax = 0.0;
                $discount = $payment->amount * PaymentMethodEnum::percents($payment->method_payment);
                $tax = $payment->amount - $discount;

                $merchant = User::find($payment->merchant_id);
                $merchant->balance = ((float)$merchant->balance ?? 0.0) + $tax;
                $merchant->save();
            }
        });
    }

    /**
     * @return HasOne<User, $this>
     */
    public function merchant(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'merchant_id');
    }

}
