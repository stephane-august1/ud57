<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class AdminOldController extends AbstractController
{
    /**
     * 
     * @IsGranted({"ROLE_ADMIN","ROLE_USER"})
     * @Route("/admin2", name="admin2", methods={"GET"})
     */
    public function index(ArticleRepository $articles, EntityManagerInterface $em, UserRepository $userRepository)
    {
        return $this->render('admin2/adminlte.html.twig', [
            //'controller_name' => 'AdminController',
            'users' => $userRepository->findAll(),
            'articles' => $articles->findAll(),
        ]);
    }
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/admin2/user", name="admin_index", methods={"GET"})
     *  
     */

    public function indexuser(UserRepository $userRepository): Response
    {
        return $this->render('admin2/indexuser.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
    /**
     * @Route("/admin2/user/{id}", name="adminuser_show", methods={"GET"})
     * 
     * 
     */
    public function show(User $user, UserRepository $userRepository, $id): Response
    {


        // recupere uniquement le user en cours de connexion
        // $user = $this->getUser();
        //dd($user);

        return $this->render('admin/adminshow.html.twig', [
            'user' => $user,
            //'user' => $userRepository->findAll(),
        ]);
    }
    /**
     * @Route("/admin2/edit/{id}", name="adminuser_edit", methods={"GET","POST"})
     */
    public function edit(
        $id,
        Request $request,
        User $user,
        EntityManagerInterface $manager,
        UserPasswordEncoderInterface $encoder
    ): Response {


        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $user->setRoles(array('ROLE_USER'));
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('admin/adminedit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("admin2/new", name="adminuser_new", methods={"GET","POST"})
     */
    public function new(
        Request $request,
        EntityManagerInterface $manager,
        UserPasswordEncoderInterface $encoder
    ): Response {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $user->setRoles(array('ROLE_USER'));
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("admin2/{id}", name="adminuser_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_index');
    }
}
