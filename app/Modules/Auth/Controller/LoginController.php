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

    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="User login",
     *     description="Authenticate a user and return a JWT token.",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="secret123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login, returns JWT token.",
     *         @OA\JsonContent(
     *           @OA\Property(property="status", type="integer", example=200),
     *           @OA\Property(property="data", type="object",
     *               @OA\Property(property="token", type="string", example="eyJhbGciOiJIUzI1NiIsInR5cCI6...")
     *           )
     *        )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid email or password."
     *     )
     * )
     */
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
