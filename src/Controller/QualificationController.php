<?php

namespace App\Controller;

use App\Entity\Qualification;
use App\Form\QualificationType;
use App\Repository\QualificationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QualificationController extends AbstractController
{
    #[Route('/qualification', name: 'app_qualification', methods: ['GET'])]
    public function index(QualificationRepository $qualificationRepository): Response
    {
        $qualifications = $qualificationRepository->findAll();

        return $this->render('qualification/index.html.twig', [
            'qualifications' => $qualifications,
        ]);
    }

    #[Route('/qualification/{id}', name: 'qualification_show', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function show(Qualification $qualification): Response
    {
        return $this->render('qualification/show.html.twig', [
            'qualification' => $qualification,
        ]);
    }

    #[Route('/qualification/add', name: 'qualification_add', methods: ['GET', 'POST'])]
    public function add(Request $request, QualificationRepository $qualificationRepository): Response
    {
        $qualification = new Qualification();
        $form = $this->createForm(QualificationType::class, $qualification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $qualificationRepository->save($qualification, true);

            return $this->redirectToRoute('app_qualification');
        }

        return $this->render('qualification/add.html.twig', [
            'form' => $form->createView(),
            'titre' => 'Ajouter une qualification',
        ]);
    }

    #[Route('/qualification/edit/{id}', name: 'qualification_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Qualification $qualification, QualificationRepository $qualificationRepository): Response
    {
        $form = $this->createForm(QualificationType::class, $qualification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $qualificationRepository->save($qualification, true);

            return $this->redirectToRoute('app_qualification');
        }

        return $this->render('qualification/add.html.twig', [
            'form' => $form->createView(),
            'titre' => 'Modifier une qualification',
        ]);
    }

    #[Route('/qualification/delete/{id}', name: 'qualification_delete', methods: ['GET'])]
    public function delete(Qualification $qualification, QualificationRepository $qualificationRepository): Response
    {
        $qualificationRepository->remove($qualification, true);
        return $this->redirectToRoute('app_qualification');
    }
}
