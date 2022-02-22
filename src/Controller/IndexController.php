<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class IndexController extends AbstractController
{  
    /**
     * @Route("/",name="home")
     */
    public function home(?UserInterface $user){
        if($user){
            return $this->redirectToRoute('voiture_index', [], Response::HTTP_SEE_OTHER);
        }else{
            return $this->redirectToRoute('login', [], Response::HTTP_SEE_OTHER);
        }
        
    }


}
