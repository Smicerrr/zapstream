<?php

namespace App\Controller;

use App\Repository\ActuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ActuController extends AbstractController
{
    #[Route('/actu', name: 'app_actu')]
    public function index(ActuRepository $actuRepository): Response
    {
        $actualites = $actuRepository->findAll();
        return $this->render('actu/actu.html.twig', [
            'actualites' => $actualites,
        ]);
    }

    #[Route('/actu/one/{id}', name: 'app_one_actu')]
    public function single($id, ActuRepository $actuRepository): Response
    {
        $actu = $actuRepository->find($id);
        if(empty($actu)) {
            throw $this->createNotFoundException('Actu existe pas');
        }

        return $this->render('actu/single.html.twig', [
            'actu' => $actu
        ]);
    }

}
