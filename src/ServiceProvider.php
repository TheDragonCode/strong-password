<?php

namespace Helldar\StrongPassword;

use Helldar\StrongPassword\Rules\PasswordRule;
use Illuminate\Contracts\Validation\Factory;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = false;

    public function boot(Factory $validator)
    {
        $validator->extend('password', function ($_, $value) {
            return PasswordRule::strong($value);
        }, $this->message($validator));
    }

    private function message(Factory $validator): string
    {
        /** @var \Illuminate\Translation\Translator $translation */
        $translation = $validator->getTranslator();

        $translation->addNamespace('strong-password', __DIR__ . '/resources/lang');
        $translation->load('strong-password', 'validation', $translation->locale());

        return $translation->get('strong-password::validation.password');
    }
}
