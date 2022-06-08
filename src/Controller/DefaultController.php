<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('default/home.html.twig', [
            'users' => $users
        ]);
    }

    #[Route('/infos', name: 'app_infos')]
    public function infos(): Response
    {
        return $this->render('default/infos.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
