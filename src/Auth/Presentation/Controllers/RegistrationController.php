<?php

namespace Marketplace\Auth\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Marketplace\Auth\Core\Application\Actions\AddUserAction;
use Marketplace\Auth\Core\Application\Actions\CreateUserTokenAction;
use Marketplace\Auth\Core\Application\Exceptions\UserExistException;
use Marketplace\Auth\Presentation\Requests\RegistrationRequest;
use Marketplace\Auth\Presentation\Response\BadRequestResponse;
use Marketplace\Auth\Presentation\Response\CreateResponse;
use Marketplace\Auth\Presentation\View\UserView;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Auth')]
readonly class RegistrationController
{
    public function __construct(
        private AddUserAction $addUserAction,
        private CreateUserTokenAction $createUserTokenAction,
    ) {}

    #[OA\Post(
        path: '/api/auth/registration',
        operationId: 'registerUser',
        tags: ['Auth'],
        summary: 'Регистрация нового пользователя',
        description: 'Создаёт нового пользователя и возвращает его ID и API-токен. При существующем email возвращает 400.',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'email', 'password', 'password_confirmation'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', maxLength: 255, example: 'Ivan Petrov'),
                    new OA\Property(property: 'email', type: 'string', format: 'email', maxLength: 255, example: 'ivan@example.com'),
                    new OA\Property(property: 'password', type: 'string', format: 'password', minLength: 6, example: 'secret'),
                    new OA\Property(property: 'password_confirmation', type: 'string', format: 'password', description: 'Повтор пароля (подтверждение)', example: 'secret'),
                ],
            ),
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Пользователь успешно создан',
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
                response: 400,
                description: 'Пользователь с таким email уже существует',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'status', type: 'string', example: 'error'),
                        new OA\Property(property: 'message', type: 'string', example: 'User with this email already exists.'),
                    ],
                ),
            ),
            new OA\Response(response: 422, description: 'Ошибка валидации входных данных'),
        ],
    )]
    public function __invoke(RegistrationRequest $request): Responsable
    {
        try {
            $user = $this->addUserAction
                ->run($request->email, $request->name, $request->password);
        } catch (UserExistException $exception) {
            return new BadRequestResponse($exception->getMessage());
        }

        return new CreateResponse(
            new UserView($user->id, $this->createUserTokenAction->run($user))
        );
    }
}
