<?php

namespace App\Service\Specification\User;

use App\Entity\User;
use NicolasJourdan\BusinessLogicBundle\Service\Specification\CompositeSpecification;

/**
 * Class IsGreatBettor
 *
 * @package App\Service\Specification\User
 */
class IsGreatBettor extends CompositeSpecification
{
    const RATE = 0.7;

    /**
     * {@inheritDoc}
     */
    public function isSatisfiedBy($candidate): bool
    {
        if (!$candidate instanceof User) {
            throw new \InvalidArgumentException(
                'The current candidate ' . get_class($candidate) . ' must be an instance of ' . User::class
            );
        }

        $totalBets = $candidate->getTotalWonBets() + $candidate->getTotalLostBets();

        if (0 === $totalBets) {
            return false;
        }

        return $candidate->getTotalWonBets() / $totalBets >= self::RATE;
    }
}
