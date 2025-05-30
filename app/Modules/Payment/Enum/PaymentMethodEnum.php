<?php 

namespace App\Modules\Payment\Enum;

enum PaymentMethodEnum: string
{
	case PIX = 'pix';
	case BOLETO = 'boleto';
	case BANK_TRANSFER = 'bank_transfer';

	public static function values(): array
	{
		return [
			self::PIX->value,
			self::BOLETO->value,
			self::BANK_TRANSFER->value,
		];
	}

	public static function percents(string $paymentMethod): float
	{
		return [
			self::PIX->value => 0.015,
			self::BOLETO->value => 0.02,
			self::BANK_TRANSFER->value => 0.04,
		][$paymentMethod];
	}
}