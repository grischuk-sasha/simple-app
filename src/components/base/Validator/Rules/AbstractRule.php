<?php
namespace src\components\base\Validator\Rules;

use App\HttpClient\EnHttpStatusCode;

abstract class AbstractRule
{
    private $defaultMessage;

    public function prepareAttrName($attr)
    {
        return ucfirst(str_replace('_', ' ', $attr));
    }

    public function getDefaultMessage($attr)
    {
        if ($this->defaultMessage === null)
            return $this->prepareAttrName($attr).' is invalid.';

        return $this->defaultMessage;
    }

    public function getDefaultStatusCode()
    {
        return EnHttpStatusCode::UNPROCESSABLE_ENTITY;
    }

    public function setDefaultMessage($message)
    {
        $this->defaultMessage = $message;
        return $this;
    }
}