<?php

namespace Helldar\StrongPassword\Facades;

use Helldar\StrongPassword\Support\Number as Support;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string toWords($value)
 */
class Number extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Support::class;
    }
}
