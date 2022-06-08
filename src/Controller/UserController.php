<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        $user = new User();
        $form = $this->createForm(EditUserType::class, $user);
        return $this->render('user/user.html.twig', [
            'formEdit' => 'formEdit',
            'editForm' => $form->createView(),
        ]);
    }
}
