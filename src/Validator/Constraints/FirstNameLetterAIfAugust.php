<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class FirstNameLetterAIfAugust extends Constraint
{
    public const AUGUST = 8;
    public $message = 'Board name must start from A if August';
}