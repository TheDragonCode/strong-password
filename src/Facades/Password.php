<?php

namespace Helldar\StrongPassword\Facades;

use Helldar\StrongPassword\Support\Password as Support;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array validate(string $password = null)
 * @method static array|null errors(string $password = null)
 * @method static bool isAllow(string $password = null)
 */
final class Password extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Support::class;
    }
}
