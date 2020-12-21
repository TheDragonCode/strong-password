<?php

namespace Tests\Inline\Support\Password\MinLength;

use Tests\Inline\InlineTestCase;

class FortySevenTest extends InlineTestCase
{
    protected $length = 47;

    public function testMinLength47()
    {
        $this->setRules(['psw_min_length']);

        $validated = $this->password()->errors();

        $this->assertArrayHasKey('password', $validated);

        $this->assertEquals(['password' => ['This field must be at least forty-seven characters.']], $validated);
    }
}
