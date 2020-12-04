<?php

namespace App\Service\Rule\User;

use App\Entity\User;
use App\Service\Specification\User\IsGreatBettor;
use NicolasJourdan\BusinessLogicBundle\Service\Rule\RuleInterface;

/**
 * Class GreatBettorBonusRule
 *
 * @package App\Service\Rule\User
 */
class GreatBettorBonusRule implements RuleInterface
{
    const BONUS = 50;

    private const BUSINESS_LOGIC_TAGS = [
        ['rule_user.christmas', 10],
    ];

    /**
     * @var IsGreatBettor $isGreatBettorSpecification
     */
    private $isGreatBettorSpecification;

    /**
     * BetterBettorsBonusRule constructor.
     *
     * @param IsGreatBettor $isGreatBettorSpecification
     */
    public function __construct(IsGreatBettor $isGreatBettorSpecification)
    {
        $this->isGreatBettorSpecification = $isGreatBettorSpecification;
    }

    /**
     * {@inheritDoc}
     */
    public function shouldRun($candidate): bool
    {
        return $this->isGreatBettorSpecification->isSatisfiedBy($candidate);
    }

    /**
     * @param $candidate
     * @return mixed
     */
    public function execute($candidate)
    {
        /** @var User $candidate */
        return $candidate->setMoney($candidate->getMoney() + self::BONUS);
    }
}
