<?php

namespace Tests\Support\Password\MinLength;

use Tests\TestCase;

class FiftyTest extends TestCase
{
    protected $length = 50;

    public function testMinLength50()
    {
        $this->setRules(['psw_strong']);

        $validated = $this->password()->errors('qWeRtY123#!');

        $this->assertArrayHasKey('password', $validated);

        $this->assertEquals(
            ['password' => ['The password must contain at least two characters in lower and upper case, at least one digit and special character, and also have a length of at least fifty characters.']],
            $validated);
    }
}
