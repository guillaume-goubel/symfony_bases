<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\FormType;
use App\Form\RegistrationType;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;




class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="user_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {

        //Récupère les erreurs de connexion s'il y en a
        $error = $authenticationUtils->getLastAuthenticationError();

        // Récupère l'identifiant rentré par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
/*         // controller can be blank: it will never be executed!
        throw new \Exception('Don\'t forget to activate logout in security.yaml'); */

        return $this->render('main/home.html.twig', [
        ]);
    }



}
