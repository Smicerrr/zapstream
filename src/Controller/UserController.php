<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;
use App\Form\EditUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user')]
    public function index(): Response
    {
        $user = new User();
        $form = $this->createForm(EditUserType::class, $user);
        return $this->render('user/user.html.twig', [
            'formEdit' => 'formEdit',
            'editForm' => $form->createView(),
        ]);
    }

    #[Route('/streamer', name: 'app_streamer')]
    public function streamer(UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        return $this->render('user/streamer.html.twig', [

        ]);
    }

}
