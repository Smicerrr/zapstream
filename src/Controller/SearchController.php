<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(): Response
    {
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }

    public function searchBar()
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('handleSearch'))
            //->setMethod('GET')
            ->add('query', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez un mot-clé'
                ]
            ])
            ->add('recherche', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ->getForm();
        return $this->render('search/searchBar.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/handleSearch', name: 'handleSearch')]
    public function handleSearch(Request $request, GameRepository $gameRepository)
    {
        //dd($request);
        //$query = $request->request->get('form');

        if(!empty($request->request->all('form')['query'])) {
            $query = $request->request->all('form')['query'];
        }


        if(!empty($query)) {
            $games = $gameRepository->findGamesByName($query);
        } elseif (empty($query)) {
            $games = ['aucun jeu'];
        }
        return $this->render('search/index.html.twig', [
            'games' => $games
        ]);
    }

}
