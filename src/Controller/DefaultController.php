<?php

namespace App\Controller;

use App\Form\ContactForm;
use App\Service\JwtCookieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

final class DefaultController extends AbstractController
{
    public function __construct(
        private readonly ParameterBagInterface $params,
        private readonly MailerInterface $mailer
    ) {}

    /**
     * @param Request $request
     * @param JwtCookieService $cookieService
     * @return Response
     * @throws TransportExceptionInterface
     */
    #[Route('/', name: 'default')]
    public function index(
        Request $request,
        JwtCookieService $cookieService
    ): Response
    {
        $email = $cookieService->getEmailFromJwtToken();

        $form = $this->createForm(ContactForm::class, [
            'email' => $email,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->mail($data);
        }

        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param array $data
     * @return void
     * @throws TransportExceptionInterface
     */
    private function mail(array $data): void
    {
        $to = $this->params->get('email_to');

        $email = (new Email())
            ->from($data['email'])
            ->to($to)
            ->subject($data['subject'])
            ->text($data['message']);

        $this->mailer->send($email);
    }
}
