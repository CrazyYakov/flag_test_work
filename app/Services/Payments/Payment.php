<?php

namespace App\Services\Payments;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;

class Payment
{
    protected static string $tokenKey;

    protected static string $alg;

    public static function setTokenKey(string $tokenKey): void
    {
        self::$tokenKey = $tokenKey;
    }

    public static function setAlg(string $alg): void
    {
        self::$alg = $alg;
    }

    public static function encodeToken(array $payload): string
    {
        return JWT::encode($payload, static::$tokenKey, static::$alg);
    }

    public static function decodeToken(string $token): stdClass
    {
        return JWT::decode($token, new Key(static::$tokenKey, static::$alg));
    }
}
