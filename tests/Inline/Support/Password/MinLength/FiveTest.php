<?php

namespace Tests\Inline\Support\Password\MinLength;

use Tests\Inline\InlineTestCase;

class FiveTest extends InlineTestCase
{
    protected $length = 5;

    public function testMinLength5()
    {
        $this->setRules(['psw_min_length']);

        $validated = $this->password()->errors();

        $this->assertArrayHasKey('password', $validated);

        $this->assertEquals(['password' => ['This field must be at least ten characters.']], $validated);
    }
}
