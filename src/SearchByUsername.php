<?php

namespace FredBradley\ArubaCentral;

use FredBradley\ArubaCentral\Requests\ListAccessPointsRequest;
use FredBradley\ArubaCentral\Requests\ListConnectedWirelessClients;
use Illuminate\Support\Collection;

class SearchByUsername
{
    public string $username;

    public Collection $connectedAps;

    public function __construct(private readonly ArubaCentralConnector $connector)
    {
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function search(string $username): Collection
    {
        $this->setUsername($username);

        $request = new ListConnectedWirelessClients();

        $results = collect();
        foreach ($this->connector->paginate($request)->items() as $client) {
            $results->push($client);
        }

        $this->connectedAps = $results->filter(function ($client) {
            return str_contains(strtolower($client['username']), strtolower($this->username));
        });

        return $this->connectedAps;

    }

    public function getAccessPoints(): Collection
    {
        $macAddresses = $this->connectedAps->pluck('macAddr');
        $results = collect();
        foreach ($macAddresses->unique() as $macaddr) {
            $request = new ListAccessPointsRequest(compact('macaddr'));
            $results->push($this->connector->send($request)->throw()->dto());
        }

        return $results;
    }
}
