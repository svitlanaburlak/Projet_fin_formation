<?php

namespace App\Controller\Front;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Route("/api", name="api_user_")
 */
class UserController extends AbstractController
{

    /**
     * @Route("/users", name="create", methods={"POST"})
     */
     public function create(
        Request $request, 
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        UserPasswordHasherInterface $passwordHasher,
        UserRepository $userRepo
        )
    {

        $data = $request->getContent();

        $user = $serializer->deserialize($data, User::class, 'json');

        $errors = $validator->validate($user);

        if($userRepo->findByEmail($user->getEmail())){

            return $this->json('L\'utilisateur avec cet email existe déjà' , Response::HTTP_BAD_REQUEST);
        }

        if (count($errors) > 0) {

            $errorsString = (string) $errors;

            return $this->json($errorsString, Response::HTTP_BAD_REQUEST);
        }

        $passwordClear = $user->getPassword();
        $hashedPassword = $passwordHasher->hashPassword($user, $passwordClear);
        $user->setPassword($hashedPassword);

        // to make the firstname and lastname start from capital letter even if provided in lowercase
        $user->setFirstname(ucfirst($user->getFirstname()));
        $user->setLastname(ucfirst($user->getLastname()));

        // to add random avatar with 
        $faker = \Faker\Factory::create();
        $avataaar = new \Avataaar\Avataaar();
        $faker->addProvider(new \Avataaar\FakerProvider($faker));
        if(empty($user->getImage())) 
        {
            $user->setImage($faker->avataaar); 
        }

        $userRepo->add($user, true);

        return $this->json([$user->getId(), $user->getEmail()], Response::HTTP_CREATED);
    }

    /**
     * @Route("/users", name="read", methods={"GET"})
     */
    public function read(Security $security): Response
    {
        $user = $security->getUser();
        return $this->json($user, 200, [], ['groups' => 'api_user_read']);
    }

    /**
     * @Route("/users", name="update", methods="PATCH")
     * @return Response
     */
    public function update(
        Security $security,
        UserRepository $userRepo,
        Request $request, 
        SerializerInterface $serializer,
        ValidatorInterface $validator
        )
    {
        $user = $security->getUser();

        // if current user doesnt have the role of Admin or is not the author of this post, it will thrown an "acces denied"
        if ($this->getUser()->getRoles() !== ['ROLE_ADMIN']) {
            if ($user !== $this->getUser()) {
                return $this->json("Vous n'avez pas le droit de modifier cet utilisateur", 403);
            }
        }

        if (!$user)
        {
            $errors = [ 
                'error' => true,
                'message' => 'No user found'
            ];
            $errorsString = (string) $errors;
            return $this->json($errorsString, Response::HTTP_BAD_REQUEST);
        }

        $data = $request->getContent();

        $user = $serializer->deserialize($data, User::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $user]);

        $errors = $validator->validate($user);

        if (count($errors) > 0) {

            $errorsString = (string) $errors;

            return $this->json($errorsString, Response::HTTP_BAD_REQUEST);
        }

        $userRepo->add($user, true);

        return $this->json('Utilisateur modifié', Response::HTTP_OK);
    }

}
