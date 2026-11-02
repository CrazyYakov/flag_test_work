<?php

declare(strict_types=1);

namespace Marketplace\Auth\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Marketplace\Auth\Core\Application\Actions\CreateUserTokenAction;
use Marketplace\Auth\Core\Ports\UserRepositoryContract;
use Marketplace\Auth\Presentation\Requests\AuthorizationRequest;
use Marketplace\Auth\Presentation\Response\SuccessResponse;
use Marketplace\Auth\Presentation\Response\UnauthorizedResponse;
use Marketplace\Auth\Presentation\View\UserView;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Auth')]
readonly class AuthorizationController
{
    public function __construct(
        private UserRepositoryContract $userRepository,
        private CreateUserTokenAction $createUserTokenAction,
    ) {}

    #[OA\Post(
        path: '/api/auth/authorization',
        operationId: 'authorizeUser',
        tags: ['Auth'],
        summary: 'Авторизация пользователя',
        description: 'Проверяет учётные данные и возвращает ID пользователя и API-токен. При неверных данных возвращает 401.',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['email', 'password'],
                properties: [
                    new OA\Property(property: 'email', type: 'string', format: 'email', maxLength: 255, example: 'ivan@example.com'),
                    new OA\Property(property: 'password', type: 'string', format: 'password', example: 'secret'),
                ],
            ),
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Авторизация прошла успешно',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'status', type: 'string', example: 'success'),
                        new OA\Property(
                            property: 'data',
                            type: 'object',
                            properties: [
                                new OA\Property(property: 'id', type: 'integer', description: 'ID пользователя', example: 1),
                                new OA\Property(property: 'token', type: 'string', description: 'API-токен для авторизации', example: '1|abcdefghijklmnopqrstuvwxyz'),
                            ],
                        ),
                    ],
                ),
            ),
            new OA\Response(
                response: 401,
                description: 'Неверный email или пароль',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'status', type: 'string', example: 'error'),
                        new OA\Property(property: 'message', type: 'string', example: 'Unauthorized'),
                    ],
                ),
            ),
            new OA\Response(response: 422, description: 'Ошибка валидации входных данных'),
        ],
    )]
    public function __invoke(AuthorizationRequest $request): Responsable
    {
        $user = $this->userRepository->getByEmail($request->email);

        if ($user === null || ! $user->checkPassword($request->password)) {
            return new UnauthorizedResponse();
        }

        return new SuccessResponse(
            new UserView($user->id, $this->createUserTokenAction->run($user))
        );
    }
}
