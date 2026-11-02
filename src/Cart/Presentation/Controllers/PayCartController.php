<?php

declare(strict_types=1);

namespace Marketplace\Cart\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Marketplace\Cart\Core\Application\Actions\PayCartAction;
use Marketplace\Cart\Presentation\Response\SuccessResponse;

class PayCartController
{
    public function __construct(
        private PayCartAction $payCartAction
    ) {}

    public function __invoke(Request $request, int $paymentMethodId): Responsable
    {
        $user = $request->user();

        if ($user === null) {
            abort(401);
        }

        $this->payCartAction->run(
            $user->id,
            $paymentMethodId,
        );

        return new SuccessResponse();
    }
}
