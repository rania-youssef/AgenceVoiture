<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{  
    /**
     * @Route("/admin",name="home_admin")
     */
    public function index() {

        return $this->render('admin/home.html.twig');
    }
}