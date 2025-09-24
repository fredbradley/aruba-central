<?php

declare(strict_types=1);

namespace FredBradley\ArubaCentral;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\PendingRequest;

class ArubaAuthenticator implements Authenticator
{
    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function set(PendingRequest $pendingRequest): void
    {
        $token = $this->getValidToken();

        (new TokenAuthenticator($token))->set($pendingRequest);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    private function getValidToken(): string
    {
        $token = ArubaTokenStore::get();

        if (! $token) {
            $this->refreshToken();
            $token = ArubaTokenStore::get();
        }

        return $token;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function refreshToken(): void
    {
        $refreshToken = ArubaTokenStore::refresh();

        $response = Http::asForm()->post(config('aruba.base_url').'/oauth2/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id' => config('aruba.client_id'),
            'client_secret' => config('aruba.client_secret'),
        ])->throw();

        $data = $response->json();

        ArubaTokenStore::put($data['access_token'], $data['refresh_token'], $data['expires_in']);
    }
}
