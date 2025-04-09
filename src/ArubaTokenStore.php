<?php

namespace FredBradley\ArubaCentral;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ArubaTokenStore
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function get(): ?string
    {
        return cache()->get('aruba_token');
    }

    public static function put(string $accessToken, string $refreshToken, int $expiresIn): void
    {
        cache()->put('aruba_token', $accessToken, now()->addSeconds($expiresIn - 30));
        cache()->put('aruba_refresh', $refreshToken);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function refresh(): ?string
    {
        return cache()->get('aruba_refresh');
    }
}
