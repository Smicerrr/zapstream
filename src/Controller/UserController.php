<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;
use App\Form\EditUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user')]
    public function index(Request $request, UserRepository $userRepository,EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $em = $this->getDoctrine()->getManager();
            // $newPseudo = $form->get('pseudo')->getData();
            // $modif->flush();
            $em->persist($user);
            $em->flush();
            // $userRepository->add($user);

            $this->addFlash('success','Profil modifié avec succès !');
            return $this->redirectToRoute('app_user');
        }

        return $this->render('user/user.html.twig', [
            'editForm' => $form->createView(),
        ]);
    }

    #[Route('/streamer', name: 'app_streamer')]
    public function streamer(UserRepository $userRepository): Response
    {
        $streamers = $userRepository->findAll();
        return $this->render('user/streamer.html.twig', [
            'streamers' => $streamers
        ]);
    }
    #[Route('/avatar', name: 'app_avatar')]
    public function modifAvatar(): Response
    {
        $avatar = 'avatar';
        return $this->render('user/avatar.html.twig', [
            'avatar' => $avatar
        ]);
    }
    #[Route('/security', name: 'app_security')]
    public function modifSecurity(): Response
    {
        $secu = 'security';
        return $this->render('user/security.html.twig', [
            'security' => $secu
        ]);
    }

    #[Route('/streamer/one/{id}', name: 'app_one_streamer')]
    public function single($id, UserRepository $userRepository): Response
    {
        $streamer = $userRepository->find($id);
        //$twitch = $userRepository->findAll($twitchlink);
        if(empty($streamer)) {
            throw $this->createNotFoundException('Cet utilisateur n\'existe pas');
        }

        return $this->render('user/single-streamer.html.twig', [
            'streamer' => $streamer,
            //'twitch' => $twitch
        ]);
    }
}
