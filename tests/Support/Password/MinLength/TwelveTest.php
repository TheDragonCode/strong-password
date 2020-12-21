<?php

namespace Tests\Support\Password\MinLength;

use Tests\TestCase;

final class TwelveTest extends TestCase
{
    protected $length = 12;

    public function testMinLength12()
    {
        $this->setRules(['psw_min_length']);

        $validated = $this->password()->errors();

        $this->assertArrayHasKey('password', $validated);

        $this->assertEquals(['password' => ['The password must be at least twelve characters.']], $validated);
    }
}
