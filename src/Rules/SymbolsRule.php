<?php

namespace Helldar\StrongPassword\Rules;

use Helldar\StrongPassword\Contracts\Rule;

final class SymbolsRule implements Rule
{
    public static function passes($value = null): bool
    {
        return (bool) preg_match('/\p{Z}|\p{S}|\p{P}/', $value);
    }

    public static function message(): string
    {
        return trans('strong-password::validation.symbols');
    }
}
