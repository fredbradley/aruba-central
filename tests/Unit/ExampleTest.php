<?php

use FredBradley\ArubaCentral\ArubaTokenStore;

test('that true is true', function () {
    expect(true)->toBeTrue();
});

it('caches some data', function () {
    cache()->put('foo', 'bar');

    expect(cache()->get('foo'))->toBe('bar');
});

it('can access config', function () {
    config(['my-package.enabled' => true]);

    expect(config('my-package.enabled'))->toBeTrue();
});

it('stores aruba cache data', function () {
    ArubaTokenStore::put('access-token', 'refresh-token', 3600);

    expect(ArubaTokenStore::get())->toBe('access-token')
        ->and(ArubaTokenStore::refresh())->toBe('refresh-token');
});
it('loads the service', function () {
    $service = app(\FredBradley\ArubaCentral\ArubaCentralService::class);

    expect($service)->toBeInstanceOf(\FredBradley\ArubaCentral\ArubaCentralService::class);
    expect($service->accessPoints())->toBeInstanceOf(\FredBradley\ArubaCentral\Resources\AccessPointResource::class);
    expect($service->wirelessClients())->toBeInstanceOf(\FredBradley\ArubaCentral\Resources\ConnectedWirelessClientResource::class);
});
