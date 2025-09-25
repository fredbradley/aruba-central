<?php

declare(strict_types=1);

namespace FredBradley\ArubaCentral;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class ArubaTokenStore
{
    public static function get(): ?string
    {
        /** @var string|null $token */
        $token = Cache::get('aruba_token');

        return $token;
    }

    public static function put(string $accessToken, string $refreshToken, int $expiresIn): void
    {
        Cache::put('aruba_token', $accessToken, now()->addSeconds($expiresIn - 30));
        Cache::forever('aruba_refresh', $refreshToken);
        self::reveal();
    }

    public static function refresh(): ?string
    {
        $tokenFile = storage_path('aruba_token.txt');

        /** @var string|null $cacheToken */
        $cacheToken = Cache::get('aruba_refresh');

        /** @var string|null $fileToken */
        $fileToken = File::exists($tokenFile) ? json_decode(File::get($tokenFile)) : null;

        return $cacheToken ?? $fileToken ?? config('aruba.refresh_token');
    }

    public static function reveal(): array
    {
        $result = [
            'access_token' => self::get(),
            'refresh_token' => self::refresh(),
        ];

        File::put(storage_path('aruba_token.txt'), json_encode(self::refresh()));

        return $result;
    }
}
