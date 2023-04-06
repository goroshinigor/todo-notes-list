<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use App\Validator\Services\BoardValidatorConditionTwo;

#[\Attribute]
class FirstNameLetterAIfAugustValidator extends ConstraintValidator
{
    private $condition;
    
    public function __construct(BoardValidatorConditionTwo $condition) {
        $this->condition = $condition;
    }

    public function validate($value, Constraint $constraint): void
    {
        if ( $this->condition->get($this->context->getObject()) ) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}