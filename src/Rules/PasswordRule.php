<?php

namespace Helldar\StrongPassword\Rules;

class PasswordRule
{
    const AVAILABLE = ['letters', 'numbers', 'case_diff', 'symbols', 'strong'];

    public static function letters($value): bool
    {
        return (bool) \preg_match('/\pL/', $value);
    }

    public static function numbers($value): bool
    {
        return (bool) \preg_match('/\pN/', $value);
    }

    public static function caseDiff($value): bool
    {
        return (bool) \preg_match('/(\p{Ll}+.*\p{Lu})|(\p{Lu}+.*\p{Ll})/u', $value);
    }

    public static function symbols($value): bool
    {
        return (bool) \preg_match('/\p{Z}|\p{S}|\p{P}/', $value);
    }

    public static function strong($value): bool
    {
        return self::letters($value)
            && self::numbers($value)
            && self::caseDiff($value)
            && self::symbols($value);
    }
}
