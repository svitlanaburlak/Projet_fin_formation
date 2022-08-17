<?php

namespace App\Controller\Front;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

    /**
     * @Route("/api", name="api_post_")
     */

class PostController extends AbstractController
{
     /**
     * @Route("/posts/{id}", name="read", methods={"GET"}, requirements={"id"="\d+"})
     */

    public function read(PostRepository $postRepo, int $id): Response
    {
        $post = $postRepo->find($id);
        return $this->json($post, 200, [], ['groups' => 'api_post_read']);
    }

     /**
     * @Route("/posts", name="create", methods={"POST"})
     */

     //Todo test with Thunder client 
    public function create(
        EntityManagerInterface $em, 
        Request $request, 
        SerializerInterface $serializer,
        ValidatorInterface $validator
        )
    {

        $data = $request->getContent();

        $post = $serializer->deserialize($data, Post::class, 'json');

        $errors = $validator->validate($post);

    
        if (count($errors) > 0) {

            $errorsString = (string) $errors;

            return $this->json($errorsString, Response::HTTP_BAD_REQUEST);
        }

        $em->persist($post);
        $em->flush();

        return $this->json('OK', Response::HTTP_CREATED);
    }

    /**
     * @Route("/posts/{id<\d+>}", name="update", methods="PATCH", requirements={"id"="\d+"})
     * @return Response
     */
    public function update(
        $id,
        EntityManagerInterface $em, 
        PostRepository $postRepository,
        Request $request, 
        SerializerInterface $serializer,
        ValidatorInterface $validator
        )
    {
        $post = $postRepository->find($id);

        if ($post === null )
        {
            $errors = [ 
                'error' => true,
                'message' => 'No post found for id [' . $id . ']'
            ];
            $errorsString = (string) $errors;
            return $this->json($errorsString, Response::HTTP_BAD_REQUEST);
        }

        $data = $request->getContent();

        $post = $serializer->deserialize($data, Post::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $post]);

        $errors = $validator->validate($post);

        if (count($errors) > 0) {

            $errorsString = (string) $errors;

            return $this->json($errorsString, Response::HTTP_BAD_REQUEST);
        }

        $em->flush();

        return $this->json('OK', Response::HTTP_OK);
    }
}