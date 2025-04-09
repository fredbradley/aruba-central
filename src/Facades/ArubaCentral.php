<?php

declare(strict_types=1);

namespace FredBradley\ArubaCentral\Facades;

class ArubaCentral extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'aruba';
    }
}
