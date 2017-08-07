<?php
namespace src\components\base\Validator;

interface Validator
{
    public function process(array $params);
}