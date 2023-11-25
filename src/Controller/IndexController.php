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

        if ($user !== null) {
            if (in_array('ROLE_ADMIN', $user->getRoles())) {
                return $this->redirectToRoute('home_admin', [], Response::HTTP_SEE_OTHER);
            }
            if (in_array('ROLE_USER', $user->getRoles())) {
                return $this->redirectToRoute('home_user', [], Response::HTTP_SEE_OTHER);
            }
        }
        return $this->redirectToRoute('login', [], Response::HTTP_SEE_OTHER);
    }


}
