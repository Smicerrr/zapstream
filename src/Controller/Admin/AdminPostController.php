<?php

namespace App\Controller\Admin;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/post')]
class AdminPostController extends AbstractController
{
    #[Route('/', name: 'app_admin_post_index')]
    public function index(PostRepository $postRepository): Response
    {
        $currentUser = $this->getUser();
        $posts = $postRepository->findAll();
        return $this->render('admin/post/index.html.twig', [
            'currentUser' => $currentUser,
            'posts' => $posts
        ]);
    }
}