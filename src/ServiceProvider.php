<?php

namespace Helldar\StrongPassword;

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
        array_map(function ($rule) use ($validator) {
            $camel = Str::camel($rule);

            $validator->extend("psw_{$rule}", function ($_, $value) use ($camel) {
                return call_user_func([PasswordRule::class, $camel], $value);
            }, $this->message($rule));
        }, $this->rules());
    }

    private function rules(): array
    {
        $methods = get_class_methods(PasswordRule::class);

        return array_map(function ($item) {
            return Str::snake($item);
        }, $methods);
    }

    private function message($key): ?string
    {
        return trans('strong-password::validation.' . $key);
    }
}
