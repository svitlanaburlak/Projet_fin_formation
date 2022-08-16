<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        // to get always the same generated data
        $faker->seed(42);
        $nbUser = 15;

        $adminUser = new User();
        $adminUser->setEmail('admin@tribu.fr');
        $adminUser->setFirstname('Admin');
        $adminUser->setLastname('Tribu');
        $adminUser->setPresentation('Admin presentation');
        $adminUser->setRoles(['ROLE_ADMIN']);

        $hashedPassword = $this->passwordHasher->hashPassword($adminUser, 'tribu');
        $adminUser->setPassword($hashedPassword);

        $manager->persist($adminUser);

        $stdUser = new User();
        $stdUser->setEmail('user@tribu.fr');
        $stdUser->setFirstname('User');
        $stdUser->setLastname('Tribu');
        $stdUser->setPresentation('User presentation');
        $stdUser->setRoles(['ROLE_USER']);

        $hashedPassword = $this->passwordHasher->hashPassword($stdUser, 'tribu');
        $stdUser->setPassword($hashedPassword);

        $this->addReference($stdUser->getEmail(), $stdUser);

        $manager->persist($stdUser);

        for( $i = 0; $i < $nbUser; $i++)
        {
            $userObj = new User();
            $userObj->setEmail($faker->unique()->email());
            $userObj->setFirstname($faker->firstName());
            $userObj->setLastname($faker->lastName());
            $userObj->setRoles(['ROLE_USER']);
            $hashedPassword = $this->passwordHasher->hashPassword($userObj, 'tribu');
            $userObj->setPassword($hashedPassword);

            $manager->persist($userObj);

            $this->addReference($userObj->getEmail(), $userObj);

            // todo 
            // $userObj->setCity();
        }

        $manager->flush();
    }
}
