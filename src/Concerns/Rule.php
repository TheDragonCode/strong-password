<?php

namespace Helldar\StrongPassword\Concerns;

use Helldar\StrongPassword\Contracts\Rule as RuleContract;
use Helldar\StrongPassword\Facades\Number;

abstract class Rule implements RuleContract
{
    protected static function translateLength(): string
    {
        return Number::toWords(
            self::length()
        );
    }

    protected static function length(): int
    {
        $value = (int) config('strong-password.min_length', 10);

        return $value >= 10 ? $value : 10;
    }
}
