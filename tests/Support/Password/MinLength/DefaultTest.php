<?php

namespace Tests\Support\Password\MinLength;

use Tests\TestCase;

class DefaultTest extends TestCase
{
    protected $length = 10;

    public function testMinLength()
    {
        $this->setRules(['psw_min_length']);

        $validated = $this->password()->errors();

        $this->assertArrayHasKey('password', $validated);

        $this->assertEquals(['password' => ['The password must be at least ten characters.']], $validated);
    }
}
