<?php

namespace App\Modules\Payment\Controller;

use App\Infra\Controller\Create\BaseCreateController;
use App\Infra\UseCase\Create\ICreateUseCase;
use App\Models\Payment\Payment;
use App\Modules\Payment\Enum\PaymentMethodEnum;
use App\Modules\Payment\UseCase\PaymentCreateUseCase;

/**
 * @OA\Post(
 *     path="/api/v1/payment",
 *     summary="Create a new payment",
 *     tags={"Payment"},
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name_client", "cpf", "method_payment", "amount"},
 *             @OA\Property(property="name_client", type="string", minLength=3, maxLength=120, example="John Doe"),
 *             @OA\Property(property="cpf", type="string", minLength=11, maxLength=11, example="12345678901"),
 *             @OA\Property(property="description", type="string", minLength=3, maxLength=255, example="Payment for service"),
 *             @OA\Property(property="method_payment", type="string", enum={"pix", "boleto", "bank_transfer"}, example="boleto"),
 *             @OA\Property(property="amount", type="number", format="float", minimum=0, example=150.75)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Payment created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="integer", example=201),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", format="uuid", example="01972371-f5ee-7262-bc61-ae757a7ceeb8"),
 *                 @OA\Property(property="name_client", type="string", example="John Doe"),
 *                 @OA\Property(property="cpf", type="string", example="12345678901"),
 *                 @OA\Property(property="description", type="string", example="Payment for service"),
 *                 @OA\Property(property="method_payment", type="string", example="boleto"),
 *                 @OA\Property(property="amount", type="number", format="float", example=150.75),
 *                 @OA\Property(property="status", type="string", example="pending"),
 *                 @OA\Property(property="paid_at", type="string", format="date-time", example="2025-05-30 22:00:00")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input data"
 *     )
 * )
 */
class PaymentCreateController extends BaseCreateController
{
    public function __construct(protected PaymentCreateUseCase $useCase)
    {
    }

    protected function getUseCase(): ICreateUseCase
    {
        return $this->useCase;
    }

    protected function getRules(): array
    {
        return [
            'name_client' => 'required|string|min:3|max:120',
            'cpf' => 'required|string|min:11|max:11',
            'description' => 'nullable|string|min:3|max:255',
            'method_payment' => 'required|in:' . implode(',', PaymentMethodEnum::values()),
            'amount' => 'required|numeric|min:0',
        ];
    }

    protected function getModelName(): string
    {
        return Payment::class;
    }
}
