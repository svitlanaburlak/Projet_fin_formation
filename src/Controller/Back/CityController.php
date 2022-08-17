<?php

namespace App\Controller\Back;

use App\Entity\City;
use App\Form\CityType;
use App\Repository\CityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/cities", name="app_back_city_")
 */
class CityController extends AbstractController
{
    /**
     * @Route("/", name="list", methods={"GET"})
     */
    public function list(CityRepository $cityRepo): Response
    {
        return $this->render('back/city/list.html.twig', [
            'controller_name' => 'CityController',
            'cities' => $cityRepo->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="create", methods={"GET", "POST"})
     */
    public function create(Request $request, CityRepository $cityRepo): Response
    {
        $city = new City();

        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cityRepo->add($city, true);

            return $this->redirectToRoute('app_back_city_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/city/create.html.twig', [
            'city' => $city,
            'form' => $form,
        ]);
    }

    /**
     * @Route ("/{id}", name="read", methods={"GET"})
     */
    public function read(City $city): Response
    {
        return $this->render('back/city/read.html.twig', [
            'city' => $city,
        ]);
    }
}
