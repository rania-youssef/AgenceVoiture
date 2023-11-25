<?php

namespace App\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use GuzzleHttp\Client;


class ShowCarsController extends AbstractController
{  
    /**
     * @Route("/admin/show-cars",name="show_cars_admin")
     */
    public function index() {
        $client = new Client([
            'verify' => false,
        ]);

        // Faites une requête GET à l'API (changez l'URL par l'URL réelle de votre API)
        $response = $client->get('https://127.0.0.1:8000/apip/cars');

        // Obtenez le corps de la réponse
        $data = $response->getBody()->getContents();
        dd( $data);

        return $this->render('admin/show_cars.html.twig');
    }
}
