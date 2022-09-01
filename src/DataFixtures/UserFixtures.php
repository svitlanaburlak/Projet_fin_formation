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
        $faker = \Faker\Factory::create('fr_FR');
        // to get always the same generated data
        $faker->seed(42);
        $nbUser = 15;

        $adminUser = new User();
        $adminUser->setEmail('admin@tribu.fr');
        $adminUser->setFirstname('Admin');
        $adminUser->setLastname('Tribu');
        $adminUser->setPresentation('Admin presentation');
        $adminUser->setRoles(['ROLE_ADMIN']);
        $adminUser->setImage('https://avataaars.io/?avatarStyle=Circle&topType=LongHairCurvy&accessoriesType=Blank&facialHairType=MoustacheMagnum&facialHairColor=Blonde&clotheType=ShirtVNeck&eyeType=Dizzy&eyebrowType=Default&mouthType=ScreamOpen&skinColor=Brown');

        $hashedPassword = $this->passwordHasher->hashPassword($adminUser, 'tribu');
        $adminUser->setPassword($hashedPassword);

        $manager->persist($adminUser);

        $stdUser = new User();
        $stdUser->setEmail('user@tribu.fr');
        $stdUser->setFirstname('Kiki');
        $stdUser->setLastname('Le Fada');
        $stdUser->setPresentation('User presentation');
        $stdUser->setRoles(['ROLE_USER']);
        $stdUser->setImage('https://avataaars.io/?avatarStyle=Circle&topType=WinterHat4&accessoriesType=Prescription02&facialHairType=MoustacheFancy&facialHairColor=BrownDark&clotheType=ShirtScoopNeck&eyeType=Squint&eyebrowType=UpDownNatural&mouthType=Tongue&skinColor=Brown');
        $stdUser->setCity($this->getReference('Le Cap'));

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
            $userObj->setPresentation($faker->paragraph());
            $userObj->setRoles(['ROLE_USER']);
            $hashedPassword = $this->passwordHasher->hashPassword($userObj, 'tribu');
            $userObj->setPassword($hashedPassword);

            $manager->persist($userObj);

            $this->addReference($userObj->getEmail(), $userObj);

        }

        $manager->flush();
    }
}
