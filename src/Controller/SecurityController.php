<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RegistrationType;

use App\Form\FormType;
use App\Entity\User;




class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="user_login")
     */
    public function login()
    {
        return $this->render('security/login.html.twig', [
        ]);
    }

}
