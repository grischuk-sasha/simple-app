<?php
namespace src\components\base\Validator\Rules;

class EmailRule extends AbstractRule implements Rule
{
    public function validate($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL))
            return false;

        return true;
    }

    public function getDefaultMessage($attr)
    {
        return $this->prepareAttrName($attr).' is not a valid email address.';
    }
}