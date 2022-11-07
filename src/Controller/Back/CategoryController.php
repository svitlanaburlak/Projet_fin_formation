<?php

namespace App\Controller\Back;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/categories", name="admin_category_")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="list", methods={"GET"})
     */
    public function list(CategoryRepository $categoryRepository): Response
    {
        return $this->render('back/category/list.html.twig', [
            'controller_name' => 'CategoryController',
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="create", methods={"GET", "POST"})
     */
    public function create(Request $request, CategoryRepository $categoryRepository): Response
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryRepository->add($category, true);

            $this->addFlash('success', 'Catégorie ajoutée');
            return $this->redirectToRoute('admin_category_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/category/create.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    /**
     * @Route ("/{id}", name="read", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function read(Category $category): Response
    {
        return $this->render('back/category/read.html.twig', [
            'category' => $category,
        ]);
    }

    /**
     * @Route ("/{id}/update", name="update", requirements={"id"="\d+"}, methods={"GET", "POST"})
     */
    public function update(Request $request, Category $category, CategoryRepository $categoryRepository): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryRepository->add($category, true);

            $this->addFlash('warning', 'Catégorie modifiée');
            return $this->redirectToRoute('admin_category_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/category/update.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", requirements={"id"="\d+"}, methods={"POST"})
     */
    public function delete(Request $request, Category $category, CategoryRepository $categoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $categoryRepository->remove($category, true);
        }

        $this->addFlash('success', 'Catégorie supprimée');
        return $this->redirectToRoute('admin_category_list', [], Response::HTTP_SEE_OTHER);
    }
}