<?php

namespace App\Modules\Auth\Controller;

use App\Infra\Controller\Controller;
use App\Infra\Request\Validation\Validator;
use App\Infra\Response\Api\ResponseApi;
use App\Modules\Auth\UseCase\AuthRegisterUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(private AuthRegisterUseCase $useCase)
    {
    }

    protected array $rules = [
        'name' => 'required|string',
        'type' => 'string|in:admin,merchant',
        'email' => 'required|email',
        'password' => 'required|string',
    ];

    public function __invoke(Request $request): JsonResponse
    {
        Validator::validateRequest($request, $this->rules);
        $data = $request->all();
        $result = $this->useCase->execute($data);
        return ResponseApi::renderCreated($result);
    }
}
