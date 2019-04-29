<?php

namespace Tests;

use Helldar\StrongPassword\ServiceProvider;
use Illuminate\Support\Facades\Config;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageAliases($app)
    {
        return ['Config' => Config::class];
    }

    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }
}
