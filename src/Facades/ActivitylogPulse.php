<?php

namespace Ejntaylor\ActivitylogPulse\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ejntaylor\ActivitylogPulse\ActivitylogPulse
 */
class ActivitylogPulse extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Ejntaylor\ActivitylogPulse\ActivitylogPulse::class;
    }
}
