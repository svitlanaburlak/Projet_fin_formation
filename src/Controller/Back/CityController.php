<?php

namespace App\Controller\Back;

use App\Entity\City;
use App\Form\CityType;
use App\Repository\CityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/admin/cities", name="admin_city_")
 */
class CityController extends AbstractController
{
    /**
     * @Route("/", name="list", methods={"GET"})
     */
    public function list(CityRepository $cityRepository): Response
    {
        return $this->render('back/city/list.html.twig', [
            'controller_name' => 'CityController',
            'cities' => $cityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="create", methods={"GET", "POST"})
     */
    public function create(
        Request $request, 
        CityRepository $cityRepository, 
        SluggerInterface $slugger): Response
    {
        $city = new City();

        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // upload an image for a city
            $uploadedImage = $form['image']->getData();
                if ($uploadedImage) {
                    $originalFilename = pathinfo($uploadedImage->getClientOriginalName(), PATHINFO_FILENAME);
                    $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedImage->guessExtension();

                    try {
                        $uploadedImage->move(
                            $this->getParameter('kernel.project_dir').'/public/city_image',
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }

                    $city->setImage('https://www.demo-tribu.tech/public/city_image/'. $newFilename);
                }
            
            $city->setSlug($slugger->slug(strtolower($city->getName())));
            $cityRepository->add($city, true);

            $this->addFlash('success', 'Ville ajoutée');
            return $this->redirectToRoute('admin_city_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/city/create.html.twig', [
            'city' => $city,
            'form' => $form,
        ]);
    }

    /**
     * @Route ("/{id}", name="read", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function read(City $city): Response
    {
        return $this->render('back/city/read.html.twig', [
            'city' => $city,
        ]);
    }

    /**
     * @Route ("/{id}/update", name="update", requirements={"id"="\d+"}, methods={"GET", "POST"})
     */
    public function update(Request $request, City $city, CityRepository $cityRepository): Response
    {
        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cityRepository->add($city, true);

            $this->addFlash('warning', 'Ville modifiée');
            return $this->redirectToRoute('admin_city_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/city/update.html.twig', [
            'city' => $city,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", requirements={"id"="\d+"}, methods={"POST"})
     */
    public function delete(Request $request, City $city, CityRepository $cityRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$city->getId(), $request->request->get('_token'))) {
            $cityRepository->remove($city, true);
        }

        $this->addFlash('success', 'Ville supprimée');
        return $this->redirectToRoute('admin_city_list', [], Response::HTTP_SEE_OTHER);
    }
}
