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
        'name' => 'required|string|min:3|max:120',
        'type' => 'string|in:admin,merchant',
        'email' => 'required|email',
        'password' => 'required|string',
    ];

    /**
     * @OA\Post(
     *     path="/api/auth/register",
     *     summary="Register a new user",
     *     description="Creates a new user account with provided details.",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password"},
     *             @OA\Property(property="name", type="string", minLength=3, maxLength=120, example="John Doe"),
     *             @OA\Property(property="type", type="string", enum={"admin","merchant"}, example="merchant"),
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="securePassword123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User successfully registered.",
     *         @OA\JsonContent(
     *           @OA\Property(property="status", type="integer", example=201),
     *           @OA\Property(property="data", type="object",
     *               @OA\Property(property="id", type="integer", example=1),
     *               @OA\Property(property="name", type="string", example="John Doe"),
     *               @OA\Property(property="email", type="string", example="john@example.com"),
     *               @OA\Property(property="type", type="string", example="merchant")
     *           )
     *        )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input data."
     *     )
     * )
     */
    public function __invoke(Request $request): JsonResponse
    {
        Validator::validateRequest($request, $this->rules);
        $data = $request->all();
        $result = $this->useCase->execute($data);
        return ResponseApi::renderCreated($result);
    }
}
