<?php

namespace EasyCoding;

class Validator
{

    /**
     * inputs
     *
     * @var
     */
    protected $inputs = array();

    /**
     * rules
     *
     * @var
     */
    protected $rules = array();

    /**
     * messages
     *
     * @var
     */
    protected $messages = array();

    /**
     * errors
     *
     * @var
     */
    protected $errors = array();

    /**
     * passes
     *
     * @var
     */
    protected $passes = true;

    /**
     * PUBLIC METHODS
     */

    /**
     * __construct
     *
     * @param array inputs
     * @param array rules
     * @param array messages
     * @return void
     */
    public function __construct(array $inputs = array(), array $rules = array(), array $messages = array())
    {
        // let´s set the data
        // so we can make use of it
        // through the methods
        $this->inputs = $inputs;
        $this->rules = $rules;
        $this->messages = $messages;

        // let´s trigger the validate method
        $this->validate();
    }

    /**
     * passes
     *
     * @return boolean
     */
    public function passes()
    {
        return $this->passes;
    }

    /**
     * errors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * PROTECTED METHODS
     */

    /**
     * validate
     *
     * takes care of global validation
     *
     *
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
     * validate required
     *
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
     * validate array
     *
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
     * validate email
     *
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
     * validate numeric
     *
     * @param string
     * @param string
     * @param string
     * @return boolean
     */
    protected function validateNumeric($key, $validation, $params)
    {
        return is_numeric($this->inputs[$key]);
    }

}
