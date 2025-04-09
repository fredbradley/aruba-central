<?php

namespace FredBradley\ArubaCentral\Requests;

use Carbon\Carbon;
use FredBradley\ArubaCentral\DataTransferObjects\AccessPoint;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\RequestProperties\HasQuery;

class ListAccessPointsRequest extends Request
{
    use HasQuery;

    protected Method $method = Method::GET;

    public string $resultKey = 'aps';

    public function __construct(protected array $customQuery = [])
    {
    }

    public function resolveEndpoint(): string
    {
        return 'monitoring/v2/aps';
    }

    protected function defaultQuery(): array
    {
        return array_merge($this->customQuery, [
            'limit' => 1000, // this is the MAX as per the documentation
            'fields' => 'status,macaddr,ip_address,model,firmware_version,labels,last_modified,notes',
        ]);
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json()['aps'];

        return collect($data)->map(
            fn ($ap) => new AccessPoint(
                serial: $ap['serial'],
                notes: $ap['notes'],
                name: $ap['name'],
                macaddr: $ap['macaddr'],
                ip_address: $ap['ip_address'],
                model: $ap['model'],
                firmware_version: $ap['firmware_version'],
                labels: $ap['labels'],
                last_modified: Carbon::parse($ap['last_modified']),
            )
        )->all();
    }
}
