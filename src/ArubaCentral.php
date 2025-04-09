<?php

declare(strict_types=1);

namespace FredBradley\ArubaCentral;

use FredBradley\ArubaCentral\Resources\AccessPointResource;
use FredBradley\ArubaCentral\Resources\ConnectedWirelessClientResource;

class ArubaCentral
{
    public static function accessPoints(): AccessPointResource
    {
        return app(ArubaCentralService::class)->accessPoints();
    }

    public static function wirelessClients(): ConnectedWirelessClientResource
    {
        return app(ArubaCentralService::class)->wirelessClients();
    }
}
