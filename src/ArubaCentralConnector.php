<?php

declare(strict_types=1);

namespace FredBradley\ArubaCentral;

use FredBradley\ArubaCentral\Middleware\LogIncomingResponse;
use FredBradley\ArubaCentral\Middleware\LogOutgoingRequest;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\PaginationPlugin\OffsetPaginator;
use Saloon\PaginationPlugin\Paginator;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

class ArubaCentralConnector extends Connector implements HasPagination
{
    use AlwaysThrowOnErrors;

    public function __construct(
        private readonly string $clientId,
        private readonly string $clientSecret,
        private readonly string $baseUrl,
    ) {
        $this->middleware()->onRequest(new LogOutgoingRequest());
        $this->middleware()->onResponse(new LogIncomingResponse());
    }

    public function paginate(Request $request): Paginator
    {
        return new class ($this, $request) extends OffsetPaginator {
            protected ?int $perPageLimit = 1000;

            protected function isLastPage(Response $response): bool
            {
                return $this->getOffset() >= (int) $response->json('total');
            }

            /**
             * @return array<array-key, string|int>
             */
            protected function getPageItems(Response $response, Request $request): array
            {
                return $response->dto() ?? [];
            }
        };
    }

    public function resolveBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @return array<array-key, string>
     */
    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    protected function defaultAuth(): ?Authenticator
    {
        return new ArubaAuthenticator();
    }
}
