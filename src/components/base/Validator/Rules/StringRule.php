<?php
namespace src\components\base\Validator\Rules;

class StringRule extends AbstractRule implements Rule
{
    public function validate($value)
    {
        if(!is_string($value))
            return false;

        return true;
    }

    public function getDefaultMessage($attr)
    {
        return $this->prepareAttrName($attr).' must be string.';
    }

}