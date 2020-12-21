<?php

namespace Tests\Basic;

use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

final class RulesTest extends TestCase
{
    public function testFoo()
    {
        $result = Validator::make(['foo' => 'qwerty'], ['foo' => 'string']);
        $this->assertFalse($result->fails());
    }

    public function testLetters()
    {
        $result = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_letters']);
        $this->assertFalse($result->fails());
        $this->assertCount(0, $result->errors()->all());

        $result = Validator::make(['foo' => '123456'], ['foo' => 'psw_letters']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must include at least one letter.', $result->errors()->first());
    }

    public function testCaseDiff()
    {
        $result = Validator::make(['foo' => 'qweRTY'], ['foo' => 'psw_case_diff']);
        $this->assertFalse($result->fails());
        $this->assertCount(0, $result->errors()->all());

        $result = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_case_diff']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must include both upper and lower case letters.', $result->errors()->first());

        $result = Validator::make(['foo' => '123456'], ['foo' => 'psw_case_diff']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must include both upper and lower case letters.', $result->errors()->first());
    }

    public function testNumbers()
    {
        $result = Validator::make(['foo' => 'qweRTY'], ['foo' => 'psw_numbers']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must include at least one number.', $result->errors()->first());

        $result = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_numbers']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must include at least one number.', $result->errors()->first());

        $result = Validator::make(['foo' => '123456'], ['foo' => 'psw_numbers']);
        $this->assertFalse($result->fails());
        $this->assertCount(0, $result->errors()->all());

        $result = Validator::make(['foo' => 'qwe123rty'], ['foo' => 'psw_numbers']);
        $this->assertFalse($result->fails());
        $this->assertCount(0, $result->errors()->all());
    }

    public function testSymbols()
    {
        $result = Validator::make(['foo' => 'qweRTY'], ['foo' => 'psw_symbols']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must include at least one symbol.', $result->errors()->first());

        $result = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_symbols']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must include at least one symbol.', $result->errors()->first());

        $result = Validator::make(['foo' => '123456'], ['foo' => 'psw_symbols']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must include at least one symbol.', $result->errors()->first());

        $result = Validator::make(['foo' => 'qwe123rty'], ['foo' => 'psw_symbols']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must include at least one symbol.', $result->errors()->first());

        $result = Validator::make(['foo' => 'qwe123r#ty'], ['foo' => 'psw_symbols']);
        $this->assertFalse($result->fails());
        $this->assertCount(0, $result->errors()->all());
    }

    public function testMinLength()
    {
        $result = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_min_length']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must be at least ten characters.', $result->errors()->first());

        $result = Validator::make(['foo' => 'qwer'], ['foo' => 'psw_min_length']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must be at least ten characters.', $result->errors()->first());

        $result = Validator::make(['foo' => 'qwerty123'], ['foo' => 'psw_min_length']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame('The foo must be at least ten characters.', $result->errors()->first());

        $result = Validator::make(['foo' => 'qwerty1234'], ['foo' => 'psw_min_length']);
        $this->assertFalse($result->fails());
        $this->assertCount(0, $result->errors()->all());
    }

    public function testStrong()
    {
        $result = Validator::make(['foo' => 'qweRTY'], ['foo' => 'psw_strong']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame(
            'The foo must contain at least two characters in lower and upper case, at least one digit and special character, and also have a length of at least ten characters.',
            $result->errors()->first()
        );

        $result = Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_strong']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame(
            'The foo must contain at least two characters in lower and upper case, at least one digit and special character, and also have a length of at least ten characters.',
            $result->errors()->first()
        );

        $result = Validator::make(['foo' => '123456'], ['foo' => 'psw_strong']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame(
            'The foo must contain at least two characters in lower and upper case, at least one digit and special character, and also have a length of at least ten characters.',
            $result->errors()->first()
        );

        $result = Validator::make(['foo' => 'qwe123rty'], ['foo' => 'psw_strong']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame(
            'The foo must contain at least two characters in lower and upper case, at least one digit and special character, and also have a length of at least ten characters.',
            $result->errors()->first()
        );

        $result = Validator::make(['foo' => 'qwe123r#ty'], ['foo' => 'psw_strong']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame(
            'The foo must contain at least two characters in lower and upper case, at least one digit and special character, and also have a length of at least ten characters.',
            $result->errors()->first()
        );

        $result = Validator::make(['foo' => null], ['foo' => 'psw_strong']);
        $this->assertTrue($result->fails());
        $this->assertCount(1, $result->errors()->all());
        $this->assertSame(
            'The foo must contain at least two characters in lower and upper case, at least one digit and special character, and also have a length of at least ten characters.',
            $result->errors()->first()
        );

        $result = Validator::make(['foo' => 'qwe123R#Ty'], ['foo' => 'psw_strong']);
        $this->assertFalse($result->fails());
        $this->assertCount(0, $result->errors()->all());
    }
}
