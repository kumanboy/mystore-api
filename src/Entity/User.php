<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\User\UserCreateAction;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get',
        'createUser' => [
            'method' => 'post',
            'path' => '/users',
            'controller' => UserCreateAction::class
        ],
        'auth' => [
            'method' => 'post',
            'path' => '/users/auth',
            'openapi_context' => ['summary' => 'Authorization']
        ]
    ],
    itemOperations: [
        'get',
        'delete'
    ]
)]
#[UniqueEntity('email', message: 'This email is already used')]
class User implements PasswordAuthenticatedUserInterface, UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Assert\Email]
    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[Assert\Length(min: 6)]
    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        // TODO: Implement getRoles() method.
        return ['ROLE_USER'];
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        // TODO: Implement getUserIdentifier() method.
        return $this->getId();
    }

    public function getUsername(): string
    {
        return $this->getEmail();
    }


}
