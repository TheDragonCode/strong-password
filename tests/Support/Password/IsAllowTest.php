<?php

namespace Tests\Support\Password;

use Tests\TestCase;

class IsAllowTest extends TestCase
{
    public function testNull()
    {
        $this->setRules([]);

        $validated = $this->password()->isAllow();

        $this->assertTrue($validated);
    }

    public function testLetters()
    {
        $this->setRules(['psw_letters']);

        $validated = $this->password()->isAllow();

        $this->assertFalse($validated);
    }

    public function testCaseDiff()
    {
        $this->setRules(['psw_case_diff']);

        $validated = $this->password()->isAllow();

        $this->assertFalse($validated);
    }

    public function testNumbers()
    {
        $this->setRules(['psw_numbers']);

        $validated = $this->password()->isAllow();

        $this->assertFalse($validated);
    }

    public function testSymbols()
    {
        $this->setRules(['psw_symbols']);

        $validated = $this->password()->isAllow();

        $this->assertFalse($validated);
    }

    public function testMinLength()
    {
        $this->setRules(['psw_min_length']);

        $validated = $this->password()->isAllow();

        $this->assertFalse($validated);
    }

    public function testStrong()
    {
        $this->setRules(['psw_strong']);

        $validated = $this->password()->isAllow();

        $this->assertFalse($validated);
    }

    public function testStrongSuccess()
    {
        $this->setRules(['psw_strong']);

        $validated = $this->password()->isAllow('qWeRtYuIoP[]#!123');

        $this->assertTrue($validated);
    }
}
