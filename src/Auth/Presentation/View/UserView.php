<?php

declare(strict_types=1);

namespace Marketplace\Auth\Presentation\View;

use Illuminate\Contracts\Support\Arrayable;

class UserView implements Arrayable
{
    public function __construct(
        private int $id,
        private string $token
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'token' => $this->token,
        ];
    }
}
