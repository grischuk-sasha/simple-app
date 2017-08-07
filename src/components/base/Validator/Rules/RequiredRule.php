<?php
namespace src\components\base\Validator\Rules;

class RequiredRule extends AbstractRule implements Rule
{
    public function validate($value)
    {
        if($value === null || $value === '')
            return false;

        return true;
    }

    public function getDefaultMessage($attr)
    {
        return $this->prepareAttrName($attr).' cannot be blank.';
    }
}