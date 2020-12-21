<?php

namespace Tests\Inline\Support\Password\MinLength;

use Tests\Inline\InlineTestCase;

final class TwelveTest extends InlineTestCase
{
    protected $length = 12;

    public function testMinLength12()
    {
        $this->setRules(['psw_min_length']);

        $validated = $this->password()->errors();

        $this->assertArrayHasKey('password', $validated);

        $this->assertEquals(['password' => ['This field must be at least twelve characters.']], $validated);
    }
}
