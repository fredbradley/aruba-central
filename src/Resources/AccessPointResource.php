<?php

declare(strict_types=1);

namespace FredBradley\ArubaCentral\Resources;

use FredBradley\ArubaCentral\DataTransferObjects\AccessPoint;
use FredBradley\ArubaCentral\Requests\ListAccessPointsRequest;
use Illuminate\Support\Collection;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

final class AccessPointResource extends BaseResource
{
    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function all(): Collection
    {
        return collect($this->connector->send(new ListAccessPointsRequest)->dto());
    }

    public function findByMacAddress(string $macAddress): ?AccessPoint
    {
        $response = $this->connector->send(new ListAccessPointsRequest(['macaddr' => $macAddress]));

        $data = $response->dto();

        return $data ? $data[0] : null;
    }

    // Add methods like `find($mac)`, `byLabel($label)` etc.
}
