<?php

namespace App\Controller\Security;

use App\Form\Security\LoginForm;
use App\Form\Security\RegisterForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(): Response
    {
        $form = $this->createForm(LoginForm::class);

        return $this->render('security/login.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/register', name: 'register')]
    public function register(): Response
    {
        $form = $this->createForm(RegisterForm::class);

        return $this->render('security/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout(): Response
    {
       return $this->render('security/logout.html.twig');
    }
}
