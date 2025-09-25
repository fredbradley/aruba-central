<?php

namespace FredBradley\ArubaCentral\Resources;

use FredBradley\ArubaCentral\ArubaCentralConnector;

abstract class BaseResource implements Resourceable
{
    protected ArubaCentralConnector $connector;

    public function __construct()
    {
        $clientId = config('aruba.client_id');
        $clientSecret = config('aruba.client_secret');
        $baseUrl = config('aruba.base_url');

        if (! is_string($clientId) || ! is_string($clientSecret) || ! is_string($baseUrl)) {
            throw new \InvalidArgumentException('Aruba config values must be strings.');
        }
        $this->connector = new ArubaCentralConnector(
            $clientId,
            $clientSecret,
            $baseUrl
        );
    }
}
