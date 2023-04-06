<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

#[\Attribute]
class FirstNameLetterNotA extends Constraint
{
    public $message = 'Board name must NOT start from A';
}