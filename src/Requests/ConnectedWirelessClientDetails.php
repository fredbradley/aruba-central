<?php

declare(strict_types=1);

namespace FredBradley\ArubaCentral\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ConnectedWirelessClientDetails extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function __construct(protected string $macAddr) {}

    public function resolveEndpoint(): string
    {
        return "/monitoring/v1/clients/wireless/{$this->macAddr}";
    }

    /**
     * @return array<string, string|int>
     */
    protected function defaultQuery(): array
    {
        return [];
    }
}
