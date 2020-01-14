<?php

namespace Helldar\StrongPassword\Rules;

use Helldar\StrongPassword\Contracts\Rule;

class LettersRule implements Rule
{
    public static function passes($value = null): bool
    {
        return (bool) preg_match('/\pL/', $value);
    }

    public static function message(): string
    {
        return trans('strong-password::validation.letters');
    }
}
