<?php

namespace App\Infra\Controller\Update;

use App\Infra\Controller\Controller;
use App\Infra\Request\Validation\Validator;
use App\Infra\Response\Api\ResponseApi;
use App\Infra\Response\Exceptions\BadRequestException;
use App\Infra\UseCase\Update\IUpdateUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

abstract class BaseUpdateController extends Controller
{
    abstract protected function getUseCase(): IUpdateUseCase;
    abstract protected function getRules(): array;
    abstract protected function getModelName(): string;

    public function __invoke(Request $request, int $id): JsonResponse
    {
        Validator::validateRequest($request, $this->getRules());
        DB::beginTransaction();
        try {
            $requestData = $request->all();
            if ($request->isJson()) {
                $requestData = $request->json()->all();
            }
            $result = $this->getUseCase()->execute($requestData, $id);
            if (!$result) {
                throw new BadRequestException('Erro ao atualizar o objeto.');
            }
            DB::commit();
            return ResponseApi::renderOk($result);
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
