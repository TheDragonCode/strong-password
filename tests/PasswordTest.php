<?php

namespace Tests;

use Illuminate\Support\Facades\Validator;

class PasswordTest extends TestCase
{
    public function testFoo()
    {
        $result = Validator::make(['foo' => 'qwerty'], ['foo' => 'string']);
        $this->assertFalse($result->fails());
    }

    public function testLetters()
    {
        // 1
        $result = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_letters']);
        $this->assertFalse($result->fails());
        $this->assertCount(0, $result->errors()->all());

        // 2
        $result = Validator::make(['foo' => '123456'], ['foo' => 'psw_letters']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must include at least one letter.', $result->errors()->first());
    }

    public function testCaseDiff()
    {
        // 1
        $result = Validator::make(['foo' => 'qweRTY'], ['foo' => 'psw_case_diff']);
        $this->assertFalse($result->fails());
        $this->assertCount(0, $result->errors()->all());

        // 2
        $result = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_case_diff']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must include both upper and lower case letters.', $result->errors()->first());

        // 3
        $result = Validator::make(['foo' => '123456'], ['foo' => 'psw_case_diff']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must include both upper and lower case letters.', $result->errors()->first());
    }

    public function testNumbers()
    {
        // 1
        $result = Validator::make(['foo' => 'qweRTY'], ['foo' => 'psw_numbers']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must include at least one number.', $result->errors()->first());

        // 2
        $result = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_numbers']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must include at least one number.', $result->errors()->first());

        // 3
        $result = Validator::make(['foo' => '123456'], ['foo' => 'psw_numbers']);
        $this->assertFalse($result->fails());
        $this->assertCount(0, $result->errors()->all());

        // 4
        $result = Validator::make(['foo' => 'qwe123rty'], ['foo' => 'psw_numbers']);
        $this->assertFalse($result->fails());
        $this->assertCount(0, $result->errors()->all());
    }

    public function testSymbols()
    {
        // 1
        $result = Validator::make(['foo' => 'qweRTY'], ['foo' => 'psw_symbols']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must include at least one symbol.', $result->errors()->first());

        // 2
        $result = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_symbols']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must include at least one symbol.', $result->errors()->first());

        // 3
        $result = Validator::make(['foo' => '123456'], ['foo' => 'psw_symbols']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must include at least one symbol.', $result->errors()->first());

        // 4
        $result = Validator::make(['foo' => 'qwe123rty'], ['foo' => 'psw_symbols']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must include at least one symbol.', $result->errors()->first());

        // 5
        $result = Validator::make(['foo' => 'qwe123r#ty'], ['foo' => 'psw_symbols']);
        $this->assertFalse($result->fails());
        $this->assertCount(0, $result->errors()->all());
    }

    public function testMinLength()
    {
        // 1
        $result = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_min_length']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must be at least ten characters.', $result->errors()->first());

        // 2
        $result = Validator::make(['foo' => 'qwer'], ['foo' => 'psw_min_length']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must be at least ten characters.', $result->errors()->first());

        // 3
        $result = Validator::make(['foo' => 'qwerty123'], ['foo' => 'psw_min_length']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must be at least ten characters.', $result->errors()->first());

        // 4
        $result = Validator::make(['foo' => 'qwerty1234'], ['foo' => 'psw_min_length']);
        $this->assertFalse($result->fails());
        $this->assertCount(0, $result->errors()->all());
    }

    public function testStrong()
    {
        // 1
        $result = Validator::make(['foo' => 'qweRTY'], ['foo' => 'psw_strong']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame(
            'The foo must contain at least two characters in lower and upper case, at least one digit and special character, and also have a length of at least 10 characters.',
            $result->errors()->first()
        );

        // 2
        $result = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_strong']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame(
            'The foo must contain at least two characters in lower and upper case, at least one digit and special character, and also have a length of at least 10 characters.',
            $result->errors()->first()
        );

        // 3
        $result = Validator::make(['foo' => '123456'], ['foo' => 'psw_strong']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame(
            'The foo must contain at least two characters in lower and upper case, at least one digit and special character, and also have a length of at least 10 characters.',
            $result->errors()->first()
        );

        // 4
        $result = Validator::make(['foo' => 'qwe123rty'], ['foo' => 'psw_strong']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame(
            'The foo must contain at least two characters in lower and upper case, at least one digit and special character, and also have a length of at least 10 characters.',
            $result->errors()->first()
        );

        // 5
        $result = Validator::make(['foo' => 'qwe123r#ty'], ['foo' => 'psw_strong']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame(
            'The foo must contain at least two characters in lower and upper case, at least one digit and special character, and also have a length of at least 10 characters.',
            $result->errors()->first()
        );

        // 6
        $result = Validator::make(['foo' => null], ['foo' => 'psw_strong']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame(
            'The foo must contain at least two characters in lower and upper case, at least one digit and special character, and also have a length of at least 10 characters.',
            $result->errors()->first()
        );

        // 7
        $result = Validator::make(['foo' => 'qwe123R#Ty'], ['foo' => 'psw_strong']);
        $this->assertFalse($result->fails());
        $this->assertCount(0, $result->errors()->all());
    }
}
