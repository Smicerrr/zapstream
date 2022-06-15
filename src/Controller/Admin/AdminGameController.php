<?php

namespace App\Controller\Admin;

use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/game')]
class AdminGameController extends AbstractController
{
    #[Route('/', name: 'app_admin_game_index')]
    public function index(GameRepository $gameRepository): Response
    {
        $currentUser = $this->getUser();
        $games = $gameRepository->findAll();
        return $this->render('admin/game/index.html.twig', [
            'currentUser' => $currentUser,
            'games' => $games
        ]);
    }

    #[Route('/new', name: 'app_admin_game_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GameRepository $gameRepository): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $game->setCreatedAt(new \DateTimeImmutable());
            $game->setUser($this->getUser());
            $gameRepository->add($game, true);

            return $this->redirectToRoute('app_admin_game_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/game/new.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }
}