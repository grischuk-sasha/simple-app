<?php
namespace src\components\base\Validator\Rules;

interface Rule
{
    /**
     * @param $value
     * @return bool
     */
    public function validate($value);

    /**
     * @param string $attr
     * @return string
     */
    public function getDefaultMessage($attr);

    /**
     * @return int
     */
    public function getDefaultStatusCode();
}