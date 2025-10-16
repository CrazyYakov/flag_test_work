<?php

declare(strict_types=1);

namespace Marketplace\Cart\Presentation\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Marketplace\Cart\Core\Application\Actions\AddProductToCartAction;
use Marketplace\Cart\Presentation\Response\CreateResponse;
use Marketplace\Cart\Presentation\Response\SuccessResponse;

class StoreProductCartController
{
    public function __construct(
        private AddProductToCartAction $action
    )
    {
    }

    public function __invoke(Request $request, int $id): Responsable
    {
        $this->action->run($request->user()->id, $id);

        return new SuccessResponse();
    }
}
