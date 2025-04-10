<?php

declare(strict_types=1);

namespace FredBradley\ArubaCentral\Resources;

use FredBradley\ArubaCentral\Requests\ListConnectedWirelessClients;
use Illuminate\Support\Collection;
use ReflectionException;
use Throwable;

final class ConnectedWirelessClientResource extends BaseResource
{
    /**
     * @throws Throwable
     */
    public function all(): Collection
    {
        $pages = $this->connector->paginate(
            new ListConnectedWirelessClients
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
        return $this->all()->filter(static function ($client) use ($username) {
            return str_contains(strtolower($client->connectedUser), strtolower($username));
        });
    }

    // Add methods like `find($mac)`, `byLabel($label)` etc.
}
