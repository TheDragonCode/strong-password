<?php

namespace Helldar\StrongPassword;

use Helldar\StrongPassword\Rules\Rules;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    public function boot(Factory $validator)
    {
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'strong-password');

        $this->validation($validator);
    }

    protected function validation(Factory $validator)
    {
        array_map(function ($name) use ($validator) {
            /** @var \Helldar\StrongPassword\Contracts\Rule $rule */
            $rule = Rules::get($name);

            $validator->extend(Rules::name($name), function ($_, $value) use ($rule) {
                return $rule::passes($value);
            }, $rule::message());
        }, Rules::names());
    }
}
