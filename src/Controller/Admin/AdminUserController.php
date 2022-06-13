<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/user')]
class AdminUserController extends AbstractController
{
    #[Route('/', name: 'app_admin_user_index')]
    public function index(UserRepository $userRepository): Response
    {
        $currentUser = $this->getUser();

        $users = $userRepository->findAll();
        return $this->render('admin/user/index.html.twig', [
            'users' => $users,
            'currentUser' => $currentUser,
        ]);
    }


}
