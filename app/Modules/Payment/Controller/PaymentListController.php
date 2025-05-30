<?php

namespace App\Modules\Payment\Controller;

use App\Infra\Controller\Read\BaseListController;
use App\Infra\UseCase\Read\IListUseCase;
use App\Models\Payment\Payment;
use App\Modules\Payment\UseCase\PaymentListUseCase;

/**
 * @OA\Get(
 *     path="/api/v1/payment",
 *     summary="List payments with pagination",
 *     tags={"Payment"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="page",
 *         in="query",
 *         description="Page number",
 *         required=false,
 *         @OA\Schema(type="integer", default=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Paginated list of payments",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="current_page", type="integer", example=1),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="string", format="uuid", example="01971ef6-df01-723e-85bf-be4ca4b95685"),
 *                     @OA\Property(property="name_client", type="string", example="Cliente Teste"),
 *                     @OA\Property(property="cpf", type="string", example="88811188888"),
 *                     @OA\Property(property="description", type="string", nullable=true, example=null),
 *                     @OA\Property(property="amount", type="string", example="10.55"),
 *                     @OA\Property(property="status", type="string", example="pending"),
 *                     @OA\Property(property="method_payment", type="string", example="boleto"),
 *                     @OA\Property(property="paid_at", type="string", example="2025-05-29 23:13:04")
 *                 )
 *             ),
 *             @OA\Property(property="first_page_url", type="string", example="http://localhost:8080/api/v1/payment?page=1"),
 *             @OA\Property(property="from", type="integer", example=1),
 *             @OA\Property(property="last_page", type="integer", example=1),
 *             @OA\Property(property="last_page_url", type="string", example="http://localhost:8080/api/v1/payment?page=1"),
 *             @OA\Property(
 *                 property="links",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="url", type="string", nullable=true, example=null),
 *                     @OA\Property(property="label", type="string", example="&laquo; Previous"),
 *                     @OA\Property(property="active", type="boolean", example=false)
 *                 )
 *             ),
 *             @OA\Property(property="next_page_url", type="string", nullable=true, example=null),
 *             @OA\Property(property="path", type="string", example="http://localhost:8080/api/v1/payment"),
 *             @OA\Property(property="per_page", type="integer", example=100),
 *             @OA\Property(property="prev_page_url", type="string", nullable=true, example=null),
 *             @OA\Property(property="to", type="integer", example=4),
 *             @OA\Property(property="total", type="integer", example=4)
 *         )
 *     )
 * )
 */
class PaymentListController extends BaseListController
{
    public function __construct(protected PaymentListUseCase $useCase)
    {
    }

    protected function getUseCase(): IListUseCase
    {
        return $this->useCase;
    }

    protected function getModelName(): string
    {
        return Payment::class;
    }
}
