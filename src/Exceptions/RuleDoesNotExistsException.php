<?php

namespace Helldar\StrongPassword\Exceptions;

use Exception;

class RuleDoesNotExistsException extends Exception
{
    public function __construct($rule)
    {
        $message = \sprintf('Rule "%s" does not exist!', $rule);

        parent::__construct($message, 500);
    }
}
