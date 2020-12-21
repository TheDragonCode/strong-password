<?php

namespace Helldar\StrongPassword;

use Helldar\StrongPassword\Rules\Rules;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider
{
    public function boot(Factory $validator)
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'strong-password');

        $this->configPublish();

        $this->bootValidation($validator);
    }

    public function register()
    {
        $this->registerConfig();
    }

    protected function bootValidation(Factory $validator)
    {
        foreach (Rules::names() as $name) {
            /** @var \Helldar\StrongPassword\Contracts\Rule $rule */
            $rule = Rules::get($name);

            $validator->extend(Rules::name($name), static function ($_, $value) use ($rule) {
                return $rule::passes($value);
            }, $rule::message());
        }
    }

    protected function configPublish()
    {
        $this->publishes([
            __DIR__ . '/../config/strong-password.php' => $this->app->configPath('strong-password.php'),
        ], 'config');
    }

    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/strong-password.php', 'strong-password'
        );
    }
}
