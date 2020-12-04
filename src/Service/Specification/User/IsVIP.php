<?php

namespace App\Service\Specification\User;

use App\Entity\User;
use NicolasJourdan\BusinessLogicBundle\Service\Specification\CompositeSpecification;

/**
 * Class IsVIP
 *
 * @package App\Service\Specification\User
 */
class IsVIP extends CompositeSpecification
{
    const VIP_KEY = 'IS_VIP';

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

        return in_array(self::VIP_KEY, $candidate->getRoles());
    }
}
