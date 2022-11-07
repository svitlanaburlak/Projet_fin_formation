<?php

namespace App\Controller\Front;

use App\Repository\CityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api_city_")
 */
class CityController extends AbstractController
{
    /**
     * @Route("/cities", name="list", methods={"GET"})
     */
    public function list(CityRepository $cityRepo): Response
    {
        $cityList = $cityRepo->findAll(); 
        return $this->json($cityList, 200, [], ['groups' => 'api_city_list']);
    }

    /**
     * @Route("/cities/{id}", name="read", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function read(CityRepository $cityRepo, int $id): Response
    {
        $city = $cityRepo->find($id); 

        if (!$city)
        {
            return $this->json('No city found with id ' . $id, Response::HTTP_NOT_FOUND);
        }

        return $this->json($city, 200, [], ['groups' => 'api_city_read']);
    }
}
