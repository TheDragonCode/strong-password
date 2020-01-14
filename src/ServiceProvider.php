<?php

namespace Helldar\StrongPassword;

use Helldar\StrongPassword\Rules\PasswordRule;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Support\Str;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot(Factory $validator)
    {
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'strong-password');

        $this->validation($validator);
    }

    protected function validation(Factory $validator)
    {
        array_map(function ($rule) use ($validator) {
            $validator->extend("psw_{$rule}", function ($_, $value) use ($rule) {
                $camel = Str::camel($rule);

                return call_user_func([PasswordRule::class, $camel], $value);
            }, $this->message($rule));
        }, $this->rules());
    }

    protected function rules(): array
    {
        return array_map(function ($item) {
            return Str::snake($item);
        }, $this->passwordRuleMethods());
    }

    protected function message($key): string
    {
        return trans('strong-password::validation.' . $key);
    }

    protected function passwordRuleMethods()
    {
        return get_class_methods(PasswordRule::class);
    }
}
