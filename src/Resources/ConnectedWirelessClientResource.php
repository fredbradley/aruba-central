<?php

declare(strict_types=1);

namespace FredBradley\ArubaCentral\Resources;

use FredBradley\ArubaCentral\DataTransferObjects\WirelessClient;
use FredBradley\ArubaCentral\Requests\ListConnectedWirelessClients;
use Illuminate\Support\Collection;
use ReflectionException;
use Throwable;

final class ConnectedWirelessClientResource extends BaseResource
{
    protected string $username;

    /**
     * @return Collection<int, WirelessClient>
     *
     * @throws Throwable
     */
    public function all(): Collection
    {
        $pages = $this->connector->paginate(
            new ListConnectedWirelessClients($this->username)
        );

        $results = collect();
        foreach ($pages->items() as $client) {
            $results->push($client);
        }

        return $results->unique();
    }

    private function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return Collection<int, WirelessClient>
     *
     * @throws ReflectionException
     * @throws Throwable
     */
    public function findUser(string $username): Collection
    {
        $this->setUsername($username);

        return $this->all()->filter(function (WirelessClient $client) {
            if (is_string($client->connectedUser) === false) {
                return false;
            }

            return strtolower($client->connectedUser) === strtolower($this->username);
        });
    }

    // Add methods like `find($mac)`, `byLabel($label)` etc.
}
