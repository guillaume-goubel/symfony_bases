<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\FormType;
use App\Form\RegistrationType;

use App\Service\SecurityService;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use Symfony\Component\HttpFoundation\Request;

class SecurityController extends AbstractController
{
    
    /**
     * @Route("user/registration", name="user_registration")
     */
    public function registration(Request $request, SecurityService $securityService){
      
        $user = new User();
        /* $user->setRoles(['USER_ROLE']); */

        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {    
            $securityService->addUser($user);

            //  Enregistrement dans le controller ->  
            //  $em = $this->getDoctrine()->getManager();
            //  $em->persist($user);
            //  $em->flush(); 

            return $this->redirectToRoute('events_create', [
                'UserId' => $user->getId()
            ]);
        }

        return $this->render('security/registration.html.twig' , [
            'form' => $form->createView()
        ]);

    }

    
    /**
     * @Route("user/login", name="user_login")
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
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {

    }



}
