<?php

namespace Helldar\StrongPassword\Rules;

use Illuminate\Support\Str;

class PasswordRule
{
    public static function letters($value): bool
    {
        return (bool) preg_match('/\pL/', $value);
    }

    public static function numbers($value): bool
    {
        return (bool) preg_match('/\pN/', $value);
    }

    public static function caseDiff($value): bool
    {
        return (bool) preg_match('/(\p{Ll}+.*\p{Lu})|(\p{Lu}+.*\p{Ll})/u', $value);
    }

    public static function symbols($value): bool
    {
        return (bool) preg_match('/\p{Z}|\p{S}|\p{P}/', $value);
    }

    public static function minLength($value): bool
    {
        return Str::length((string) $value) >= 10;
    }

    public static function strong($value): bool
    {
        return static::letters($value)
            && static::numbers($value)
            && static::caseDiff($value)
            && static::symbols($value)
            && static::minLength($value);
    }
}
