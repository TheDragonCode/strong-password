<?php

namespace Tests\Inline\Support\Password\MinLength;

use Tests\Inline\InlineTestCase;

class DefaultTest extends InlineTestCase
{
    protected $length = 10;

    public function testMinLength()
    {
        $this->setRules(['psw_min_length']);

        $validated = $this->password()->errors();

        $this->assertArrayHasKey('password', $validated);

        $this->assertEquals(['password' => ['This field must be at least ten characters.']], $validated);
    }
}
