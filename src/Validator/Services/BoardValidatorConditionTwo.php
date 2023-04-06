<?php

namespace App\Validator\Services;

use App\Entity\Board;

class BoardValidatorConditionTwo {
    private const AUGUST = 8;
    public function get(Board $board): bool {
        return (bool)(self::AUGUST == (int)$board
            ->getDateCreated()
                ->format('m') && !preg_match(
                    '/^[aA]/', $board->getName()
            )
        );
    }
}