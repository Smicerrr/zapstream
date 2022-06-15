<?php

namespace App\Controller\Admin;

use Gumlet\ImageResize;
use App\Entity\Actu;
use App\Form\ActuType;
use App\Repository\ActuRepository;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
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

    #[Route('/new', name: 'app_admin_actu_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ActuRepository $actuRepository, SluggerInterface $slugger, EntityManagerInterface $em): Response
    {
        $actu = new Actu();
        $form = $this->createForm(ActuType::class, $actu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $actuFile = $form->get('actuImage')->getData();

            if ($actuFile) {
                $originalFilename = pathinfo($actuFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$actuFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $actuFile->move(
                        $this->getParameter('actu_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $image = new ImageResize($this->getParameter('actu_directory') . '/' . $newFilename);
                $image->crop(500, 280, true, ImageResize::CROPCENTER);
                $image->save($this->getParameter('actu_directory') . '/' . $newFilename);
                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $actu->setImage($newFilename);
                //$em->persist($actu);
                //$em->flush();

                $actu->setCreatedAt(new \DateTimeImmutable());
                $actu->setUser($this->getUser());
                $actuRepository->add($actu, true);

                return $this->redirectToRoute('app_admin_actu_index');
            }
        }
        //$actu = $actuRepository->findById($actu);
        return $this->renderForm('admin/actu/new.html.twig', [
            //'actu' => $actu,
            'form' => $form,
        ]);

    }

    #[Route('/{id}/edit', name: 'app_admin_actu_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, $id, ActuRepository $actuRepository): Response
    {
        $actu = $actuRepository->find($id);
        if(!$actu) {
            throw $this->createNotFoundException('no actu');
        }
        $form = $this->createForm(ActuType::class, $actu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $actuRepository->add($actu, true);

            return $this->redirectToRoute('app_admin_actu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/actu/edit.html.twig', [
            'actu' => $actu,
            'form' => $form,
        ]);
    }
}
