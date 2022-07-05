<?php

namespace App\Controller\User;

use App\Components\User\UserFactory;
use App\Components\User\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserCreateAction extends AbstractController
{
    public function __invoke($data, UserFactory $userFactory, UserManager $userManager)
    {
        // TODO: Implement __invoke() method.
        $user = $userFactory->create($data->getEmail(), $data->getPassword());
        $userManager->save($user, true);
        return $user;



    }

}