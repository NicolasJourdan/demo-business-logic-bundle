<?php

namespace App\Rule\User;

use App\Entity\User;
use App\Specification\User\IsNew;
use App\Specification\User\IsRich;
use NicolasJourdan\BusinessLogicBundle\Service\Rule\RuleInterface;

/**
 * Class NewBettorRule
 *
 * @package App\Rule\User
 */
class NewBettorBonusRule implements RuleInterface
{
    const BONUS = 100;

    private const BUSINESS_LOGIC_TAGS = [
        ['rule_user.new_bettor'],
    ];

    /**
     * @var IsNew $isNewSpecification
     */
    private $isNewSpecification;

    /**
     * @var IsRich $isRichSpecification
     */
    private $isRichSpecification;

    /**
     * NewBettorRule constructor.
     *
     * @param IsNew $isNewSpecification
     * @param IsRich $isRichSpecification
     */
    public function __construct(IsNew $isNewSpecification, IsRich $isRichSpecification)
    {
        $this->isNewSpecification = $isNewSpecification;
        $this->isRichSpecification = $isRichSpecification;
    }

    /**
     * {@inheritDoc}
     */
    public function shouldRun($candidate): bool
    {
        return $this->isNewSpecification
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

    public function getTags(): array
    {
        return [
            ['rule.christmas'],
            ['rule.salut'],
        ];
    }

}
