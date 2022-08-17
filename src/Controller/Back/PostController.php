<?php

namespace App\Controller\Back;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin", name="admin_post_")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/posts", name="list", methods={"GET"})
     */
    public function list(PostRepository $postRepo): Response
    {
        return $this->render('back/post/list.html.twig', [
            'posts' => $postRepo->findAll(),
        ]);
    }

    /**
     * @Route("/posts/create", name="create", methods={"GET", "POST"})
     */
    public function create(Request $request, PostRepository $postRepo): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $post->setCreatedAt(new DateTimeImmutable());
            $postRepo->add($post, true);

            $this->addFlash('success', 'Point d\'interet ajouté');
            return $this->redirectToRoute('admin_post_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/post/create.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/posts/{id}", name="read", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function read(Post $post): Response
    {
        return $this->render('back/post/read.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @Route("/posts/{id}/update", name="update", requirements={"id"="\d+"}, methods={"GET", "POST"})
     */
    public function update(Request $request, Post $post, PostRepository $postRepo): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $postRepo->add($post, true);
            
            $this->addFlash('warning', 'Point d\'interet modifié');
            return $this->redirectToRoute('admin_post_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/post/update.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/posts{id}", name="delete", requirements={"id"="\d+"}, methods={"POST"})
     */
    public function delete(Request $request, Post $post, PostRepository $postRepo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $postRepo->remove($post, true);
        }

        $this->addFlash('danger', 'Point d\'interet supprimé');
        return $this->redirectToRoute('admin_post_list', [], Response::HTTP_SEE_OTHER);
    }


}
