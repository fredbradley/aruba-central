<?php

use FredBradley\ArubaCentral\ArubaCentralConnector;
use Saloon\Contracts\Authenticator;

beforeEach(function () {
    // Create a new instance of the ArubaCentralConnector for testing
    $this->connector = new ArubaCentralConnector(
        'client-id',
        'client-secret',
        'https://api.example.com'
    );
});

it('returns the correct base URL', function () {
    $baseUrl = $this->connector->resolveBaseUrl();
    expect($baseUrl)->toBe('https://api.example.com');
});

it('returns the correct default headers', function () {
    $headers = $this->connector->headers()->all();
    expect($headers)->toBe([
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ]);
});

it('returns the correct default authenticator', function () {
    $authenticator = $this->connector->getAuthenticator();
    expect($authenticator)->toBeInstanceOf(Authenticator::class);
    expect($authenticator)->toBeInstanceOf(\FredBradley\ArubaCentral\ArubaAuthenticator::class);
});
