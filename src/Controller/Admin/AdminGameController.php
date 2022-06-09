<?php

namespace App\Controller\Admin;

use App\Repository\GamesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/game')]
class AdminGameController extends AbstractController
{
    #[Route('/', name: 'app_admin_game_index')]
    public function index(GamesRepository $gameRepository): Response
    {
        return $this->render('admin/game/index.html.twig', [
            'games' => $gameRepository->findAll(),
        ]);
    }


}