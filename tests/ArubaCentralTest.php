<?php

use FredBradley\ArubaCentral\ArubaCentral;
use FredBradley\ArubaCentral\ArubaCentralService;
use FredBradley\ArubaCentral\Resources\AccessPointResource;
use FredBradley\ArubaCentral\Resources\ConnectedWirelessClientResource;

it('returns an instance of AccessPointResource from accessPoints', function () {
    $mockService = mock(ArubaCentralService::class)
        ->shouldReceive('accessPoints')
        ->andReturn(new AccessPointResource)
        ->getMock();

    app()->instance(ArubaCentralService::class, $mockService);

    $result = ArubaCentral::accessPoints();

    expect($result)->toBeInstanceOf(AccessPointResource::class);
});

it('returns an instance of ConnectedWirelessClientResource from wirelessClients', function () {
    $mockService = mock(ArubaCentralService::class)
        ->shouldReceive('wirelessClients')
        ->andReturn(new ConnectedWirelessClientResource)
        ->getMock();

    app()->instance(ArubaCentralService::class, $mockService);

    $result = ArubaCentral::wirelessClients();

    expect($result)->toBeInstanceOf(ConnectedWirelessClientResource::class);
});
