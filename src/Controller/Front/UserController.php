<?php

namespace App\Controller\Front;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

    /**
     * @Route("/api", name="api_user_")
     */

class UserController extends AbstractController
{

     /**
     * @Route("/users", name="create", methods={"POST"})
     */

     public function create(
        EntityManagerInterface $em, 
        Request $request, 
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        UserPasswordHasherInterface $passwordHasher,
        UserRepository $userRepository
        )
    {

        $data = $request->getContent();

        $user = $serializer->deserialize($data, User::class, 'json');

        $errors = $validator->validate($user);

    
        if (count($errors) > 0) {

            $errorsString = (string) $errors;

            return $this->json($errorsString, Response::HTTP_BAD_REQUEST);
        }

            $passwordClear = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword($user, $passwordClear);
            $user->setPassword($hashedPassword);
      
            
            $em->persist($user);
            $em->flush();

        return $this->json([$user->getId(), $user->getEmail()], Response::HTTP_CREATED);
    }

    /**
     * @Route("/users/{id}", name="read", methods={"GET"}, requirements={"id"="\d+"})
     */

    public function read(UserRepository $userRepo, int $id): Response
    {
        $user = $userRepo->find($id);
        return $this->json($user, 200, [], ['groups' => 'api_user_read']);
    }

     /**
     * @Route("/users/{id<\d+>}", name="update", methods="PATCH", requirements={"id"="\d+"})
     * @return Response
     */
    public function update(
        $id,
        EntityManagerInterface $em, 
        UserRepository $userRepository,
        Request $request, 
        SerializerInterface $serializer,
        ValidatorInterface $validator
        )
    {
        $user = $userRepository->find($id);

        // if current user doesnt have the role of Admin or is not the author of this post, it will thrown an "acces denied"
        if ($this->getUser()->getRoles() !== ['ROLE_ADMIN']) {
            if ($user !== $this->getUser()) {
                return $this->json("Vous n'avez pas le droit de modifier cet utilisateur", 403);
            }
        }

        if ($user === null )
        {
            $errors = [ 
                'error' => true,
                'message' => 'No user found for id [' . $id . ']'
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

        $em->flush();

        return $this->json('Utilisateur modifié', Response::HTTP_OK);
    }

}
