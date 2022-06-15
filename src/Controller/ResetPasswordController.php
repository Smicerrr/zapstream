<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Routing\Generator\UrlGenerator;
use App\Repository\UserRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use App\Form\ResetPasswordType;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResetPasswordController extends AbstractController
{
    #[Route('/reset/password', name: 'app_reset_password')]
    public function index(Request $request, UserRepository $UserRepository, TokenGeneratorInterface $tokenGenerator, MailerInterface $mailer): Response
    {
        $success = true;
        $form = $this->createForm(ResetPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            $user = $UserRepository->findOneBy(['email' => $email]);
            if (!$user) {
                die('mort');
            }
            $newToken = $tokenGenerator->generateToken(); 
            $user->setToken($newToken);
            $UserRepository->add($user);  
            $url = $this->generateUrl('app_modif_password',['token'=>urlencode($user->getToken()), 'id' => urlencode($user->getId())], UrlGenerator::ABSOLUTE_URL);
       
            $sendMailer = (new TemplatedEmail())
            ->from('fabien@example.com')
            ->to($email)
            ->subject('Thanks for signing up!')

            // path of the Twig template to render
            ->htmlTemplate('admin/emails/forgetPassword.html.twig')

            // pass variables (name => value) to the template
            ->context([
                'url' => $url,
            ]);
            $mailer->send($sendMailer);
        }
        return $this->render('reset_password/index.html.twig', [
            'form' => $form->createView(),
            'success' => true
        ]);
    }

    #[Route('/modif/password/{token}/{id}', name: 'app_modif_password')]
    public function modif(Request $request, UserRepository $UserRepository): Response
    {
        $user = $UserRepository->findOneBy(['id'=> $id, 'token'=>$token]);
        if (!$user) {
            throw $this->createNotFoundException('error');
        }
        $form = $this->createForm(ModifPasswordType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            die('ok');
        }
        return $this->render('reset_password/modif/modif.html.twig', [
            'form' => $form
        ]);
    }
}
