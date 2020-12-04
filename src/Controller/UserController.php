<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Exception;
use NicolasJourdan\BusinessLogicBundle\Service\Rule\RulesEngine;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 */
class UserController extends RestAPIController
{
    /**
     * @Route("/users", methods={"GET"}, name="user")
     *
     * @param UserRepository $repository
     *
     * @return Response
     */
    public function getAll(UserRepository $repository)
    {
        return $this->apiResponse($repository->findAll());
    }

    /**
     * @Route("/users/christmas", methods={"PUT"}, name="user.christmas")
     *
     * @param UserRepository $repository
     * @param RulesEngine $rulesEngineChristmas
     *
     * @return Response
     */
    public function christmas(UserRepository $repository, RulesEngine $rulesEngineChristmas)
    {
        $users = $repository->findAll();

        try {
            /** @var User $user */
            foreach ($users as $user) {
                $repository->save(
                    $rulesEngineChristmas->execute($user)
                );
            }
        } catch (Exception $exception) {
            return $this->apiErrorResponse('Something happened with Doctrine');
        }

        return $this->apiResponse($users);
    }

    /**
     * @Route("/users/new_bettor", methods={"PUT"}, name="user.new_bettor")
     *
     * @param UserRepository $repository
     * @param RulesEngine $rulesEngineNewBettor
     *
     * @return Response
     */
    public function newBettor(UserRepository $repository, RulesEngine $rulesEngineNewBettor)
    {
        $users = $repository->findAll();

        try {
            /** @var User $user */
            foreach ($users as $user) {
                $repository->save(
                    $rulesEngineNewBettor->execute($user)
                );
            }
        } catch (Exception $exception) {
            return $this->apiErrorResponse('Something happened with Doctrine');
        }

        return $this->apiResponse($users);
    }
}
