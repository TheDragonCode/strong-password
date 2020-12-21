<?php

namespace Tests\Inline\Support\Password;

use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Tests\Inline\InlineTestCase;

class ValidateTest extends InlineTestCase
{
    public function testNull()
    {
        $this->setRules([]);

        $validated = $this->password()->validate();

        $this->assertArrayHasKey('password', $validated);

        $this->assertNull(Arr::get($validated, 'password'));
    }

    public function testLetters()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The given data was invalid.');

        $this->setRules(['psw_letters']);

        $this->password()->validate();
    }

    public function testCaseDiff()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The given data was invalid.');

        $this->setRules(['psw_case_diff']);

        $this->password()->validate();
    }

    public function testNumbers()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The given data was invalid.');

        $this->setRules(['psw_numbers']);

        $this->password()->validate();
    }

    public function testSymbols()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The given data was invalid.');

        $this->setRules(['psw_symbols']);

        $this->password()->validate();
    }

    public function testMinLength()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The given data was invalid.');

        $this->setRules(['psw_min_length']);

        $this->password()->validate();
    }

    public function testStrong()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The given data was invalid.');

        $this->setRules(['psw_strong']);

        $this->password()->validate();
    }
}
