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
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/admin/users", name="admin_user_")
 */
class UserController extends AbstractController
{

    /**
     * @Route("/create", name="create", methods={"GET", "POST"})
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

            $uploadedImage = $form['image']->getData();
            if($uploadedImage) {
                $originalFilename = pathinfo($uploadedImage->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedImage->guessExtension();

                try {
                    $uploadedImage->move(
                        $this->getParameter('kernel.project_dir').'/public/user_image', 
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $user->setImage('http://localhost/My_github/Projet_fin_formation/public/user_image/'. $newFilename);
            }

            // to add random avatar with if user didnt upload one
            $faker = \Faker\Factory::create();
            $avataaar = new \Avataaar\Avataaar();
            $faker->addProvider(new \Avataaar\FakerProvider($faker));
            if(empty($user->getImage())) 
            {
               $user->setImage($faker->avataaar); 
            }
          
            $userRepository->add($user, true);

            $this->addFlash('success', 'Utilisateur ajouté');
            return $this->redirectToRoute('admin_user_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/user/create.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id"="\d+"})
     */

    public function read(User $user): Response
    {
        return $this->render('back/user/read.html.twig', [
            'user' => $user,
        ]);
    }

     /**
     * @Route("/{id}/update", name="update", methods={"GET", "POST"})
     * @return Response
     */
    public function update(Request $request, Security $security, User $user, UserPasswordHasherInterface $passwordHasher, UserRepository $userRepository)
    {

        //$this->denyAccessUnlessGranted('USER_UPDATE', $user);

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $passwordClear = $form->get('password')->getData();
            if (! empty($passwordClear))
            {
                // si oui alors le hashé et le remplacer dans l'objet user
                $hashedPassword = $passwordHasher->hashPassword($user, $passwordClear);
                $user->setPassword($hashedPassword);
            }
            
            $userRepository->add($user, true);

            $this->addFlash('warning', 'Utilisateur modifié');
            return $this->redirectToRoute('admin_user_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/user/update.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        $this->addFlash('danger', 'Utilisateur supprimé');
        return $this->redirectToRoute('admin_user_list', [], Response::HTTP_SEE_OTHER);
    }

     /**
     * @Route("/", name="list", methods={"GET"})
     */
    public function list(UserRepository $userRepo): Response
    {
        return $this->render('back/user/list.html.twig', [
            'users' => $userRepo->findAll(),
        ]);
    }
}
