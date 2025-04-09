<?php

declare(strict_types=1);

namespace FredBradley\ArubaCentral\DataTransferObjects;

use Carbon\Carbon;

readonly class AccessPoint
{
    /**
     * @param  array<string>  $labels
     */
    public function __construct(
        public string $serial,
        public ?string $notes,
        public string $name,
        public string $macaddr,
        public string $ip_address,
        public string $model,
        public string $firmware_version,
        public array $labels,
        public Carbon $last_modified,
    ) {
    }
}
