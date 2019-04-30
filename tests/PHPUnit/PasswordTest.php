<?php

namespace Tests\PHPUnit;

use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class PasswordTest extends TestCase
{
    public function testLetters()
    {
        // 1
        $result = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_letters']);
        $this->assertFalse($result->fails());

        // 2
        $result = Validator::make(['foo' => '123456'], ['foo' => 'psw_letters']);
        $this->assertTrue($result->fails());
    }

    public function testCaseDiff()
    {
        // 1
        $result = Validator::make(['foo' => 'qweRTY'], ['foo' => 'psw_case_diff']);
        $this->assertFalse($result->fails());

        // 2
        $result = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_case_diff']);
        $this->assertTrue($result->fails());

        // 3
        $result = Validator::make(['foo' => '123456'], ['foo' => 'psw_case_diff']);
        $this->assertTrue($result->fails());
    }

    public function testNumbers()
    {
        // 1
        $result = Validator::make(['foo' => 'qweRTY'], ['foo' => 'psw_numbers']);
        $this->assertTrue($result->fails());

        // 2
        $result = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_numbers']);
        $this->assertTrue($result->fails());

        // 3
        $result = Validator::make(['foo' => '123456'], ['foo' => 'psw_numbers']);
        $this->assertFalse($result->fails());

        // 4
        $result = Validator::make(['foo' => 'qwe123rty'], ['foo' => 'psw_numbers']);
        $this->assertFalse($result->fails());
    }

    public function testSymbols()
    {
        // 1
        $result = Validator::make(['foo' => 'qweRTY'], ['foo' => 'psw_symbols']);
        $this->assertTrue($result->fails());

        // 2
        $result = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_symbols']);
        $this->assertTrue($result->fails());

        // 3
        $result = Validator::make(['foo' => '123456'], ['foo' => 'psw_symbols']);
        $this->assertTrue($result->fails());

        // 4
        $result = Validator::make(['foo' => 'qwe123rty'], ['foo' => 'psw_symbols']);
        $this->assertTrue($result->fails());

        // 5
        $result = Validator::make(['foo' => 'qwe123r#ty'], ['foo' => 'psw_symbols']);
        $this->assertFalse($result->fails());
    }

    public function testMinLength()
    {
        // 1
        $result = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_min_length']);
        $this->assertTrue($result->fails());

        // 2
        $result = Validator::make(['foo' => 'qwer'], ['foo' => 'psw_min_length']);
        $this->assertTrue($result->fails());

        // 3
        $result = Validator::make(['foo' => 'qwerty123'], ['foo' => 'psw_min_length']);
        $this->assertTrue($result->fails());

        // 4
        $result = Validator::make(['foo' => 'qwerty1234'], ['foo' => 'psw_min_length']);
        $this->assertFalse($result->fails());
    }

    public function testStrong()
    {
        // 1
        $result = Validator::make(['foo' => 'qweRTY'], ['foo' => 'psw_strong']);
        $this->assertTrue($result->fails());

        // 2
        $result = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_strong']);
        $this->assertTrue($result->fails());

        // 3
        $result = Validator::make(['foo' => '123456'], ['foo' => 'psw_strong']);
        $this->assertTrue($result->fails());

        // 4
        $result = Validator::make(['foo' => 'qwe123rty'], ['foo' => 'psw_strong']);
        $this->assertTrue($result->fails());

        // 5
        $result = Validator::make(['foo' => 'qwe123r#ty'], ['foo' => 'psw_strong']);
        $this->assertTrue($result->fails());

        // 6
        $result = Validator::make(['foo' => 'qwe123R#Ty'], ['foo' => 'psw_strong']);
        $this->assertFalse($result->fails());
    }
}
