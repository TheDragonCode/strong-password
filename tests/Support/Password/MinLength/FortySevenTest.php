<?php

namespace Tests\Support\Password\MinLength;

use Tests\TestCase;

class FortySevenTest extends TestCase
{
    protected $length = 47;

    public function testMinLength47()
    {
        $this->setRules(['psw_min_length']);

        $validated = $this->password()->errors();

        $this->assertArrayHasKey('password', $validated);

        $this->assertEquals(['password' => ['The password must be at least forty-seven characters.']], $validated);
    }
}
