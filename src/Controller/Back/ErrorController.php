<?php

namespace App\Controller\Back;

use App\Repository\Error;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_category_")
 */

class ErrorController extends AbstractController
{
    /**
     * @Route("/error", name="app_error")
     */
    public function index(): Response
    {
        return $this->render('error/404.html.twig');
    }
}
