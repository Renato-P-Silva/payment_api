<?php

namespace App\Models\Payment;

use App\Models\User\User;
use App\Modules\Payment\Service\PaymentService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name_client
 * @property string $cpf
 * @property string $description
 * @property float $amount
 * @property int $merchant_id
 * @property string $status
 * @property string $method_payment
 * @property string $paid_at
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

    protected static function boot(): void
    {
        parent::boot();
        static::created(function (Payment $payment) {
            PaymentService::process($payment);
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
