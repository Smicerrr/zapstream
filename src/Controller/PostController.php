<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\UserRepository;
use App\Repository\PostRepository;
use App\Form\CreatePublicationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function createPublication(Request $request, EntityManagerInterface $entityManager,UserRepository $userRepository): Response
    {
        $post = new Post();
        $user = $this->getUser();
        $form = $this->createForm(CreatePublicationType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $newDate = new \DateTimeImmutable;
            $post->setCreatedAt($newDate);
            $post->setModifiedAt($newDate);
            $entityManager->persist($post);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_post');
        }
        $streamers= $userRepository->findById($user);
        return $this->render('post/post.html.twig', [
            'form' => $form->createView(),
            'streamers'=> $streamers,
        ]);
    }

    #[Route('/publications', name: 'app_publications')]
    public function publications(PostRepository $postRepository): Response
    {
        $publications = $postRepository->findAll();
        return $this->render('post/publications.html.twig', [
            'publications' => $publications
        ]);
    }

    #[Route('/post/singlepost/{id}', name: 'app_singlepost')]
    public function singlePublication($id, Request $request, EntityManagerInterface $entityManager,PostRepository $postRepository): Response
    {
        $singlepost = $postRepository->find($id);
        if(empty($singlepost)) {
            throw $this->createNotFoundException('Cette publication n\'existe pas ');
        }

        return $this->render('post/single-post.html.twig', [
            'singlepost' => $singlepost,
            //'twitch' => $twitch
        ]);
    }
}
