<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthorizationRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Resources\AuthorizationResource;
use App\Models\User;
use App\Services\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registration(RegistrationRequest $request): JsonResponse
    {
        $user = $this->userRepository->create($request->toArray());

        return response()->json($this->getResponse($user), 201);
    }

    public function authorization(AuthorizationRequest $request): AuthorizationResource
    {
        $user = $this->userRepository->getByEmail($request->email);

        $hashCheckPassed = Hash::check($request->password, $user?->password);

        $hashCheckPassed ?: abort(401);

        return $this->getResponse($user);
    }

    private function getResponse(User $user): AuthorizationResource
    {
        $data = [
            'id' => $user->getKey(),
            'token' => $user->createToken('api')->plainTextToken
        ];

        return new AuthorizationResource($data);
    }
}
