<?php

namespace App\Validator\Services;

use App\Entity\Board;

class BoardValidatorConditionOne {
    public function get(Board $board): bool {
        return (bool)preg_match('/^[aA]/', $board->getName());
    }
}