<?php 

namespace App\Modules\Payment\Enum;

enum PaymentStatusEnum: string
{
	case PENDING = 'pending';
	case PAID = 'paid';
	case EXPIRED = 'expired';
	case FAILED = 'failed';

	public static function values(): array
	{
		return [
			self::PENDING,
			self::PAID,
			self::EXPIRED,
			self::FAILED,
		];
	}
}