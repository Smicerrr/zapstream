<?php

namespace App\Controller\Admin;

use App\Repository\ActuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/actu')]
class AdminActuController extends AbstractController
{
    #[Route('/', name: 'app_admin_actu_index')]
    public function index(ActuRepository $actuRepository): Response
    {
        $currentUser = $this->getUser();

        return $this->render('admin/actu/index.html.twig', [
            'currentUser' => $currentUser,
            'actus' => $actuRepository->findAll(),

        ]);
    }


}