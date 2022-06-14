<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    #[Route('/game', name: 'app_game')]
    public function index(GameRepository $gameRepository): Response
    {
        $games = $gameRepository->findAll();
        return $this->render('game/game.html.twig', [
            'games' => $games,
        ]);
    }

    #[Route('/game/one/{id}', name: 'app_one_game')]
    public function single($id, GameRepository $gameRepository): Response
    {
        $game = $gameRepository->find($id);
        if(empty($game)) {
            throw $this->createNotFoundException('Le jeu n\'existe pas');
        }

        return $this->render('game/single.html.twig', [
            'game' => $game
        ]);
    }

}
