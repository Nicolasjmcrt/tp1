<?php

namespace App\Controller;

use App\Entity\Pilote;
use App\Entity\Qualification;
use App\Form\PiloteType;
use App\Repository\PiloteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PiloteController extends AbstractController
{
    #[Route('/pilote', name: 'app_pilote', methods: ['GET'])]
    public function index(PiloteRepository $piloteRepository): Response
    {
        $pilotes = $piloteRepository->findAll();
        return $this->render('pilote/index.html.twig', [
            'pilotes' => $pilotes,
        ]);
    }


    #[Route('/pilote/add', name: 'pilote_add', methods: ['GET', 'POST'])]
    public function add(Request $request, PiloteRepository $piloteRepository): Response
    {
        $pilote = new Pilote();
        $form = $this->createForm(PiloteType::class, $pilote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $piloteRepository->save($pilote, true);

            return $this->redirectToRoute('app_pilote');
        }

        return $this->render('pilote/add.html.twig', [
            'form' => $form->createView(),
            'titre' => 'Ajouter un pilote',
        ]);
    }

    #[Route('/pilote/edit/{id}', name: 'pilote_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pilote $pilote, PiloteRepository $piloteRepository): Response
    {
        $form = $this->createForm(PiloteType::class, $pilote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $piloteRepository->save($pilote, true);

            return $this->redirectToRoute('app_pilote');
        }

        return $this->render('pilote/add.html.twig', [
            'form' => $form->createView(),
            'titre' => 'Modifier un pilote',
        ]);
    }
    
    #[Route('/pilote/{id}', name: 'pilote_show', methods: ['GET'])]
    public function show(Pilote $pilote, Qualification $qualification): Response
    {
        return $this->render('pilote/show.html.twig', [
            'pilote' => $pilote,
            'qualification' => $qualification,
        ]);
    }

    #[Route('/pilote/delete/{id}', name: 'pilote_delete', methods: ['GET'])]
    public function delete(Pilote $pilote, PiloteRepository $piloteRepository): Response
    {
        $piloteRepository->remove($pilote, true);
        return $this->redirectToRoute('app_pilote');
    }
}
