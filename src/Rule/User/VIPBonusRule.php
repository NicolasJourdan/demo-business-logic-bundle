<?php

namespace App\Rule\User;

use App\Entity\User;
use App\Specification\User\IsRich;
use App\Specification\User\IsVIP;
use NicolasJourdan\BusinessLogicBundle\Service\Rule\RuleInterface;

/**
 * Class VIPBonusRule
 *
 * @package App\Rule\User
 */
class VIPBonusRule implements RuleInterface
{
    const BONUS = 10;

    private const BUSINESS_LOGIC_TAGS = [
        ['rule_user.christmas'],
    ];

    /**
     * @var IsVIP $isVIPSpecification
     */
    private $isVIPSpecification;

    /**
     * @var IsRich $isRichSpecification
     */
    private $isRichSpecification;

    /**
     * VIPBonusRule constructor.
     *
     * @param IsVIP $isVIPSpecification
     * @param IsRich $isRichSpecification
     */
    public function __construct(IsVIP $isVIPSpecification, IsRich $isRichSpecification)
    {
        $this->isVIPSpecification = $isVIPSpecification;
        $this->isRichSpecification = $isRichSpecification;
    }

    /**
     * {@inheritDoc}
     */
    public function shouldRun($candidate): bool
    {
        return $this->isVIPSpecification
            ->and($this->isRichSpecification->not())
            ->isSatisfiedBy($candidate)
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function execute($candidate)
    {
        /** @var User $candidate */
        return $candidate->setMoney($candidate->getMoney() + self::BONUS);
    }
}
