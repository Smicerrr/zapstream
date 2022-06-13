<?php

namespace App\Controller;

use Gumlet\ImageResize;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Form\EditUserType;
use App\Form\AddAvatarType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
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
    public function modifAvatar(Request $request, SluggerInterface $slugger,EntityManagerInterface $em,UserRepository $userRepository): Response
    {
        //$user = new User();
        $user = $this->getUser();
        $form = $this->createForm(AddAvatarType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avatarFile = $form->get('avatar2')->getData();

            if ($avatarFile) {
                $originalFilename = pathinfo($avatarFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$avatarFile->guessExtension();
                
                // Move the file to the directory where brochures are stored
                try {
                    $avatarFile->move(
                        $this->getParameter('avatar_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $image = new ImageResize($this->getParameter('avatar_directory') . '/' . $newFilename);
                $image->crop(200, 200, true, ImageResize::CROPCENTER);
                $image->save($this->getParameter('avatar_directory') . '/' . $newFilename);
                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $user->setAvatar($newFilename);
                $em->persist($user);
                $em->flush();
                //$userRepository->add($user);


            }

            // ... persist the $product variable or any other work

            return $this->redirectToRoute('app_user');
        }
        $streamers= $userRepository->findById($user);
        return $this->renderForm('user/avatar.html.twig', [
            'streamers' => $streamers,
            'addAvatar' => $form,

        ]);
    }
    public function getTargetDirectory()
    {
        return $this->targetDirectory;
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
