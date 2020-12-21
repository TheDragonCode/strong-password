<?php

namespace Tests\Support\Password\MinLength;

use Tests\TestCase;

class FiveTest extends TestCase
{
    protected $length = 5;

    public function testMinLength5()
    {
        $this->setRules(['psw_min_length']);

        $validated = $this->password()->errors();

        $this->assertArrayHasKey('password', $validated);

        $this->assertEquals(['password' => ['The password must be at least ten characters.']], $validated);
    }
}
