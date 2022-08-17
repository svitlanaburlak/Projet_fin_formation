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
        return $this->render('back/city/list.html.twig', [
            'controller_name' => 'CityController',
            'cities' => $cityRepo->findAll(),
        ]);
    }

    /**
     * @Route("/", name="create", methods={"POST"})
     */
    public function create(Request $request, CityRepository $cityRepo): Response
    {
        $city = new City();

        // todo créer le form CityType
        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($city);

        if ($form->isSubmitted() && $form->isValid()) {
            $cityRepo->add($city, true);

            return $this->redirectToRoute('back_city_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/city/new.html.twig', [
            'city' => $city,
            'form' => $form,
        ]);
    }
}
