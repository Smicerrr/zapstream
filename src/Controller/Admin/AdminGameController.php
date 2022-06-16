<?php

namespace App\Controller\Admin;

use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Gumlet\ImageResize;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;
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
    public function new(Request $request, GameRepository $gameRepository, SluggerInterface $slugger): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $gameFile = $form->get('gameImage')->getData();

            if ($gameFile) {
                $originalFilename = pathinfo($gameFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $gameFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $gameFile->move(
                        $this->getParameter('game_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $image = new ImageResize($this->getParameter('game_directory') . '/' . $newFilename);
                $image->crop(500, 280, true, ImageResize::CROPCENTER);
                $image->save($this->getParameter('game_directory') . '/' . $newFilename);
                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $game->setImage($newFilename);
                //$em->persist($actu);
                //$em->flush();

                $game->setCreatedAt(new \DateTimeImmutable());
                $game->setUser($this->getUser());
                $gameRepository->add($game, true);

                return $this->redirectToRoute('app_admin_game_index');
            }
        }

        return $this->renderForm('admin/game/new.html.twig', [
            //'game' => $game,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_game_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, $id, GameRepository $gameRepository): Response
    {
        $game = $gameRepository->find($id);
        if(!$game) {
            throw $this->createNotFoundException('no game');
        }
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gameRepository->add($game, true);

            return $this->redirectToRoute('app_admin_game_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/game/edit.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }
}