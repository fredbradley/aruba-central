<?php

namespace FredBradley\ArubaCentral\Requests;

use Carbon\Carbon;
use FredBradley\ArubaCentral\DataTransferObjects\WirelesssClient;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListConnectedWirelessClients extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public string $resultKey = 'clients';

    public function resolveEndpoint(): string
    {
        return '/monitoring/v2/clients';
    }

    protected function defaultQuery(): array
    {
        return [
            'limit' => 50,
            'timerange' => '3M',
            'client_type' => 'WIRELESS',
            'client_status' => 'CONNECTED',
            'show_signal_db' => 'true',
        ];
    }
    public function createDtoFromResponse(Response $response): array
    {
        $data = $response->json()['clients'];

        return collect($data)->map(
            fn ($ap) => new WirelesssClient(
                apMac: $ap['associated_device_mac'],
                apName: $ap['associated_device_name'],
                hostname: $ap['hostname'],
                macaddr: $ap['macaddr'],
                ip_address: $ap['ip_address'] ?? null,
                osType: $ap['os_type'],
                network: $ap['network'],
                labels: $ap['labels'],
                signalStrength: $ap['signal_strength'] ?? null,
                last_connection_time: Carbon::parse($ap['last_connection_time'] ?? '1970-01-01'),
                connectedUser: $ap['username'],
            )
        )->toArray();
    }

}
