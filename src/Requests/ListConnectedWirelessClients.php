<?php

declare(strict_types=1);

namespace FredBradley\ArubaCentral\Requests;

use Carbon\Carbon;
use FredBradley\ArubaCentral\DataTransferObjects\WirelessClient;
use JsonException;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListConnectedWirelessClients extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function __construct(protected string $username) {}

    public function resolveEndpoint(): string
    {
        return '/monitoring/v2/clients';
    }

    /**
     * @return array<string, string|int>
     */
    protected function defaultQuery(): array
    {
        return [
            'limit' => 50,
            'timerange' => '3H', // 3 Hours
            'client_type' => 'WIRELESS', // WIRELESS, WIRED
            'client_status' => 'CONNECTED', // CONNECTED, FAILED_TO_CONNECT
            'show_signal_db' => 'true',
            'name' => $this->username,
        ];
    }

    /**
     * @return array<WirelessClient>
     *
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array $data */
        $data = $response->json()['clients'];

        /** @var array<WirelessClient> */
        return collect($data)->map(
            fn ($ap) => new WirelessClient(
                apMac: $ap['associated_device_mac'],
                apName: $ap['associated_device_name'],
                hostname: $ap['hostname'],
                macaddr: $ap['macaddr'],
                ip_address: $ap['ip_address'] ?? null,
                osType: $ap['os_type'],
                network: $ap['network'],
                labels: $ap['labels'],
                signalStrength: $ap['signal_strength'] ?? null,
                last_connection_time: Carbon::parse($this->convertToUnixTimestamp($ap['last_connection_time']) ?? '1970-01-01'),
                connectedUser: $ap['username'],
            )
        )->toArray();
    }

    /**
     * Convert the timestamp to a Unix timestamp.
     */
    private function convertToUnixTimestamp(int $timestamp): int
    {
        return (int) substr(trim((string) $timestamp), 0, -3);
    }
}
