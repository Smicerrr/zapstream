<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\CreatePublicationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function createPublication(Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = new Post();
        $form = $this->createForm(CreatePublicationType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $post->setTitle('title');
            $post->setDescription('description');
            $newDate = new \DateTimeImmutable;
            $post->setCreatedAt($newDate);
            $post->setModifiedAt($newDate);
            $entityManager->persist($post);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_post');
        }

        return $this->render('post/post.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
