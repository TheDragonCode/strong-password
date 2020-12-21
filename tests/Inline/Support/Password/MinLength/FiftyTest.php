<?php

namespace Tests\Inline\Support\Password\MinLength;

use Tests\Inline\InlineTestCase;

class FiftyTest extends InlineTestCase
{
    protected $length = 50;

    public function testMinLength50()
    {
        $this->setRules(['psw_strong']);

        $validated = $this->password()->errors('qWeRtY123#!');

        $this->assertArrayHasKey('password', $validated);

        $this->assertEquals(
            ['password' => ['This field must contain at least two characters in lower and upper case, at least one digit and special character, and also have a length of at least fifty characters.']],
            $validated
        );
    }
}
