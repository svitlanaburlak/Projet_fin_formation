<?php

namespace App\Controller\Back;

use DateTime;
use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/admin/posts", name="admin_post_")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="list", methods={"GET"})
     */
    public function list(PostRepository $postRepo): Response
    {
        return $this->render('back/post/list.html.twig', [
            'posts' => $postRepo->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="create", methods={"GET", "POST"})
     */
    public function create(Request $request, PostRepository $postRepo): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $uploadedImage = $form['image']->getData();
            // dd($uploadedImage);
            if($uploadedImage) {
                $originalFilename = pathinfo($uploadedImage->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedImage->guessExtension();

                try {
                    $uploadedImage->move(
                        $this->getParameter('kernel.project_dir').'/public/post_image', 
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
    
                //todo how to make th URL of the server
                $post->setImage('https://pierre-henri-kocan-server.eddi.cloud/projet-reseau-social-back/public/post_image/'. $newFilename);
            }

            $post->setCreatedAt(new DateTime());
            //! if user doesnt provide URl for image, it will set image of the city
            $city = $post->getCity();
            if(!$post->getImage())
            {
                $post->setImage($city->getImage());
            }
            //!========

            $postRepo->add($post, true);

            $this->addFlash('success', 'Point d\'intérêt ajouté');
            return $this->redirectToRoute('admin_post_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/post/create.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="read", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function read(Post $post): Response
    {
        return $this->render('back/post/read.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @Route("/{id}/update", name="update", requirements={"id"="\d+"}, methods={"GET", "POST"})
     */
    public function update(Request $request, Post $post, PostRepository $postRepo): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $post->setUpdatedAt(new DateTime());
            $postRepo->add($post, true);
            
            $this->addFlash('warning', 'Point d\'intérêt modifié');
            return $this->redirectToRoute('admin_post_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/post/update.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", requirements={"id"="\d+"}, methods={"POST"})
     */
    public function delete(Request $request, Post $post, PostRepository $postRepo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $postRepo->remove($post, true);
        }

        $this->addFlash('danger', 'Point d\'intérêt supprimé');
        return $this->redirectToRoute('admin_post_list', [], Response::HTTP_SEE_OTHER);
    }


}
