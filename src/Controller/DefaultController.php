<?php

namespace App\Controller;

use App\Repository\ActuRepository;
use App\Repository\GameRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(ActuRepository $actuRepository, UserRepository $userRepository, GameRepository $gameRepository, PostRepository $postRepository): Response
    {
        $publications = $postRepository->findByMaxNumber();
        $games = $gameRepository->findByMaxNumber();
        $actualites = $actuRepository->findByMaxNumber();
        $streamers = $userRepository->findByMaxNumber();
        return $this->render('default/home.html.twig', [
            'actualites' => $actualites,
            'streamers' => $streamers,
            'games'=> $games,
            'publications' => $publications
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
