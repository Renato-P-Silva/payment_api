<?php

namespace App\Modules\Auth\Controller;

use App\Infra\Controller\Controller;
use App\Infra\Request\Validation\Validator;
use App\Infra\Response\Api\ResponseApi;
use App\Modules\Auth\UseCase\AuthLoginUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(private AuthLoginUseCase $useCase)
    {
    }

    protected array $rules = [
        'email' => 'required|email',
        'password' => 'required|string',
    ];

    public function __invoke(Request $request): JsonResponse
    {
        Validator::validateRequest($request, $this->rules);
        $data = $request->all();
        $token = $this->useCase->execute($data['email'], $data['password']);
        if (empty($token)) {
            return ResponseApi::renderBadRequest('Email or password incorrect');
        }
        return ResponseApi::renderOk(['token' => $token]);
    }
}
