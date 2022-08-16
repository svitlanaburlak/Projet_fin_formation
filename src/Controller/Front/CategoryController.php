<?php

namespace App\Controller\Front;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/api", name="api_category_")
     */

class CategoryController extends AbstractController
{
    /**
     * @Route("/cities/{city_id}/categories/{id}/posts", name="list", methods={"GET"}, requirements={"id"="\d+"}, requirements={"city_id"="\d+"})
     */
    public function list(CategoryRepository $categoryRepo, int $id, int $city_id): Response
    {
        $category = $categoryRepo->find($id); 
        $postList = $categoryRepo->findByCategory($city_id, $id);
        return $this->json($postList, 200, [], ['groups' => 'api_category_post']);
    }
}
