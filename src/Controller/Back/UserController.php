<?php

namespace App\Controller\Back;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

    /**
     * @Route("/admin/users")
     */

class UserController extends AbstractController
{

    /**
     * @Route("/create", name="app_admin_user_create", methods={"GET", "POST"})
     */

    public function create(Request $request, UserPasswordHasherInterface $passwordHasher, UserRepository $userRepository)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $passwordClear = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword($user, $passwordClear);
            $user->setPassword($hashedPassword);

            $userRepository->add($user, true);

            return $this->redirectToRoute('app_admin_user_create', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_user_read", methods={"GET"}, requirements={"id"="\d+"})
     */

    public function read(User $user): Response
    {
        return $this->render('back/user/read.html.twig', [
            'user' => $user,
        ]);
    }

     /**
     * @Route("/{id}/update", name="app_admin_user_update", methods={"GET", "POST"})
     * @return Response
     */
    public function update(Request $request, Security $security, User $user, UserPasswordHasherInterface $passwordHasher, UserRepository $userRepository)
    {

        //$this->denyAccessUnlessGranted('USER_UPDATE', $user);

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // est ce qu'un mot de passe a été saisi

            $passwordClear = $form->get('password')->getData();
            if (! empty($passwordClear))
            {
                // si oui alors le hashé et le remplacer dans l'objet user
                $hashedPassword = $passwordHasher->hashPassword($user, $passwordClear);
                $user->setPassword($hashedPassword);
            }

            $userRepository->add($user, true);

            return $this->redirectToRoute('app_admin_user_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/user/update.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_admin_user_list', [], Response::HTTP_SEE_OTHER);
    }

     /**
     * @Route("/", name="app_admin_user_list", methods={"GET"})
     */
    public function list(UserRepository $userRepo): Response
    {
        return $this->render('Back/user/list.html.twig', [
            'users' => $userRepo->findAll(),
        ]);
    }
}
