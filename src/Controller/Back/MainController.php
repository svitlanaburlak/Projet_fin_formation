<?php

namespace App\Controller\Back;

use App\Repository\CityRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home")
     * @return Response
     */
    public function index(CityRepository $cityRepo, UserRepository $userRepo, PostRepository $postRepo ): Response
    {
        $cityList = $cityRepo->findAll();
        $cityRandom = $cityList[array_rand($cityList)];

        $postList = $postRepo->findAll();
        $postRandom = $postList[array_rand($postList)];
        
        return $this->render('back/main/index.html.twig', [
            'city' => $cityRandom,
            'post' => $postRandom
        ]);
    }
}