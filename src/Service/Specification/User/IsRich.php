<?php

namespace App\Service\Specification\User;

use App\Entity\User;
use NicolasJourdan\BusinessLogicBundle\Service\Specification\CompositeSpecification;

/**
 * Class IsRich
 *
 * @package App\Service\Specification\User
 */
class IsRich extends CompositeSpecification
{
    const MINIMUM_RICH_AMOUNT = 10000;

    /**
     * @param $candidate
     *
     * @return bool
     */
    public function isSatisfiedBy($candidate): bool
    {
        if (!$candidate instanceof User) {
            throw new \InvalidArgumentException(
                'The current candidate ' . get_class($candidate) . ' must be an instance of ' . User::class
            );
        }

        return $candidate->getMoney() >= self::MINIMUM_RICH_AMOUNT;
    }
}
