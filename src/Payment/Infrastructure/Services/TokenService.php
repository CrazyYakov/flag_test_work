<?php

namespace Marketplace\Payment\Infrastructure\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;

class TokenService
{
    public function __construct(
        private readonly string $tokenKey,
        private readonly string $alg,
    ) {}

    public function encodeToken(array $payload): string
    {
        return JWT::encode($payload, $this->tokenKey, $this->alg);
    }

    public function decodeToken(string $token): stdClass
    {
        return JWT::decode($token, new Key($this->tokenKey, $this->alg));
    }
}
