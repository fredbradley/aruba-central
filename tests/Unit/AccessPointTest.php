<?php

use Carbon\Carbon;
use FredBradley\ArubaCentral\DataTransferObjects\AccessPoint;

it('creates an AccessPoint object with valid data', function () {
    $lastModified = Carbon::now();

    $accessPoint = new AccessPoint(
        serial: '1234567890',
        notes: 'Test note',
        name: 'AccessPoint 1',
        macaddr: '00:1A:2B:3C:4D:5E',
        ip_address: '192.168.1.1',
        model: 'ModelX',
        firmware_version: 'v1.2.3',
        labels: ['Label1', 'Label2'],
        last_modified: $lastModified
    );

    expect($accessPoint->serial)->toBe('1234567890');
    expect($accessPoint->notes)->toBe('Test note');
    expect($accessPoint->name)->toBe('AccessPoint 1');
    expect($accessPoint->macaddr)->toBe('00:1A:2B:3C:4D:5E');
    expect($accessPoint->ip_address)->toBe('192.168.1.1');
    expect($accessPoint->model)->toBe('ModelX');
    expect($accessPoint->firmware_version)->toBe('v1.2.3');
    expect($accessPoint->labels)->toBe(['Label1', 'Label2']);
    expect($accessPoint->last_modified)->toBeInstanceOf(Carbon::class);
});

it('handles nullable notes correctly', function () {
    $lastModified = Carbon::now();

    $accessPoint = new AccessPoint(
        serial: '1234567890',
        notes: null,
        name: 'AccessPoint 1',
        macaddr: '00:1A:2B:3C:4D:5E',
        ip_address: '192.168.1.1',
        model: 'ModelX',
        firmware_version: 'v1.2.3',
        labels: ['Label1'],
        last_modified: $lastModified
    );

    expect($accessPoint->notes)->toBeNull();
});

it('requires labels to be an array', function () {
    $lastModified = Carbon::now();

    $accessPoint = new AccessPoint(
        serial: '1234567890',
        notes: 'Some note',
        name: 'AccessPoint 1',
        macaddr: '00:1A:2B:3C:4D:5E',
        ip_address: '192.168.1.1',
        model: 'ModelX',
        firmware_version: 'v1.2.3',
        labels: ['Label1'],
        last_modified: $lastModified
    );

    expect($accessPoint->labels)->toBeArray();
});

it('ensures last_modified is a Carbon instance', function () {
    $lastModified = Carbon::now();

    $accessPoint = new AccessPoint(
        serial: '1234567890',
        notes: 'Some note',
        name: 'AccessPoint 1',
        macaddr: '00:1A:2B:3C:4D:5E',
        ip_address: '192.168.1.1',
        model: 'ModelX',
        firmware_version: 'v1.2.3',
        labels: ['Label1'],
        last_modified: $lastModified
    );

    expect($accessPoint->last_modified)->toBeInstanceOf(Carbon::class);
});
