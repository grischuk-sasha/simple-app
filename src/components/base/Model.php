<?php
namespace src\components\base;

use src\components\base\Validator\ModelValidator;

abstract class Model
{
    const RULE_REQUIRED = 'required';
    const RULE_EMAIL    = 'email';
    const RULE_INTEGER  = 'integer';
    const RULE_NUMERIC  = 'numeric';
    const RULE_IN       = 'in';
    const RULE_CUSTOM   = 'custom';
    const RULE_STRING   = 'string';

    public static function getAllRulesName()
    {
        return [
            self::RULE_REQUIRED => 'Required',
            self::RULE_EMAIL => 'Email',
            self::RULE_INTEGER => 'Integer',
            self::RULE_NUMERIC => 'Numeric',
            self::RULE_IN => 'In',
            self::RULE_CUSTOM => 'Custom',
            self::RULE_STRING => 'String',
        ];
    }

    protected $attributes = [];
    protected $errors = [];
    /** @var ModelValidator $validator */
    private $validator;

    public function __construct(array $attributes)
    {
        $this->setAttributes($attributes);
        $this->validator = new ModelValidator($this);
    }

    /**
     * @param string $attr
     * @param string $error
     * @param int $statusCode
     * @return $this
     */
    public function addErrorByAttribute($attr, $error, $statusCode = EnHttpStatusCode::UNPROCESSABLE_ENTITY)
    {
        if ($this->getErrorByAttribute($attr) === null)
            $this->errors[$attr] = [
                'detail' => $error,
                'status_code' => $statusCode,
            ];

        return $this;
    }

    /**
     * @param $attr
     * @return string|null
     */
    public function getErrorByAttribute($attr)
    {
        return isset($this->errors[$attr]) ? isset($this->errors[$attr]) : null;
    }

    public function hasErrorByAttribute($attr)
    {
        return $this->getErrorByAttribute($attr) !== null;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getErrorsInDefaultFormat()
    {
        $errors = $this->getErrors();
        $result = [];

        foreach ($errors as $attr => $error) {
            $result[$attr] =  isset($error['detail']) ? $error['detail'] : "";
        }

        return  $result;
    }

    public function getErrorsInSpecialFormat()
    {
        $errors = $this->getErrors();
        $result = [];

        foreach ($errors as $attr => $error) {
            $result[] = [
                "status" => isset($error['status_code']) ? $error['status_code'] : EnHttpStatusCode::UNPROCESSABLE_ENTITY,
                "source" => [
                    "pointer" => $attr
                ],
                "title" =>  "Invalid Attribute",
                "detail" => isset($error['detail']) ? $error['detail'] : "",
            ];
        }

        return [
            'errors' => $result
        ];
    }

    /**
     * @return bool (false - no errors)
     */
    public function isErrors()
    {
        return count($this->errors) > 0;
    }

    public function setAttributes(array $attributes)
    {
        $this->attributes = array_merge($attributes + $this->attributes);
        return $this;
    }

    public function setAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    public function getAttribute($name)
    {
        return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param string $name
     * @return bool true - isset
     */
    public function hasAttribute($name)
    {
        return isset($this->attributes[$name]);
    }

    /**
     * @return boolean - true is valid
     */
    public function validate()
    {
        foreach ($this->rules() as $rules)
            if (!$this->hasErrorByAttribute($rules[0]))
                $this->validator->process($rules);

        return !$this->isErrors();
    }

    abstract public function rules();
}