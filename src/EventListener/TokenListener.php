<?php
namespace App\EventListener;

use App\Entity\User;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class TokenListener
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function onJwtCreated(JWTCreatedEvent $event): void
    {
        $user = $event->getUser();
        $email = $user->getUserIdentifier();
        // dd($email);

        $userDB = $this->userRepository->findByEmail($email);
        // dd($userDB);
        $payload = $event->getData();
        // dd($payload);
        $payload['id'] = $userDB->getId();
        // dd($payload['id']);

        $event->setData($payload);
    }
}