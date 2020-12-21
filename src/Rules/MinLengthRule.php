<?php

namespace Helldar\StrongPassword\Rules;

use Helldar\StrongPassword\Contracts\Rule;
use Illuminate\Support\Str;

final class MinLengthRule implements Rule
{
    public static function passes($value = null): bool
    {
        return Str::length((string) $value) >= 10;
    }

    public static function message(): string
    {
        return trans('strong-password::validation.min_length');
    }
}
