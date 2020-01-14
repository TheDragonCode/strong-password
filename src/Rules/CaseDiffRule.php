<?php

namespace Helldar\StrongPassword\Rules;

use Helldar\StrongPassword\Contracts\Rule;

class CaseDiffRule implements Rule
{
    public static function passes($value = null): bool
    {
        return (bool) preg_match('/(\p{Ll}+.*\p{Lu})|(\p{Lu}+.*\p{Ll})/u', $value);
    }

    public static function message(): string
    {
        return trans('strong-password::validation.case_diff');
    }
}
