<?php

declare(strict_types=1);

namespace FredBradley\ArubaCentral\Resources;

use FredBradley\ArubaCentral\ArubaCentralConnector;
use FredBradley\ArubaCentral\DataTransferObjects\AccessPoint;
use FredBradley\ArubaCentral\Requests\ListAccessPointsRequest;
use Throwable;

final class AccessPointResource
{
    private ArubaCentralConnector $connector;

    public function __construct()
    {
        $this->connector = new ArubaCentralConnector(
            config('aruba.client_id'),
            config('aruba.client_secret'),
            config('aruba.base_url')
        );
    }

    /**
     * @return array<AccessPoint>
     *
     * @throws Throwable
     */
    public function all(): array
    {
        return $this->connector->send(new ListAccessPointsRequest)->dto();
    }

    public function findByMacAddress(string $macAddress): ?AccessPoint
    {
        $response = $this->connector->send(new ListAccessPointsRequest(['macaddr' => $macAddress]));

        $data = $response->dto();

        return $data ? $data[0] : null;
    }

    // Add methods like `find($mac)`, `byLabel($label)` etc.
}
