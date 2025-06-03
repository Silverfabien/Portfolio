<?php

namespace App\Controller\Security;

use App\Form\Security\ForgotPasswordForm;
use App\Form\Security\ResetForgotPasswordForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    #[Route('/forgot-password', name: 'forgot_password')]
    public function forgotPassword(Request $request): Response
    {
        $jwt = $request->cookies->get('jwt_token');

        if ($jwt) {
            return $this->redirectToRoute('');
        }

        $form = $this->createForm(ForgotPasswordForm::class);

        return $this->render('security/forgot-password.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/reset-forgot-password/{token}', name: 'reset_forgot_password')]
    public function resetForgotPassword(Request $request, string $token): Response
    {
        $jwt = $request->cookies->get('jwt_token');

        if ($jwt) {
            return $this->redirectToRoute('');
        }

        $form = $this->createForm(ResetForgotPasswordForm::class);

        return $this->render('security/reset-forgot-password.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
