<?php

declare(strict_types=1);

namespace FredBradley\ArubaCentral\Middleware;

use Illuminate\Support\Facades\Log;
use Saloon\Contracts\ResponseMiddleware;
use Saloon\Http\Response;

class LogIncomingResponse implements ResponseMiddleware
{
    public function __invoke(Response $response): void
    {
        Log::info('[Saloon] Got response with status ' . $response->status());
    }

}
