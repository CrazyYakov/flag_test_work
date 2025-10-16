<?php

declare(strict_types=1);

namespace Marketplace\Cart\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Marketplace\Cart\Core\Application\Actions\RemoveProductFromCartAction;
use Marketplace\Cart\Presentation\Response\SuccessResponse;

class RemoveProductCartController
{
    public function __construct(
        private RemoveProductFromCartAction $action
    )
    {
    }

    public function __invoke(Request $request, int $id): Responsable
    {
        $this->action->run($request->user()->id, $id);

        return new SuccessResponse();
    }
}
