<?php


namespace core;


use core\Exception\ExceptionValidator;

class Validator
{
    public $clean = [];
    public $errors = [];
    public $success = true;
    protected $rules;

    public function execute(array $fields)
    {
        if(!$this->rules) {
            throw new ExceptionValidator('Rules can not be empty!');
        }

        foreach($this->rules as $name => $rules) {
            if((!isset($fields[$name]) || empty($fields[$name])) && isset($rules['require']) && $rules['require']) {
                $this->errors[$name][] = sprintf('Field %s is require', $name);
            }

            if(!isset($fields[$name]) && (!isset($rules['require']) || !$rules['require'])) {
                continue;
            }

            if(isset($rules['type'])) {
                if($rules['type'] === 'string') {
                    $fields[$name] = trim(htmlspecialchars($fields[$name]));
                } elseif($rules['type'] === 'integer') {
                    if(!is_numeric($fields[$name])) {
                        $this->errors[$name][] = sprintf('Fields %s must be num', $name);
                    }
                }
            }

            if(!empty($this->errors)) {
                $this->success = false;
            }

            if(empty($this->errors[$name])) {
                $this->clean[$name] = $fields[$name];
            }
        }
    }

    public function setRules(array $rules)
    {
        $this->rules = $rules;
    }
}