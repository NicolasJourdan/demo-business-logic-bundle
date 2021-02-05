<?php

namespace App\Specification\User;

use App\Entity\User;
use DateTime;
use NicolasJourdan\BusinessLogicBundle\Service\Specification\CompositeSpecification;

/**
 * Class IsNew
 *
 * @package App\User
 */
class IsNew extends CompositeSpecification
{
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

        return $candidate->getCreatedAt() >= (new DateTime())->modify('-10 days');
    }
}
