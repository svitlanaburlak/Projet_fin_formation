<?php

namespace App\Controller\Front;

use App\Repository\CityRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/search", name="api_search", methods={"GET"})
 * @return Response
 */
class SearchController extends AbstractController
{ 
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    /**
     * @Route("/{slug}", name="api_search", methods={"GET"})
     * @return Response
     */
    public function search($slug, CityRepository $cityRepo): Response
    {
        $cityToSearch = $this->slugger->slug(strtolower($slug));
        $city = $cityRepo->findBySlug($cityToSearch);

        if (empty($city))
        {
            // if city is not found, we return 404
            return $this->json('No city found with name ' . $slug, Response::HTTP_NOT_FOUND);
        }

        return $this->json($city, 200, [], ['groups' => 'api_city_read']);
    }
}