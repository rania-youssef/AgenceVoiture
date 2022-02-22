<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Voiture;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/voiture')]

class VoitureController extends AbstractController


{
    
    #[Route('/', name: 'voiture_index', methods: ['GET'])]
    public function index(VoitureRepository $voitureRepository): Response
    {
        return $this->render('voiture/index.html.twig', [
            'voitures' => $voitureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'voiture_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);
  
        if ($form->isSubmitted()) {
            
            $img = $form->get('imges')->getData();
            if($img){
            foreach($img as $imag){
              
                $fichier= md5(uniqid()) . '.' . $imag->guessExtension();
            // On copie le fichier dans le dossier uploads
                $imag->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
             $tabfichier[]=$fichier;
            
            $voiture->setImges($tabfichier);
            }
        }
            $entityManager->persist($voiture);
            $entityManager->flush();

            return $this->redirectToRoute('voiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('voiture/new.html.twig', [
            'voiture' => $voiture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'voiture_show', methods: ['GET'])]
    public function show(Voiture $voiture): Response
    {
        return $this->render('voiture/show.html.twig', [
            'voiture' => $voiture,
        ]);
    }

    #[Route('/{id}/edit', name: 'voiture_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Voiture $voiture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('voiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('voiture/edit.html.twig', [
            'voiture' => $voiture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'voiture_delete', methods: ['POST'])]
    public function delete(Request $request, Voiture $voiture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voiture->getId(), $request->request->get('_token'))) {
            $entityManager->remove($voiture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('voiture_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('new_comment/{id}', name: 'new_comment')]
 
        public function newComment(EntityManagerInterface $entityManager,$id,?UserInterface $user,VoitureRepository $voiture, Request $request)
        {
             $comment=new Comment();
             if($request){
             $cont=$request->request->get("comment");
             $comment->setContent($cont);
             $comment->setAuteur( $user);
             $comment->setVoiture($voiture->find($id));
             $entityManager->persist($comment);
             $entityManager->flush();

             return $this->redirectToRoute("voiture_show",["id"=>$id]);
            
             }
           

        }
    }
 

