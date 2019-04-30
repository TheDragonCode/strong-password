<?php

namespace Tests\PHPUnit;

use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class PasswordTest extends TestCase
{
    public function testLetters()
    {
        // 1
        $v1 = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_letters']);

        $this->assertFalse($v1->fails());

        // 2
        $v2 = Validator::make(['foo' => '123456'], ['foo' => 'psw_letters']);

        $this->assertTrue($v2->fails());
    }

    public function testCaseDiff()
    {
        // 1
        $v1 = Validator::make(['foo' => 'qweRTY'], ['foo' => 'psw_case_diff']);

        $this->assertFalse($v1->fails());

        // 2
        $v2 = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_case_diff']);

        $this->assertTrue($v2->fails());

        // 3
        $v2 = Validator::make(['foo' => '123456'], ['foo' => 'psw_case_diff']);

        $this->assertTrue($v2->fails());
    }

    public function testNumbers()
    {
        // 1
        $v1 = Validator::make(['foo' => 'qweRTY'], ['foo' => 'psw_numbers']);

        $this->assertTrue($v1->fails());

        // 2
        $v2 = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_numbers']);

        $this->assertTrue($v2->fails());

        // 3
        $v2 = Validator::make(['foo' => '123456'], ['foo' => 'psw_numbers']);

        $this->assertFalse($v2->fails());

        // 4
        $v2 = Validator::make(['foo' => 'qwe123rty'], ['foo' => 'psw_numbers']);

        $this->assertFalse($v2->fails());
    }

    public function testSymbols()
    {
        // 1
        $v1 = Validator::make(['foo' => 'qweRTY'], ['foo' => 'psw_symbols']);

        $this->assertTrue($v1->fails());

        // 2
        $v2 = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_symbols']);

        $this->assertTrue($v2->fails());

        // 3
        $v2 = Validator::make(['foo' => '123456'], ['foo' => 'psw_symbols']);

        $this->assertTrue($v2->fails());

        // 4
        $v2 = Validator::make(['foo' => 'qwe123rty'], ['foo' => 'psw_symbols']);

        $this->assertTrue($v2->fails());

        // 5
        $v2 = Validator::make(['foo' => 'qwe123r#ty'], ['foo' => 'psw_symbols']);

        $this->assertFalse($v2->fails());
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
        $v1 = Validator::make(['foo' => 'qweRTY'], ['foo' => 'psw_strong']);

        $this->assertTrue($v1->fails());

        // 2
        $v2 = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_strong']);

        $this->assertTrue($v2->fails());

        // 3
        $v2 = Validator::make(['foo' => '123456'], ['foo' => 'psw_strong']);

        $this->assertTrue($v2->fails());

        // 4
        $v2 = Validator::make(['foo' => 'qwe123rty'], ['foo' => 'psw_strong']);

        $this->assertTrue($v2->fails());

        // 5
        $v2 = Validator::make(['foo' => 'qwe123r#ty'], ['foo' => 'psw_strong']);

        $this->assertTrue($v2->fails());

        // 6
        $v2 = Validator::make(['foo' => 'qwe123R#Ty'], ['foo' => 'psw_strong']);

        $this->assertFalse($v2->fails());
    }
}
