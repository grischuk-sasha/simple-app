<?php
namespace src\components\base\Validator;

use src\components\base\Model;
use src\components\base\Validator\Exceptions\NotFoundRuleException;
use src\components\base\Validator\Rules\CustomRule;
use src\components\base\Validator\Rules\EmailRule;
use src\components\base\Validator\Rules\InRule;
use src\components\base\Validator\Rules\IntegerRule;
use src\components\base\Validator\Rules\NumericRule;
use src\components\base\Validator\Rules\RequiredRule;
use src\components\base\Validator\Rules\Rule;
use src\components\base\Validator\Rules\StringRule;

class ModelRuleFactory
{
    /**
     * @param array $params
     * @param Model $model
     * @return Rule
     * @throws NotFoundRuleException
     */
    public static function create(array $params, Model $model)
    {
        switch ($params[1]) {

            case Model::RULE_REQUIRED:
                return new RequiredRule();
                break;

            case Model::RULE_CUSTOM:
                return new CustomRule($model, $params['method']);
                break;

            case Model::RULE_IN:
                return new InRule($params['values']);
                break;

            case Model::RULE_EMAIL:
                return new EmailRule();
                break;

            case Model::RULE_INTEGER:
                return new IntegerRule($params);
                break;

            case Model::RULE_NUMERIC:
                return new NumericRule();
                break;

            case Model::RULE_STRING:
                return new StringRule();
                break;
        }

        throw new NotFoundRuleException();
    }
}