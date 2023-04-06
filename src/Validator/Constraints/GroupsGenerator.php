<?php

namespace App\Validator\Constraints;

use ApiPlatform\Symfony\Validator\ValidationGroupsGeneratorInterface;
use App\Validator\Services\BoardValidatorConditionOne;
use App\Validator\Services\BoardValidatorConditionTwo;
use App\Entity\Board;

final class GroupsGenerator implements ValidationGroupsGeneratorInterface
{
    private BoardValidatorConditionOne $conditionOne;

    private BoardValidatorConditionTwo $conditionTwo;

    public function __construct(
        BoardValidatorConditionOne $conditionOne,
        BoardValidatorConditionTwo $conditionTwo
    ) {
        $this->conditionOne = $conditionOne;
        $this->conditionTwo = $conditionTwo;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke($board): array
    {
        assert($board instanceof Board);

        switch(true){
            case $this->conditionOne->get($board):
                return ['nameNotA'];
            case $this->conditionTwo->get($board):
                return ['august'];
        }
        
        return [];
    }
}