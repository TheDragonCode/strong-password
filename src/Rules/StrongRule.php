<?php

namespace Helldar\StrongPassword\Rules;

use Helldar\StrongPassword\Concerns\Rule;
use Helldar\StrongPassword\Contracts\Rule as RuleContract;

final class StrongRule extends Rule implements RuleContract
{
    public static function passes($value = null): bool
    {
        foreach (static::rules() as $name => $rule) {
            if (! $rule::passes($value)) {
                return false;
            }
        }

        return true;
    }

    public static function message(): string
    {
        return trans('strong-password::validation.strong', ['length' => static::translateLength()]);
    }

    protected static function rules(): array
    {
        return array_filter(Rules::ALL, function ($rule) {
            return $rule !== self::class;
        });
    }
}
