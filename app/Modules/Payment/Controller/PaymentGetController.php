<?php

namespace App\Modules\Payment\Controller;

use App\Infra\Controller\Read\BaseGetController;
use App\Infra\UseCase\Read\IGetUseCase;
use App\Models\Payment\Payment;
use App\Modules\Payment\UseCase\PaymentGetUseCase;

/**
 * @OA\Get(
 *     path="/api/v1/payment/{id}",
 *     summary="Get payment by ID",
 *     tags={"Payment"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="UUID of the payment",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid", example="123e4567-e89b-12d3-a456-426614174000")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Payment details retrieved successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="string", format="uuid", example="123e4567-e89b-12d3-a456-426614174000"),
 *                 @OA\Property(property="name_client", type="string", example="John Doe"),
 *                 @OA\Property(property="cpf", type="string", example="12345678901"),
 *                 @OA\Property(property="description", type="string", example="Payment for service"),
 *                 @OA\Property(property="amount", type="number", format="float", example=150.75),
 *                 @OA\Property(property="status", type="string", example="pending"),
 *                 @OA\Property(property="method_payment", type="string", example="credit_card"),
 *                 @OA\Property(property="paid_at", type="string", format="date-time", example="2025-05-30 22:00:00"),
 *                 @OA\Property(
 *                     property="merchant",
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=8),
 *                     @OA\Property(property="name", type="string", example="Teste User"),
 *                     @OA\Property(property="email", type="string", example="rp@telnav.com"),
 *                     @OA\Property(property="type", type="string", example="merchant"),
 *                     @OA\Property(property="balance", type="number", format="float", example=31.02),
 *                     @OA\Property(property="created_at", type="string", nullable=true, example=null),
 *                     @OA\Property(property="updated_at", type="string", nullable=true, example=null)
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Payment not found"
 *     )
 * )
 */
class PaymentGetController extends BaseGetController
{
    public function __construct(protected PaymentGetUseCase $useCase)
    {
    }

    protected function getUseCase(): IGetUseCase
    {
        return $this->useCase;
    }

    protected function getModelName(): string
    {
        return Payment::class;
    }
}
