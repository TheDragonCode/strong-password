<?php

namespace Helldar\StrongPassword\Contracts;

interface Rule
{
    public static function passes($value = null): bool;

    public static function message(): string;
}
