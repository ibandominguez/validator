<?php

/**
 * IbanDominguez\Validator\Validator
 *
 * PHP Version >= 5.3.0
 *
 * @author    Ibán Domínguez <ibandominguez@hotmail.com>
 * @copyright 2014-2015 Ibán Domínguez (http://www.ibandominguez.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/ibandominguez/validator
 */

namespace IbanDominguez\Validator;

class Validator
{
    /**
     * @var
     */
    protected $inputs = array();

    /**
     * @var
     */
    protected $rules = array();

    /**
     * @var
     */
    protected $messages = array();

    /**
     * @var
     */
    protected $errors = array();

    /**
     * @var
     */
    protected $passes = true;

    /**
     * @param array
     * @param array
     * @param array
     * @return void
     */
    public function __construct(array $inputs = array(), array $rules = array(), array $messages = array())
    {
        $this->inputs = $inputs;
        $this->rules = $rules;
        $this->messages = $messages;
        $this->validate();
    }

    /**
     * @return boolean
     */
    public function passes()
    {
        return $this->passes;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return void
     */
    protected function validate()
    {
        // lets get the ruleset
        // where $v is something like 'required|email|size:8'
        foreach ($this->rules as $key => $value) :
            $ruleset = explode('|', $value);

            // lets get the params from the ruleset
            // where $v is something like 'size:8'
            foreach ($ruleset as $rule) :
                $pos = strpos($rule, ':');
                $params = '';

                if ($pos !== false) {
                    $params = substr($rule, $pos + 1);
                    $rule = substr($rule, 0, $pos);
                }

                // now we have rule and params
                // so we need to find out if
                // there's a method to validate
                $methodName = 'validate' . ucfirst($rule);

                if (method_exists($this, $methodName)) {
                    if (!$this->$methodName($key, $rule, $params)) {
                        $this->passes = false;
                        $this->errors[$key] = isset($this->messages[$key]) ? $this->messages[$key] : $key . ", rule: " . $rule;
                    }
                } else {
                    throw new \BadMethodCallException($methodName . ' method does not exists');
                }

            endforeach;

        endforeach;
    }

    /**
     * @param string
     * @param string
     * @param string
     * @return boolean
     */
    protected function validateRequired($key, $validation, $params)
    {
        return !empty($this->inputs[$key]);
    }

    /**
     * @param string
     * @param string
     * @param string
     * @return boolean
     */
    protected function validateArray($key, $validation, $params)
    {
        return is_array($this->inputs[$key]);
    }

    /**
     * @param string
     * @param string
     * @param string
     * @return boolean
     */
    protected function validateEmail($key, $validation, $params)
    {
        return filter_var($this->inputs[$key], FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param string
     * @param string
     * @param string
     * @return boolean
     */
    protected function validateNumeric($key, $validation, $params)
    {
        return is_numeric($this->inputs[$key]);
    }

    /**
     * @param string
     * @param string
     * @param string
     * @return boolean
     */
    protected function validateString($key, $validation, $params)
    {
        return is_string($this->inputs[$key]) && !is_numeric($this->inputs[$key]);
    }

    /**
     * @param string
     * @param string
     * @param string
     * @return boolean
     */
    protected function validateDate($key, $validation, $params)
    {
        return preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $this->inputs[$key]);
    }

    /**
     * @param string
     * @param string
     * @param string
     * @return boolean
     */
    protected function validateDatetime($key, $validation, $params)
    {
        return preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $this->inputs[$key]);
    }
}
