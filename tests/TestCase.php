<?php

namespace Tests;

use Helldar\StrongPassword\ServiceProvider;
use Helldar\StrongPassword\Support\Password;
use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageAliases($app)
    {
        return ['Config' => Config::class];
    }

    protected function getPackageProviders($app)
    {
        $this->setMinLength();
        $this->setInline();

        return [ServiceProvider::class];
    }

    protected function password(): Password
    {
        return new Password();
    }

    protected function setRules(array $rules): void
    {
        Config::set('strong-password.rules', $rules);
    }

    protected function setMinLength(): void
    {
        if (property_exists($this, 'length')) {
            Config::set('strong-password.min_length', $this->length);
        }
    }

    protected function setInline(): void
    {
        if (property_exists($this, 'inline')) {
            Config::set('strong-password.inline', $this->inline);
        }
    }
}
