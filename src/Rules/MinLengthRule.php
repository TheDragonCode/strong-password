<?php

namespace Helldar\StrongPassword\Rules;

use Helldar\StrongPassword\Concerns\Rule;
use Helldar\StrongPassword\Contracts\Rule as RuleContract;
use Illuminate\Support\Str;

final class MinLengthRule extends Rule implements RuleContract
{
    public static function passes($value = null): bool
    {
        return Str::length((string) $value) >= static::length();
    }

    public static function message(): string
    {
        return trans('strong-password::validation.min_length', ['length' => static::translateLength()]);
    }
}
