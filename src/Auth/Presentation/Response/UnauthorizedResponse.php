<?php

declare(strict_types=1);

namespace Marketplace\Auth\Presentation\Response;

use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

final class UnauthorizedResponse implements Responsable
{
    public function toResponse($request): Response
    {
        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized'
        ], Response::HTTP_UNAUTHORIZED);
    }
}
