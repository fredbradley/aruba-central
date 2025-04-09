<?php

namespace FredBradley\ArubaCentral\Resources;

use FredBradley\ArubaCentral\ArubaCentralConnector;
use FredBradley\ArubaCentral\Requests\ListConnectedWirelessClients;
use Illuminate\Support\Collection;
use ReflectionException;
use Throwable;

class ConnectedWirelessClientResource
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
     * @throws Throwable
     */
    public function all(): Collection
    {
        $pages = $this->connector->paginate(
            new ListConnectedWirelessClients()
        );

        $results = collect();
        foreach ($pages->items() as $client) {
            $results->push($client);
        }

        return $results->unique();
    }

    /**
     * @throws ReflectionException
     * @throws Throwable
     */
    public function findUser(string $username): Collection
    {
        return $this->all()->filter(function ($client) use ($username) {
            return str_contains(strtolower($client->connectedUser), strtolower($username));
        });
    }

    // Add methods like `find($mac)`, `byLabel($label)` etc.
}
