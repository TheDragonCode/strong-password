<?php

namespace Helldar\StrongPassword;

use Helldar\StrongPassword\Exceptions\RuleDoesNotExistsException;
use Helldar\StrongPassword\Rules\PasswordRule;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Support\Str;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = false;

    public function boot(Factory $validator)
    {
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'strong-password');

        $this->validation($validator);
    }

    private function validation(Factory $validator)
    {
        \array_map(function ($rule) use ($validator) {
            $snake = Str::snake($rule);
            $camel = Str::camel($rule);

            $validator->extend("psw_{$snake}", function ($_, $value) use ($camel) {
                if (!\method_exists(PasswordRule::class, $camel)) {
                    throw new RuleDoesNotExistsException($camel);
                }

                return \call_user_func([PasswordRule::class, $camel], $value);
            }, $this->message($snake));
        }, PasswordRule::AVAILABLE);
    }

    private function message($key): ?string
    {
        return \trans('strong-password::validation.' . $key);
    }
}
