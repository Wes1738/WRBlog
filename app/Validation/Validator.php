<?php

namespace App\Validation;

use Respect\Validation\Exceptions\NestedValidationException;

class Validator 
{
    private $errors;

    public function validate($request, array $rules)
    {
        foreach ($rules as $field => $rule) {
            try {
                $rule->setName(ucfirst($field))->assert($request->getParam($field));
            } catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages(0);
            }
        }

        $_SESSION['errors'] = $this->errors;

        return $this;
    }

    public function failed()
    {
        return !empty($this->errors);
    }
}

// $v = new Validation();
// $v->validate('', array())->failed();