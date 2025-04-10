<?php
use Carbon\Carbon;
use FredBradley\ArubaCentral\DataTransferObjects\WirelessClient;

it('creates a WirelessClient object with valid data', function () {
    $lastConnectionTime = Carbon::now();

    $wirelessClient = new WirelessClient(
        apMac: '00:1A:2B:3C:4D:5E',
        apName: 'AP-1',
        hostname: 'Client-1',
        macaddr: '00:1A:2B:3C:4D:5F',
        ip_address: '192.168.1.2',
        osType: 'Linux',
        network: 'Network1',
        labels: ['Label1', 'Label2'],
        signalStrength: 5,
        last_connection_time: $lastConnectionTime,
        connectedUser: 'user1'
    );

    expect($wirelessClient->apMac)->toBe('00:1A:2B:3C:4D:5E');
    expect($wirelessClient->apName)->toBe('AP-1');
    expect($wirelessClient->hostname)->toBe('Client-1');
    expect($wirelessClient->macaddr)->toBe('00:1A:2B:3C:4D:5F');
    expect($wirelessClient->ip_address)->toBe('192.168.1.2');
    expect($wirelessClient->osType)->toBe('Linux');
    expect($wirelessClient->network)->toBe('Network1');
    expect($wirelessClient->labels)->toBe(['Label1', 'Label2']);
    expect($wirelessClient->signalStrength)->toBe(5);
    expect($wirelessClient->last_connection_time)->toBeInstanceOf(Carbon::class);
    expect($wirelessClient->connectedUser)->toBe('user1');
});

it('handles nullable apName correctly', function () {
    $lastConnectionTime = Carbon::now();

    $wirelessClient = new WirelessClient(
        apMac: '00:1A:2B:3C:4D:5E',
        apName: null,
        hostname: 'Client-1',
        macaddr: '00:1A:2B:3C:4D:5F',
        ip_address: '192.168.1.2',
        osType: 'Linux',
        network: 'Network1',
        labels: ['Label1'],
        signalStrength: 3,
        last_connection_time: $lastConnectionTime,
        connectedUser: 'user1'
    );

    expect($wirelessClient->apName)->toBeNull();
});

it('handles nullable ip_address correctly', function () {
    $lastConnectionTime = Carbon::now();

    $wirelessClient = new WirelessClient(
        apMac: '00:1A:2B:3C:4D:5E',
        apName: 'AP-1',
        hostname: 'Client-1',
        macaddr: '00:1A:2B:3C:4D:5F',
        ip_address: null,
        osType: 'Linux',
        network: 'Network1',
        labels: ['Label1'],
        signalStrength: 4,
        last_connection_time: $lastConnectionTime,
        connectedUser: 'user2'
    );

    expect($wirelessClient->ip_address)->toBeNull();
});

it('ensures labels is an array', function () {
    $lastConnectionTime = Carbon::now();

    $wirelessClient = new WirelessClient(
        apMac: '00:1A:2B:3C:4D:5E',
        apName: 'AP-1',
        hostname: 'Client-1',
        macaddr: '00:1A:2B:3C:4D:5F',
        ip_address: '192.168.1.2',
        osType: 'Linux',
        network: 'Network1',
        labels: ['Label1', 'Label2'],
        signalStrength: 5,
        last_connection_time: $lastConnectionTime,
        connectedUser: 'user3'
    );

    expect($wirelessClient->labels)->toBeArray();
});

it('ensures signalStrength is nullable', function () {
    $lastConnectionTime = Carbon::now();

    $wirelessClient = new WirelessClient(
        apMac: '00:1A:2B:3C:4D:5E',
        apName: 'AP-1',
        hostname: 'Client-1',
        macaddr: '00:1A:2B:3C:4D:5F',
        ip_address: '192.168.1.2',
        osType: 'Linux',
        network: 'Network1',
        labels: ['Label1'],
        signalStrength: null,
        last_connection_time: $lastConnectionTime,
        connectedUser: 'user4'
    );

    expect($wirelessClient->signalStrength)->toBeNull();
});

it('ensures last_connection_time is a Carbon instance', function () {
    $lastConnectionTime = Carbon::now();

    $wirelessClient = new WirelessClient(
        apMac: '00:1A:2B:3C:4D:5E',
        apName: 'AP-1',
        hostname: 'Client-1',
        macaddr: '00:1A:2B:3C:4D:5F',
        ip_address: '192.168.1.2',
        osType: 'Linux',
        network: 'Network1',
        labels: ['Label1'],
        signalStrength: 4,
        last_connection_time: $lastConnectionTime,
        connectedUser: 'user5'
    );

    expect($wirelessClient->last_connection_time)->toBeInstanceOf(Carbon::class);
});

it('handles nullable connectedUser correctly', function () {
    $lastConnectionTime = Carbon::now();

    $wirelessClient = new WirelessClient(
        apMac: '00:1A:2B:3C:4D:5E',
        apName: 'AP-1',
        hostname: 'Client-1',
        macaddr: '00:1A:2B:3C:4D:5F',
        ip_address: '192.168.1.2',
        osType: 'Linux',
        network: 'Network1',
        labels: ['Label1'],
        signalStrength: 2,
        last_connection_time: $lastConnectionTime,
        connectedUser: null
    );

    expect($wirelessClient->connectedUser)->toBeNull();
});
