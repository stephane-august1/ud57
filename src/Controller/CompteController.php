<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ReloadPassWordType;
use App\Repository\UserRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CompteController extends AbstractController
{

    /**
     * @Route("/{id}/ReloadPassword", name="reloadpassword", methods={"GET","POST"})
     */
    //method pour changer son password
    public function reloadPassword(
        Request $request,

        User $user,
        EntityManagerInterface $manager,
        UserRepository $userRepository,

        UserPasswordEncoderInterface $encoder
    ): Response {
        $form = $this->createForm(ReloadPassWordType::class, $this->getUser());
        $form->handleRequest($request);
        $user = $this->getUser();
        $message = "";
        if ($form->isSubmitted() && $form->isValid()) {
            if (password_verify($user->getCurrentPassword(), $user->getPassword()) === true) {
                echo 'ok check good';

                $hash = $encoder->encodePassword($user, $user->getPassword());
                $user->setPassword($hash);

                $manager->persist($user);
                $manager->flush();
                return $this->redirectToRoute('app_logout');
            } else {
                $message = 'votre mot de passe est different! entrez le même';
            }
        }
        //injection dans la vue des infos user,du formulaire pour changer de mot de pass et des horaires
        return $this->render('compte/reloadpassword.html.twig', [
            'user' => $this->getUser(),
            'message' => $message,
            'form' => $form->createView(),

        ]);
    }
}
