<?php

namespace Tests\Inline\Support\Password;

use Tests\Inline\InlineTestCase;

class ErrorsTest extends InlineTestCase
{
    public function testNull()
    {
        $this->setRules([]);

        $validated = $this->password()->errors();

        $this->assertNull($validated);
    }

    public function testLetters()
    {
        $this->setRules(['psw_letters']);

        $validated = $this->password()->errors();

        $this->assertArrayHasKey('password', $validated);

        $this->assertEquals(['password' => ['This field must include at least one letter.']], $validated);
    }

    public function testCaseDiff()
    {
        $this->setRules(['psw_case_diff']);

        $validated = $this->password()->errors();

        $this->assertArrayHasKey('password', $validated);

        $this->assertEquals(['password' => ['This field must include both upper and lower case letters.']], $validated);
    }

    public function testNumbers()
    {
        $this->setRules(['psw_numbers']);

        $validated = $this->password()->errors();

        $this->assertArrayHasKey('password', $validated);

        $this->assertEquals(['password' => ['This field must include at least one number.']], $validated);
    }

    public function testSymbols()
    {
        $this->setRules(['psw_symbols']);

        $validated = $this->password()->errors();

        $this->assertArrayHasKey('password', $validated);

        $this->assertEquals(['password' => ['This field must include at least one symbol.']], $validated);
    }

    public function testMinLength()
    {
        $this->setRules(['psw_min_length']);

        $validated = $this->password()->errors();

        $this->assertArrayHasKey('password', $validated);

        $this->assertEquals(['password' => ['This field must be at least ten characters.']], $validated);
    }

    public function testStrong()
    {
        $this->setRules(['psw_strong']);

        $validated = $this->password()->errors();

        $this->assertArrayHasKey('password', $validated);

        $this->assertEquals(
            ['password' => ['This field must contain at least two characters in lower and upper case, at least one digit and special character, and also have a length of at least ten characters.']],
            $validated
        );
    }
}
