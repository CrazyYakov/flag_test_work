<?php

declare(strict_types=1);

namespace Marketplace\Cart\Presentation\Response;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class CreateResponse implements Responsable
{
    public function __construct(
        private ?Arrayable $data = null,
    ) {}

    public function toResponse($request): Response
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->data->toArray(),
        ], Response::HTTP_CREATED);
    }
}
