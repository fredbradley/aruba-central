<?php

declare(strict_types=1);

namespace FredBradley\ArubaCentral;

use FredBradley\ArubaCentral\Resources\AccessPointResource;
use FredBradley\ArubaCentral\Resources\ConnectedWirelessClientResource;

class ArubaCentralService
{
    public function accessPoints(): AccessPointResource
    {
        return new AccessPointResource();
    }

    public function wirelessClients(): ConnectedWirelessClientResource
    {
        return new ConnectedWirelessClientResource();
    }
}
