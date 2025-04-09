<?php

namespace FredBradley\ArubaCentral\Resources;

use FredBradley\ArubaCentral\ArubaCentralConnector;

abstract class BaseResource implements Resourceable
{
    protected ArubaCentralConnector $connector;

    public function __construct()
    {
        $this->connector = new ArubaCentralConnector(
            config('aruba.client_id'),
            config('aruba.client_secret'),
            config('aruba.base_url')
        );
    }
}
