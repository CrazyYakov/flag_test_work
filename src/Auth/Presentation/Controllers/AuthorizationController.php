<?php

declare(strict_types=1);

namespace Marketplace\Auth\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Marketplace\Auth\Core\Application\Actions\CreateUserTokenAction;
use Marketplace\Auth\Infrastructure\Interfaces\UserRepositoryInterface;
use Marketplace\Auth\Presentation\Requests\AuthorizationRequest;
use Marketplace\Auth\Presentation\Response\SuccessResponse;
use Marketplace\Auth\Presentation\Response\UnauthorizedResponse;
use Marketplace\Auth\Presentation\View\UserView;

readonly class AuthorizationController
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private CreateUserTokenAction $createUserTokenAction,
    ) {}

    public function authorization(AuthorizationRequest $request): Responsable
    {
        $user = $this->userRepository->getByEmail($request->email);

        if (! $user->checkPassword($request->password)) {
            return new UnauthorizedResponse();
        }

        return new SuccessResponse(
            new UserView($user->id, $this->createUserTokenAction->run($user))
        );
    }
}
