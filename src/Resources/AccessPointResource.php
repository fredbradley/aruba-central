<?php

namespace FredBradley\ArubaCentral\Resources;

use FredBradley\ArubaCentral\ArubaCentralConnector;
use FredBradley\ArubaCentral\DataTransferObjects\AccessPoint;
use FredBradley\ArubaCentral\Requests\ListAccessPointsRequest;
use ReflectionException;
use Throwable;

class AccessPointResource
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
     * @throws ReflectionException
     * @throws Throwable
     */
    public function all(): array
    {

        /** @var AccessPoint[] $aps */
        $aps = $this->connector->send(new ListAccessPointsRequest())->dto();

        return $aps;
    }

    public function findByMacAddress(string $macAddress): ?AccessPoint
    {
        $response = $this->connector->send(new ListAccessPointsRequest(['macaddr' => $macAddress]));

        $data = $response->dto();
        return $data ? $data[0] : null;
    }



    // Add methods like `find($mac)`, `byLabel($label)` etc.
}
