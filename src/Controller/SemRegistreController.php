<?php

namespace App\Controller;

use App\Entity\SemRegistre;
use App\Form\SemRegistreType;
use App\Repository\SemRegistreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sem/registre')]
class SemRegistreController extends AbstractController
{
    #[Route('/', name: 'sem_registre_index', methods: ['GET'])]
    public function index(SemRegistreRepository $semRegistreRepository): Response
    {
        return $this->render('sem_registre/index.html.twig', [
            'sem_registres' => $semRegistreRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'sem_registre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $semRegistre = new SemRegistre();
        $form = $this->createForm(SemRegistreType::class, $semRegistre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($semRegistre);
            $entityManager->flush();

            return $this->redirectToRoute('sem_registre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sem_registre/new.html.twig', [
            'sem_registre' => $semRegistre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'sem_registre_show', methods: ['GET'])]
    public function show(SemRegistre $semRegistre): Response
    {
        return $this->render('sem_registre/show.html.twig', [
            'sem_registre' => $semRegistre,
        ]);
    }

    #[Route('/{id}/edit', name: 'sem_registre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SemRegistre $semRegistre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SemRegistreType::class, $semRegistre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('sem_registre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sem_registre/edit.html.twig', [
            'sem_registre' => $semRegistre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'sem_registre_delete', methods: ['POST'])]
    public function delete(Request $request, SemRegistre $semRegistre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$semRegistre->getId(), $request->request->get('_token'))) {
            $entityManager->remove($semRegistre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sem_registre_index', [], Response::HTTP_SEE_OTHER);
    }
}
