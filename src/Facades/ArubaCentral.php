<?php

namespace FredBradley\ArubaCentral\Facades;

class ArubaCentral extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return 'aruba';
    }
}
