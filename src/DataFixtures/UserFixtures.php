<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Service\Specification\User\IsVIP;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class UserFixtures
 *
 * @package App\DataFixtures
 */
class UserFixtures extends Fixture
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userVIP = (new User())
            ->setUsername('userVIP')
            ->setPassword('password')
            ->setMoney(100)
            ->addRole(IsVIP::VIP_KEY)
            ->setCreatedAt(new DateTime('2020-09-16'))
        ;

        $userNew = (new User())
            ->setUsername('userNew')
            ->setPassword('password')
            ->setMoney(100)
        ;

        $userNewVIP = (new User())
            ->setUsername('userNewVIP')
            ->setPassword('password')
            ->setMoney(100)
            ->addRole(IsVIP::VIP_KEY)
        ;

        $userRich = (new User())
            ->setUsername('userRich')
            ->setPassword('password')
            ->setMoney(20000)
        ;

        $userGreat = (new User())
            ->setUsername('userGreat')
            ->setPassword('password')
            ->setMoney(100)
            ->setTotalLostBets(1)
            ->setTotalWonBets(9)
            ->setCreatedAt(new DateTime('2020-09-16'))
        ;

        $manager->persist($userVIP);
        $manager->persist($userNew);
        $manager->persist($userNewVIP);
        $manager->persist($userRich);
        $manager->persist($userGreat);

        $manager->flush();
    }
}
