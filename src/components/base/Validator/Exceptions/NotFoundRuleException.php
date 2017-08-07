<?php
namespace src\components\base\Validator\Exceptions;

use Exception;

class NotFoundRuleException extends Exception
{
    public function __construct($message = 'Rule was not found.', $code = 404, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}