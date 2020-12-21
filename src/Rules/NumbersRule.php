<?php

namespace Helldar\StrongPassword\Rules;

use Helldar\StrongPassword\Contracts\Rule;

final class NumbersRule implements Rule
{
    public static function passes($value = null): bool
    {
        return (bool) preg_match('/\pN/', $value);
    }

    public static function message(): string
    {
        return trans('strong-password::validation.numbers');
    }
}
