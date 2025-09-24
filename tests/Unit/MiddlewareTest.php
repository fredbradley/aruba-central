<?php

use FredBradley\ArubaCentral\Middleware\LogOutgoingRequest;
use Illuminate\Support\Facades\Log;
use Saloon\Http\PendingRequest;

it('logs the outgoing request URL correctly', function () {
    // Mock the Log facade to intercept log calls
    Log::spy();

    // Create a mock PendingRequest object
    $pendingRequest = \Mockery::mock(PendingRequest::class);
    $pendingRequest->shouldReceive('getUrl')
        ->once()
        ->andReturn('https://api.example.com/v1/data'); // Example URL

    // Instantiate the middleware
    $middleware = new LogOutgoingRequest;

    // Call the middleware with the mock pending request
    $middleware($pendingRequest);

    // Assert that the Log facade was called with the correct message
    Log::shouldHaveReceived('info')
        ->once()
        ->with('[Saloon] Sending request to https://api.example.com/v1/data');
});

it('logs correctly for outgoing different URLs', function () {
    // Mock the Log facade to intercept log calls
    Log::spy();

    // Create another mock PendingRequest object
    $pendingRequest = \Mockery::mock(PendingRequest::class);
    $pendingRequest->shouldReceive('getUrl')
        ->once()
        ->andReturn('https://api.example.com/v1/other-endpoint'); // Another example URL

    // Instantiate the middleware
    $middleware = new LogOutgoingRequest;

    // Call the middleware with the mock pending request
    $middleware($pendingRequest);

    // Assert that the Log facade was called with the correct message
    Log::shouldHaveReceived('info')
        ->once()
        ->with('[Saloon] Sending request to https://api.example.com/v1/other-endpoint');
});
