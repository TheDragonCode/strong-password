<?php

namespace Helldar\StrongPassword\Rules;

use Helldar\StrongPassword\Contracts\Rule;

class StrongRule implements Rule
{
    public static function passes($value = null): bool
    {
        /**
         * @var string
         * @var \Helldar\StrongPassword\Contracts\Rule $rule
         */
        foreach (static::rules() as $name => $rule) {
            if (!$rule::passes($value)) {
                return false;
            }
        }

        return true;
    }

    public static function message(): string
    {
        return trans('strong-password::validation.strong');
    }

    protected static function rules(): array
    {
        return array_filter(Rules::ALL, function ($rule) {
            return $rule !== self::class;
        });
    }
}
