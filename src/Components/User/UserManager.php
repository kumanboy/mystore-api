<?php

namespace App\Components\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserManager
{

    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function save(User $user, bool $isNeedFlush = false)
    {
        $this->entityManager->persist($user);

        if($isNeedFlush) {
            $this->entityManager->flush();
        }

    }

}