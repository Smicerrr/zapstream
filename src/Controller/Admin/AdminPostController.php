<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/new', name: 'app_admin_post_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PostRepository $postRepository): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setCreatedAt(new \DateTimeImmutable());
            $post->setUser($this->getUser());
            $postRepository->add($post, true);

            return $this->redirectToRoute('app_admin_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/post/new.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }
}