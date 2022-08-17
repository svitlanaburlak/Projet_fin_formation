<?php

namespace App\Controller\Back;

use App\Entity\City;
use App\Repository\CityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/cities", name="back_city_")
 */
class CityController extends AbstractController
{
    /**
     * @Route("/", name="list", methods={"GET"})
     */
    public function list(CityRepository $cityRepo): Response
    {
        return $this->render('back/city/index.html.twig', [
            'controller_name' => 'CityController',
            'cities' => $cityRepo->findAll(),
        ]);
    }

}
