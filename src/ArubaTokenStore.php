<?php

declare(strict_types=1);

namespace FredBradley\ArubaCentral;

use Illuminate\Support\Facades\Cache;

class ArubaTokenStore
{
    public static function get(): ?string
    {
        return Cache::get('aruba_token');
    }

    public static function put(string $accessToken, string $refreshToken, int $expiresIn): void
    {
        Cache::put('aruba_token', $accessToken, now()->addSeconds($expiresIn - 30));
        Cache::forever('aruba_refresh', $refreshToken);
    }

    public static function refresh(): ?string
    {
        if (! Cache::has('aruba_refresh')) {
            return config('aruba.refresh_token');
        }

        return Cache::get('aruba_refresh');
    }

    /**
     * Particularly useful for debugging between systems when the tokens refresh.
     * Not used in production.
     */
    public static function reveal(): array
    {
        return [
            'access_token' => self::get(),
            'refresh_token' => self::refresh(),
        ];
    }
}
