<?php namespace RestedCats\Helpers;

class Validation
{
    protected $errorMessages = [];

    public function run(array $values, array $config)
    {
        $this->clearErrorMessages();
        $validated = true;

        if (empty($values) && empty($config)) {
            return true;
        }

        foreach ($config as $key => $rules) {
            foreach ($rules as $rule) {
                if ($this->checkRule($rule, $values, $key) === false) {
                    $validated = false;
                }
            }
        }

        return $validated;
    }

    public function checkRule($rule, $values, $key)
    {
        if (method_exists($this, $rule)) {
            return $this->{$rule}($values, $key);
        }

        return false;
    }

    public function required($values, $key)
    {
        // Check for the value
        if (isset($values[$key])) {
            return true;
        }

        $this->addErrorMessage("{$key} is required.");
        return false;
    }

    public function numeric($values, $key)
    {
        // We don't care about required
        if (isset($values[$key]) === false) {
            return true;
        }

        // Is the value a numerical value
        if (is_numeric($values[$key])) {
            return true;
        }

        $this->addErrorMessage("{$key} is should be numeric.");
        return false;
    }

    public function string($values, $key)
    {
        // We don't care about required
        if (isset($values[$key]) === false) {
            return true;
        }

        // Is the value a string
        if (is_string($values[$key])) {
            return true;
        }

        $this->addErrorMessage("{$key} is should a string.");
        return false;
    }

    public function clearErrorMessages()
    {
        $this->errorMessages = [];
    }

    public function addErrorMessage($message)
    {
        $this->errorMessages[] = $message;
    }

    public function getErrorMessages()
    {
        return $this->errorMessages;
    }
}