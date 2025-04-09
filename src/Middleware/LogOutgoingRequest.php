<?php

declare(strict_types=1);

namespace FredBradley\ArubaCentral\Middleware;

use Illuminate\Support\Facades\Log;
use Saloon\Contracts\RequestMiddleware;
use Saloon\Http\PendingRequest;

class LogOutgoingRequest implements RequestMiddleware
{
    public function __invoke(PendingRequest $pendingRequest): void
    {
        Log::info('[Saloon] Sending request to '.$pendingRequest->getUrl());
    }

}
