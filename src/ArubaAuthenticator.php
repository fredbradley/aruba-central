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
    public function set(PendingRequest $request): void
    {
        $token = ArubaTokenStore::get();
        if (! $token) {
            $token = $this->refreshToken();
        }
        (new TokenAuthenticator($token))->set($request);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    protected function refreshToken(): string
    {
        $refreshToken = ArubaTokenStore::refresh() ?? config('aruba.refresh_token');

        $response = Http::asForm()->post(config('aruba.base_url').'/oauth2/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id' => config('aruba.client_id'),
            'client_secret' => config('aruba.client_secret'),
        ])->throw();

        $data = $response->json();

        ArubaTokenStore::put($data['access_token'], $data['refresh_token'], $data['expires_in']);

        return $data['access_token'];
    }
}
