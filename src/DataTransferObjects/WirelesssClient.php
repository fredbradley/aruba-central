<?php

declare(strict_types=1);

namespace FredBradley\ArubaCentral\DataTransferObjects;

use Carbon\Carbon;

readonly class WirelesssClient
{
    /**
     * @param  array<string>  $labels
     */
    public function __construct(
        public string $apMac,
        public ?string $apName,
        public string $hostname,
        public string $macaddr,
        public ?string $ip_address,
        public string $osType,
        public string $network,
        public array $labels,
        public ?int $signalStrength, // 1 not very good, 5 pretty bloomin awesome
        public Carbon $last_connection_time,
        public ?string $connectedUser,
    ) {}
}
