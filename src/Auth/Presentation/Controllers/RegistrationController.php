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

readonly class RegistrationController
{
    public function __construct(
        private AddUserAction $addUserAction,
        private CreateUserTokenAction $createUserTokenAction,
    ) {}

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
